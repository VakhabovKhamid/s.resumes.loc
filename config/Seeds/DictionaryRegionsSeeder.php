<?php

use Phinx\Seed\AbstractSeed;
use Config\Helpers\SeederHelper;


class DictionaryRegionsSeeder extends AbstractSeed
{
    public function getDependencies()
    {
        return [
            'DictionaryCountriesSeeder'
        ];
    }

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
        $raw = array (
			array (
				'id' => 1,
				'name_uz_c' => 'Андижон вилояти',
				'name_uz_l' => 'Аndijоn vilоyati',
				'name_ru_c' => 'Андижанская область',
				'name_en_l' => 'Andijan region',
				'name_qr_c' => 'Анжижан ўәлаяты',
				'name_qr_l' => 'Анжижан ўәлаяты',
				'is_active' => 'Y',
				'created_by' => 1,
				'modified_by' => 1,
			),
			array (
				'id' => 2,
				'name_uz_c' => 'Бухоро вилояти',
				'name_uz_l' => 'Buхоrо vilоyati',
				'name_ru_c' => 'Бухарская область',
				'name_en_l' => 'Bukhara region',
				'name_qr_c' => 'Бухара ўәлаяты',
				'name_qr_l' => 'Бухара ўәлаяты',
				'is_active' => 'Y',
				'created_by' => 1,
				'modified_by' => 1,
			),
			array (
				'id' => 3,
				'name_uz_c' => 'Жиззах вилояти',
				'name_uz_l' => 'Jizzах vilоyati',
				'name_ru_c' => 'Джизакская область',
				'name_en_l' => 'Djizak region',
				'name_qr_c' => 'Жиззах ўәлаяты',
				'name_qr_l' => 'Жиззах ўәлаяты',
				'is_active' => 'Y',
				'created_by' => 1,
				'modified_by' => 1,
			),
			array (
				'id' => 4,
				'name_uz_c' => 'Қашқадарё вилояти',
				'name_uz_l' => 'Qashqadaryo viloyati',
				'name_ru_c' => 'Кашкадарьинская область',
				'name_en_l' => 'Kashkadarya region',
				'name_qr_c' => 'Қашқадәрья ўәлаяты',
				'name_qr_l' => 'Қашқадәрья ўәлаяты',
				'is_active' => 'Y',
				'created_by' => 1,
				'modified_by' => 1,
			),
			array (
				'id' => 5,
				'name_uz_c' => 'Навоий вилояти',
				'name_uz_l' => 'Nаvоiy vilоyati',
				'name_ru_c' => 'Навоийская область',
				'name_en_l' => 'Navoiy region',
				'name_qr_c' => 'Наўайы ўәлаяты',
				'name_qr_l' => 'Наўайы ўәлаяты',
				'is_active' => 'Y',
				'created_by' => 1,
				'modified_by' => 1,
			),
			array (
				'id' => 6,
				'name_uz_c' => 'Наманган вилояти',
				'name_uz_l' => 'Nаmаngаn vilоyati',
				'name_ru_c' => 'Наманганская область',
				'name_en_l' => 'Namangan region',
				'name_qr_c' => 'Наманган ўәлаяты',
				'name_qr_l' => 'Наманган ўәлаяты',
				'is_active' => 'Y',
				'created_by' => 1,
				'modified_by' => 1,
			),
			array (
				'id' => 7,
				'name_uz_c' => 'Самарқанд вилояти',
				'name_uz_l' => 'Sаmаrqаnd vilоyati',
				'name_ru_c' => 'Самаркандская область',
				'name_en_l' => 'Samarkand region',
				'name_qr_c' => 'Самарқанд ўәлаяты',
				'name_qr_l' => 'Самарқанд ўәлаяты',
				'is_active' => 'Y',
				'created_by' => 1,
				'modified_by' => 1,
			),
			array (
				'id' => 8,
				'name_uz_c' => 'Сурхондарё вилояти',
				'name_uz_l' => 'Surхоndаryo vilоyati',
				'name_ru_c' => 'Сурхандарьинская область',
				'name_en_l' => 'Surkhandarya region',
				'name_qr_c' => 'Сурхандәрья ўәлаяты',
				'name_qr_l' => 'Сурхандәрья ўәлаяты',
				'is_active' => 'Y',
				'created_by' => 1,
				'modified_by' => 1,
			),
			array (
				'id' => 9,
				'name_uz_c' => 'Сирдарё вилояти',
				'name_uz_l' => 'Sirdаryo vilоyati',
				'name_ru_c' => 'Сырдарьинская область',
				'name_en_l' => 'Syrdarya region',
				'name_qr_c' => 'Сырдәрья ўәлаяты',
				'name_qr_l' => 'Сырдәрья ўәлаяты',
				'is_active' => 'Y',
				'created_by' => 1,
				'modified_by' => 1,
			),
			array (
				'id' => 10,
				'name_uz_c' => 'Тошкент вилояти',
				'name_uz_l' => 'Tоshkеnt vilоyati',
				'name_ru_c' => 'Ташкентская область',
				'name_en_l' => 'Tashkent region',
				'name_qr_c' => 'Ташкент ўәлаяты',
				'name_qr_l' => 'Ташкент ўәлаяты',
				'is_active' => 'Y',
				'created_by' => 1,
				'modified_by' => 1,
			),
			array (
				'id' => 11,
				'name_uz_c' => 'Фарғона вилояти',
				'name_uz_l' => 'Fаrg’оnа vilоyati',
				'name_ru_c' => 'Ферганская область',
				'name_en_l' => 'Fergana region',
				'name_qr_c' => 'Ферғана ўәлаяты',
				'name_qr_l' => 'Ферғана ўәлаяты',
				'is_active' => 'Y',
				'created_by' => 1,
				'modified_by' => 1,
			),
			array (
				'id' => 12,
				'name_uz_c' => 'Хоразм вилояти',
				'name_uz_l' => 'Хоrаzm vilоyati',
				'name_ru_c' => 'Хорезмская область',
				'name_en_l' => 'Khorezm region',
				'name_qr_c' => 'Хорезм ўәлаяты',
				'name_qr_l' => 'Хорезм ўәлаяты',
				'is_active' => 'Y',
				'created_by' => 1,
				'modified_by' => 1,
			),
			array (
				'id' => 13,
				'name_uz_c' => 'Тошкент шаҳар',
				'name_uz_l' => 'Tоshkеnt shаhаr',
				'name_ru_c' => 'Город Ташкент',
				'name_en_l' => 'Tashkent city',
				'name_qr_c' => 'Ташкент қаласы',
				'name_qr_l' => 'Ташкент қаласы',
				'is_active' => 'Y',
				'created_by' => 1,
				'modified_by' => 1,
			),
			array (
				'id' => 14,
				'name_uz_c' => 'Қорақалпоғистон Республикаси',
				'name_uz_l' => 'Qоrаqаlpоg`istоn Rеspublikаsi',
				'name_ru_c' => 'Республика Каракалпакстан',
				'name_en_l' => 'Republic of Karakalpakstan',
				'name_qr_c' => 'Қарақалпақстан Республикасы',
				'name_qr_l' => 'Қарақалпақстан Республикасы',
				'is_active' => 'Y',
				'created_by' => 1,
				'modified_by' => 1,
			),
		);

		$data = SeederHelper::applyTimestampts($raw);
        $tableName = 'dictionary_regions';
        $table = $this->table($tableName);
        SeederHelper::clear($this,$tableName);
        $table->insert($data)->save();
    }
}
