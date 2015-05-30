<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * LanguagesFixture
 *
 */
class LanguagesFixture extends TestFixture
{

    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $fields = [
        'country_id' => ['type' => 'string', 'fixed' => true, 'length' => 3, 'null' => false, 'default' => '', 'comment' => '', 'precision' => null],
        'language' => ['type' => 'string', 'fixed' => true, 'length' => 30, 'null' => false, 'default' => '', 'comment' => '', 'precision' => null],
        'is_official' => ['type' => 'text', 'length' => null, 'null' => false, 'default' => 'F', 'comment' => '', 'precision' => null],
        'percentage' => ['type' => 'float', 'length' => 4, 'precision' => 1, 'unsigned' => false, 'null' => false, 'default' => '0.0', 'comment' => ''],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['country_id', 'language'], 'length' => []],
        ],
        '_options' => [
            'engine' => 'MyISAM',
            'collation' => 'latin1_swedish_ci'
        ],
    ];
    // @codingStandardsIgnoreEnd

    /**
     * Records
     *
     * @var array
     */
    public $records = [
        [
            'country_id' => 'bf48a66b-2e0c-44a8-8b2c-856a6762fab9',
            'language' => '5be15c94-8c30-44d3-a0d9-0b4c2ad83aa2',
            'is_official' => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida, phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam, vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit, feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.',
            'percentage' => 1
        ],
    ];
}
