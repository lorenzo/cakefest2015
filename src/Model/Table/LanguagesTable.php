<?php
namespace App\Model\Table;

use App\Model\Entity\Language;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Languages Model
 */
class LanguagesTable extends Table
{

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        $this->table('languages');
        $this->displayField('country_id');
        $this->primaryKey(['country_id', 'language']);
        $this->belongsTo('Countries', [
            'foreignKey' => 'country_id',
            'joinType' => 'INNER'
        ]);
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator)
    {
        $validator
            ->allowEmpty('language', 'create');

        $validator
            ->requirePresence('is_official', 'create')
            ->notEmpty('is_official');

        $validator
            ->add('percentage', 'valid', ['rule' => 'numeric'])
            ->requirePresence('percentage', 'create')
            ->notEmpty('percentage');

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules)
    {
        $rules->add($rules->existsIn(['country_id'], 'Countries'));
        return $rules;
    }

    public function findPopular($query, $options = [])
    {
        return $query
            ->contain(['Countries' => function ($q) {
                return $q
                    ->find('totalSpeakersSQL');
            }])
            ->group(['Languages.language'])
            ->order(['total' => 'DESC']);
    }
}
