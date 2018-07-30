<?php
use Migrations\AbstractSeed;

/**
 * P5ApplicantDesirableCountries seed.
 */
class P7ApplicantDesirableCountriesSeed extends AbstractSeed
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
        $data = [];
        $countriesIds = $this->query("SELECT id FROM dictionary_countries WHERE id <> 182")->fetchAll(\PDO::FETCH_COLUMN);
        $applicantsIds = $this->query("SELECT id FROM applicants")->fetchAll(\PDO::FETCH_COLUMN);

        $makeRandomFunc = function ($array) {
            return function() use (&$array){
                if (empty($array)) {
                    return null;
                }
                $index = array_rand($array);
                $item = $array[$index];
                unset($array[$index]);
                $array = array_values($array);
                return $item;
            };
        };

        foreach($applicantsIds as $id){
            $selector = $makeRandomFunc($countriesIds);
            for($elements = rand(1,4); $elements > 0 ;$elements--){
                $data[] = [
                    'applicant_id'=> $id,
                    'dictionary_country_id'=>$selector(),
                    'created'=>'2017-07-18 20:04:01',
                    'modified'=>'2017-07-18 20:04:01',
                    'created_by'=>1,
                    'modified_by'=>1,
                ];
            }
        }

        $table = $this->table('applicant_desirable_countries');
        $table->insert($data)->save();
    }
}
