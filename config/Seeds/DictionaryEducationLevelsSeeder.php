<?php

use Phinx\Seed\AbstractSeed;

class DictionaryEducationLevelsSeeder extends AbstractSeed
{
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
        $raw = '
[
	{
		"id" : 1,
		"name_uz_c" : "Дошкольное образование",
		"name_uz_l" : "Дошкольное образование",
		"name_ru_c" : "Дошкольное образование",
		"name_en_l" : "Дошкольное образование",
		"name_qr_c" : "Дошкольное образование",
		"name_qr_l" : "Дошкольное образование",
		"is_active" : "Y",
		"created_by" : 2,
		"modified_by" : 2
	},
	{
		"id" : 2,
		"name_uz_c" : "Общее образование",
		"name_uz_l" : "Общее образование",
		"name_ru_c" : "Общее образование",
		"name_en_l" : "Общее образование",
		"name_qr_c" : "Общее образование",
		"name_qr_l" : "Общее образование",
		"is_active" : "Y",
		"created_by" : 2,
		"modified_by" : 2
	},
	{
		"id" : 3,
		"name_uz_c" : "Внешкольное образование",
		"name_uz_l" : "Внешкольное образование",
		"name_ru_c" : "Внешкольное образование",
		"name_en_l" : "Внешкольное образование",
		"name_qr_c" : "Внешкольное образование",
		"name_qr_l" : "Внешкольное образование",
		"is_active" : "Y",
		"created_by" : 2,
		"modified_by" : 2
	},
	{
		"id" : 4,
		"name_uz_c" : "Профессионально-техническое образование",
		"name_uz_l" : "Профессионально-техническое образование",
		"name_ru_c" : "Профессионально-техническое образование",
		"name_en_l" : "Профессионально-техническое образование",
		"name_qr_c" : "Профессионально-техническое образование",
		"name_qr_l" : "Профессионально-техническое образование",
		"is_active" : "Y",
		"created_by" : 2,
		"modified_by" : 2
	},
	{
		"id" : 5,
		"name_uz_c" : "Среднее специальное образование",
		"name_uz_l" : "Среднее специальное образование",
		"name_ru_c" : "Среднее специальное образование",
		"name_en_l" : "Среднее специальное образование",
		"name_qr_c" : "Среднее специальное образование",
		"name_qr_l" : "Среднее специальное образование",
		"is_active" : "Y",
		"created_by" : 2,
		"modified_by" : 2
	},
	{
		"id" : 6,
		"name_uz_c" : "Высшее образование",
		"name_uz_l" : "Высшее образование",
		"name_ru_c" : "Высшее образование",
		"name_en_l" : "Высшее образование",
		"name_qr_c" : "Высшее образование",
		"name_qr_l" : "Высшее образование",
		"is_active" : "Y",
		"created_by" : 2,
		"modified_by" : 2
	},
	{
		"id" : 7,
		"name_uz_c" : "Семейное образование",
		"name_uz_l" : "Семейное образование",
		"name_ru_c" : "Семейное образование",
		"name_en_l" : "Семейное образование",
		"name_qr_c" : "Семейное образование",
		"name_qr_l" : "Семейное образование",
		"is_active" : "Y",
		"created_by" : 2,
		"modified_by" : 2
	},
	{
		"id" : 8,
		"name_uz_c" : "Самообразование",
		"name_uz_l" : "Самообразование",
		"name_ru_c" : "Самообразование",
		"name_en_l" : "Самообразование",
		"name_qr_c" : "Самообразование",
		"name_qr_l" : "Самообразование",
		"is_active" : "Y",
		"created_by" : 2,
		"modified_by" : 2
	}
]';
        
        $data = SeederHelper::defaultPrepare($raw);
        $tableName = 'dictionary_education_levels';
        $table = $this->table($tableName);
        SeederHelper::clear($this,$tableName);
        $table->insert($data)->save();
    }
}
