<?php
namespace App\Model\Table;

use App\Model\Entity\Country;
use App\Model\Formatter\TotalSpeakers;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Countries Model
 */
class CountriesTable extends Table
{

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        $this->table('countries');
        $this->displayField('name');
        $this->primaryKey('id');
        $this->addBehavior('Timestamp');
        $this->belongsTo('Capitals', [
            'foreignKey' => 'capital_id'
        ]);
        $this->hasMany('Cities', [
            'foreignKey' => 'country_id'
        ]);
        $this->hasMany('Languages', [
            'foreignKey' => 'country_id'
        ]);
        $this->hasMany('OfficialLanguages', [
            'className' => LanguagesTable::class,
            'foreignKey' => 'country_id',
            'conditions' => ['OfficialLanguages.is_official' => 'T']
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
            ->allowEmpty('id', 'create');

        $validator
            ->requirePresence('name', 'create')
            ->notEmpty('name');

        $validator
            ->requirePresence('continent', 'create')
            ->notEmpty('continent');

        $validator
            ->requirePresence('region', 'create')
            ->notEmpty('region');

        $validator
            ->add('surface_area', 'valid', ['rule' => 'numeric'])
            ->requirePresence('surface_area', 'create')
            ->notEmpty('surface_area');

        $validator
            ->add('independence_year', 'valid', ['rule' => 'numeric'])
            ->allowEmpty('independence_year');

        $validator
            ->add('population', 'valid', ['rule' => 'numeric'])
            ->requirePresence('population', 'create')
            ->notEmpty('population');

        $validator
            ->add('life_expectancy', 'valid', ['rule' => 'numeric'])
            ->allowEmpty('life_expectancy');

        $validator
            ->add('gnp', 'valid', ['rule' => 'numeric'])
            ->allowEmpty('gnp');

        $validator
            ->add('gnp_oid', 'valid', ['rule' => 'numeric'])
            ->allowEmpty('gnp_oid');

        $validator
            ->requirePresence('local_name', 'create')
            ->notEmpty('local_name');

        $validator
            ->requirePresence('government_form', 'create')
            ->notEmpty('government_form');

        $validator
            ->allowEmpty('head_of_state');

        $validator
            ->requirePresence('code', 'create')
            ->notEmpty('code');

        $validator
            ->add('is_active', 'valid', ['rule' => 'boolean'])
            ->requirePresence('is_active', 'create')
            ->notEmpty('is_active');

        $validator
            ->allowEmpty('quote');

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
        $rules->add($rules->existsIn(['capital_id'], 'Capitals'));
        return $rules;
    }


    public function findSpeaking($query, $options = [])
    {
        if (empty($options['language'])) {
            throw new \InvalidArgumentException('You need to provide a language');
        }
        return $query
            ->matching('Languages', function ($q) use ($options) {
                return $q->where(['language' => $options['language']]);
            });
    }

    public function findTotalSpeakers($query, $options)
    {
        return $query->formatResults(function ($results) {
            return [$results->sumOf(function ($countryWithLanguage) {
                return $countryWithLanguage->population *
                    ($countryWithLanguage->_matchingData['Languages']->percentage / 100);
            })];
        });
    }

    public function findTotalSpeakersSQL($query, $options)
    {
        $expr = $query->func()->sum('population * (percentage / 100)');
        return $query->select(['total' => $expr]);
    }

    public function findSmallerThan($query, $options = [])
    {
        return $query
            ->select(['Countries.name', 'city_name' => 'Cities.name'])
            ->innerJoin(['Cities' => 'cities'], function ($exp) use ($options) {
                return $exp
                    ->add(['Countries.population < Cities.population'])
                    ->eq('Cities.name', $options['city']);
            });
    }

    public function beforeFind($event, $query, $options)
    {
        $query->formatResults(function ($results) {
            return $results->reject(function ($country) {
                $languages = (array)$country->get('languages');
                return collection($languages)->extract('language')->contains('Spanish');
            });
        });

        $query->formatResults(function ($results) {
            return $results
                ->map(new TotalSpeakers('languages'))
                ->map(new TotalSpeakers('official_languages'));
        });
    }
}
