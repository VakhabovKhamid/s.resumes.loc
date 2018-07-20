<?php
use Migrations\AbstractSeed;
use Config\Helpers\SeederHelper;

/**
 * P5DictionaryIndustries seed.
 */
class P5DictionaryIndustriesSeed extends AbstractSeed
{
    /**
     * Run Method.
     *
     * Write your database seeder using this method.
     *
     * More information on writing seeds is available here:
     * http://docs.phinx.org/en/latest/seeding.html
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'name_uz_c'=>'Строительство',
                'name_uz_l'=>'Строительство',
                'name_ru_c'=>'Строительство',
                'name_en_l'=>'Строительство',
                'name_qr_c'=>'Строительство',
                'name_qr_l'=>'Строительство',
                'is_active'=>'Y',
                'created'=>'2018-07-10 04:31:29',
                'modified'=>'2018-07-10 04:31:29',
                'created_by'=>1,
                'modified_by'=>1,
            ],
            [
                'name_uz_c'=>'Сфера услуг',
                'name_uz_l'=>'Сфера услуг',
                'name_ru_c'=>'Сфера услуг',
                'name_en_l'=>'Сфера услуг',
                'name_qr_c'=>'Сфера услуг',
                'name_qr_l'=>'Сфера услуг',
                'is_active'=>'Y',
                'created'=>'2018-07-10 04:31:29',
                'modified'=>'2018-07-10 04:31:29',
                'created_by'=>1,
                'modified_by'=>1,
            ]
        ];
        SeederHelper::clear($this, 'dictionary_industries');
        $table = $this->table('dictionary_industries');
        $table->insert($data)->save();
    }
}
