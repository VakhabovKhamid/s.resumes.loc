<?php

use Phinx\Seed\AbstractSeed;
use Config\Helpers\SeederHelper;

class P1DictionaryCountriesSeeder extends AbstractSeed
{

    /* Раскомментировать когда дадут группы и пользователей */
    // public function getDependencies()
    // {
    //     return [
    //         'UsersSeeder',
    //         'GroupsSeeder'
    //     ];
    // }

    /**
     * Run Method.
     *
     * Write your database seeder using this method.
     *
     * More information on writing seeders is available here:
     * http://docs.phinx.org/en/latest/seeding.html
     */
    public function run()
    {
        $raw = '[
	{
		"id" : 1,
		"name_uz_c" : "Узбекистан",
		"name_uz_l" : "Узбекистан",
		"name_ru_c" : "Узбекистан",
		"name_en_l" : "Узбекистан",
		"name_qr_c" : "Узбекистан",
		"name_qr_l" : "Узбекистан",
		"is_active" : "Y",
		"created_by" : 1,
		"modified_by" : 1
	},
	{
		"id" : 2,
		"name_uz_c" : "Казахстан",
		"name_uz_l" : "Казахстан",
		"name_ru_c" : "Казахстан",
		"name_en_l" : "Казахстан",
		"name_qr_c" : "Казахстан",
		"name_qr_l" : "Казахстан",
		"is_active" : "Y",
		"created_by" : 1,
		"modified_by" : 1
	},
	{
		"id" : 3,
		"name_uz_c" : "Россия",
		"name_uz_l" : "Россия",
		"name_ru_c" : "Россия",
		"name_en_l" : "Россия",
		"name_qr_c" : "Россия",
		"name_qr_l" : "Россия",
		"is_active" : "Y",
		"created_by" : 1,
		"modified_by" : 1
	},
	{
		"id" : 4,
		"name_uz_c" : "США",
		"name_uz_l" : "США",
		"name_ru_c" : "США",
		"name_en_l" : "США",
		"name_qr_c" : "США",
		"name_qr_l" : "США",
		"is_active" : "Y",
		"created_by" : 1,
		"modified_by" : 1
	},
	{
		"id" : 5,
		"name_uz_c" : "Турция",
		"name_uz_l" : "Турция",
		"name_ru_c" : "Турция",
		"name_en_l" : "Турция",
		"name_qr_c" : "Турция",
		"name_qr_l" : "Турция",
		"is_active" : "Y",
		"created_by" : 1,
		"modified_by" : 1
	}
]';
        
        $data = SeederHelper::defaultPrepare($raw);
        $tableName = 'dictionary_countries';
        $table = $this->table($tableName);
        SeederHelper::clear($this,'applicant_desirable_countries');
        SeederHelper::clear($this,'applicants');
        SeederHelper::clear($this,'dictionary_education_levels');
        SeederHelper::clear($this,'dictionary_districts');
        SeederHelper::clear($this,'dictionary_industries');
        SeederHelper::clear($this,'dictionary_regions');
        SeederHelper::clear($this,$tableName);
        $table->insert($data)->save();
    }
}


