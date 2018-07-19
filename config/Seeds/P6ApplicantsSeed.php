<?php

use Migrations\AbstractSeed;
use Faker\Factory;
use Config\Helpers\SeederHelper;

/**
 * P5Applicants seed.
 */
class P6ApplicantsSeed extends AbstractSeed
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
        SeederHelper::clear($this, 'applicants');
        $translit = function ($str){
           return str_replace(['ё','Ё'],['yo','YO'],transliterator_transliterate('Russian-Latin/BGN',$str));
        };
        $randBool = function($y,$n){
            return rand(0,1) === 1 ? $y: $n;
        };
        $random = function($array){
            $k = array_rand($array);
            return $array[$k];
        };

        $randomSkills = function() use (&$faker){
            return json_encode($faker->words(rand(1,4),false));
        };
        // $faker = Factory::create('ru_RU');
        $countriesIds = $this->query("SELECT id FROM dictionary_countries")->fetchAll(\PDO::FETCH_COLUMN);
        $regionsIds = $this->query("SELECT id FROM dictionary_regions")->fetchAll(\PDO::FETCH_COLUMN);
        $districts = $this->query("SELECT id, region_id FROM dictionary_districts")->fetchAll(\PDO::FETCH_ASSOC);
        $educationLevelsIds = $this->query("SELECT id FROM dictionary_education_levels")->fetchAll(\PDO::FETCH_COLUMN);
        $industriesIds = $this->query("SELECT id FROM dictionary_industries")->fetchAll(\PDO::FETCH_COLUMN);
        

        $faker = Factory::create('ru_RU');
        $data = [];
        foreach(range(1,10000) as $i=>$v){
            $item = [
                'latin_name'=>$translit($faker->firstname),
                'latin_surname'=>$translit($faker->lastname),
                'latin_patronym'=>$translit($faker->middleName),
                'sex'=>$randBool('M','F'),
                'birth_date'=> $faker->dateTimeThisCentury->format('Y-m-d'),
                'address_country_id'=>1,
                'address_region_id'=>$random($regionsIds),
                'address_extended'=>$faker->streetAddress,
                'education_level_id'=>$random($educationLevelsIds),
                'professional_skills'=>$randomSkills(),
                'industry_id'=>$random($industriesIds),
                'is_archive'=> $randBool('Y','N'),
                'created'=> (new DateTime())->format('Y-m-d H:i:s'),
                'modified'=> (new DateTime())->format('Y-m-d H:i:s'),
                'created_by'=>1,
                'modified_by'=>1
            ];
            $item['address_district_id'] = $random(array_map(function($el){
                return $el['id'];
            },array_filter($districts,function($el) use (&$item){
                return $el['region_id'] === $item['address_region_id'];
            })));
            $data[] = $item;
        }

        // dd($data);
        $table = $this->table('applicants');
        $table->insert($data)->save();
    }
}
