<?php
use Migrations\AbstractSeed;

/**
 * P8ApplicantIndustriesSeed seed.
 */
class P8ApplicantIndustriesSeed extends AbstractSeed
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
        $industriesIds = $this->query("SELECT id FROM dictionary_industries")->fetchAll(\PDO::FETCH_COLUMN);
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
            $selector = $makeRandomFunc($industriesIds);
            for($elements = rand(1,3); $elements > 0 ;$elements--){
                $data[] = [
                    'applicant_id'=> $id,
                    'dictionary_industry_id'=>$selector(),
                    'created'=>'2017-07-18 20:04:01',
                    'modified'=>'2017-07-18 20:04:01',
                    'created_by'=>1,
                    'modified_by'=>1,
                ];
            }
        }

        $table = $this->table('applicant_industries');
        $table->insert($data)->save();
    }
}
