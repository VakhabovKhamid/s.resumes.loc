<?php
namespace App\Controller\Api;
use Cake\Datasource\ConnectionManager;
use Cake\I18n\I18n;

/**
 * Reports Controller
 *
 *
 * @method \App\Model\Entity\Report[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ReportsController extends ApiController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $conn = ConnectionManager::get('default');
        $lang = I18n::getLocale();

        $countryNameColumn = MappedLanguageHelper::get('name',$lang);
        // $countries = $conn->query("SELECT id, {$countryNameColumn} as name FROM dictionary_countries")->fetchAll(\PDO::FETCH_ASSOC);
        // $industries = $conn->query("SELECT id, {$countryNameColumn} as name FROM dictionary_industries")->fetchAll(\PDO::FETCH_ASSOC);
        
        // $countryCounterColumns = array_map(function($country){
        //     $columnCounter = new ColumnCountryCounter();
        //     return $columnCounter->make($country);
        // },$countries);

        // $industryCounterColumns = array_map(function($industry){
        //     $columnCounter = new ColumnIndustryCounter();
        //     return $columnCounter->make($industry);
        // },$industries);

        // $dynamicColumns = new DynamicColumns();
        // $commonColumns = [
        //     'dr.id',
        //     'dr.name_ru_c as "region_name"',
        //     "COUNT(a.id) as 'applicants'",
        //     "SUM(IF(a.sex = 'M',1,0)) as 'M'",
        //     "SUM(IF(a.sex = 'F',1,0)) as 'F'",
        // ];
        // $dynamicColumns->concat($commonColumns);
        // $dynamicColumns->concat($countryCounterColumns);
        $mainQuery = <<<SQL
            SELECT
                dr.id,
                $countryNameColumn as region_name,
                COUNT(q1.id) as 'applicants',
                SUM(IF(q1.sex = 'M',1,0)) as 'M',
                SUM(IF(q1.sex = 'F',1,0)) as 'F',
                SUM(q1.adc1) as 'Россия', 
                SUM(q1.adc2) as 'Корея',
                SUM(q1.adc3) as 'Казахстан', 
                SUM(q1.adc4) as 'Турция', 
                SUM(q1.adc6) as 'Япония', 
                SUM(q1.adc9) as 'Страны ЕС', 
                SUM(q1.adc10) as 'Америка',
                SUM(q1.ai1) as 'Стройтельство',
                SUM(q1.ai2) as 'Сфера услуг',
                SUM(q1.ai3) as 'Общепит',
                SUM(q1.ai4) as 'Торговля'
            FROM dictionary_regions dr
            JOIN (
                SELECT 
                a.*, 
                ISNULL(adc1.id) as adc1, 
                ISNULL(adc2.id) as adc2, 
                ISNULL(adc3.id) as adc3, 
                ISNULL(adc4.id) as adc4, 
                ISNULL(adc6.id) as adc6, 
                ISNULL(adc9.id) as adc9, 
                ISNULL(adc10.id) as adc10,
                ISNULL(ai1.id) as ai1,
                ISNULL(ai2.id) as ai2,
                ISNULL(ai3.id) as ai3,
                ISNULL(ai4.id) as ai4
                FROM applicants a
                LEFT JOIN applicant_desirable_countries adc1 ON (a.id = adc1.`applicant_id` AND adc1.`dictionary_country_id` = 1)
                LEFT JOIN applicant_desirable_countries adc2 ON (a.id = adc2.`applicant_id` AND adc2.`dictionary_country_id` = 2)
                LEFT JOIN applicant_desirable_countries adc3 ON (a.id = adc3.`applicant_id` AND adc3.`dictionary_country_id` = 3)
                LEFT JOIN applicant_desirable_countries adc4 ON (a.id = adc4.`applicant_id` AND adc4.`dictionary_country_id` = 4)
                LEFT JOIN applicant_desirable_countries adc6 ON (a.id = adc6.`applicant_id` AND adc6.`dictionary_country_id` = 6)
                LEFT JOIN applicant_desirable_countries adc9 ON (a.id = adc9.`applicant_id` AND adc9.`dictionary_country_id` = 9)
                LEFT JOIN applicant_desirable_countries adc10 ON (a.id = adc10.`applicant_id` AND adc10.`dictionary_country_id` = 10)
                LEFT JOIN applicant_industries ai1 ON (a.id = ai1.`applicant_id` AND ai1.`dictionary_industry_id` = 1)
                LEFT JOIN applicant_industries ai2 ON (a.id = ai2.`applicant_id` AND ai2.`dictionary_industry_id` = 2)
                LEFT JOIN applicant_industries ai3 ON (a.id = ai3.`applicant_id` AND ai3.`dictionary_industry_id` = 3)
                LEFT JOIN applicant_industries ai4 ON (a.id = ai4.`applicant_id` AND ai4.`dictionary_industry_id` = 4)

                GROUP BY a.id
            ) as q1 ON q1.address_region_id = dr.id
            GROUP BY dr.id

SQL;
        // $dynamicColumns->concat($industryCounterColumns);
        
        // $mainQuery = "
        //     SELECT
        //         {$dynamicColumns->render()}
        //     FROM dictionary_regions dr
        //     JOIN applicants a
        //         ON dr.id = a.address_region_id
        //     JOIN dictionary_countries dc
        //         ON a.address_country_id = dc.id
        //     JOIN (
        //         SELECT dc.id,COUNT(*) as 'countries' 
        //         FROM dictionary_countries dc 
        //         JOIN applicant_desirable_countries adc
        //             ON dc.id = adc.dictionary_country_id
        //         GROUP BY dc.id
        //     ) as q1 ON dc.id = q1.id

        //     JOIN applicant_industries ai
        //         ON ai.applicant_id = a.id
        //     GROUP BY dr.id
        // ";

        // $totalQuery = "
        //     SELECT
        //         {$dynamicColumns->render()}
        //     FROM dictionary_regions dr
        //     LEFT JOIN applicants a
        //         ON dr.id = a.address_region_id
        //     LEFT JOIN dictionary_countries dc
        //         ON a.address_country_id = dc.id
        //     LEFT JOIN applicant_desirable_countries adc
        //         ON a.id = adc.applicant_id
        //     LEFT JOIN applicant_industries ai
        //         ON ai.applicant_id = a.id
        //     GROUP BY a.address_country_id
        // ";

        $result = $conn->query($mainQuery)->fetchAll(\PDO::FETCH_ASSOC);
        // dd($result);
        $result = array_map(function($item){
            $newItem = [];
            foreach($item as $name=>$value){
                if($name !== 'id' && $name !=='region_name'){
                    $newItem[$name] = parse($value,'i');
                }else{
                    $newItem[$name] = $value;
                }
            }
            return $newItem;
        },$result);
        // dd($result);

        $createTemplate = function($rows){
            if(empty($rows)){
                throw new \Exception('Rows cannot be empty');
            }
            list($row) = $rows;
            $newRow = [];
            // $filtered = array_filter($row,function($column){
            //     return $column !== 'id' && $column !== 'region_name';
            // }, ARRAY_FILTER_USE_KEY);
            foreach($row as $k=>$v){
                $newRow[$k] = null;
            }
            return $newRow;
        };

        $total = array_reduce($result,function($total,$row){
            $newRow = [];

            foreach($row as $column=>$value){
                if($column !== 'region_name' && $column !== 'id'){
                    $newRow[$column] = +$value;
                    $total[$column] += $newRow[$column];
                }
            }
            
            return $total;
            
        },$createTemplate($result));
        array_push($result,$total);

        $replacebleKeys = [
            'region_name'=>"Регион",
            'applicants'=>"Всего",
            'M'=>"Мужчины",
            'F'=>"Женщины",
        ];
        
        $result = replaceWithKeys($replacebleKeys,$result);
        // dd($result);

        $response = [
            'data'=>[
                'rows'=>$result
            ]
        ];


        $this->set(compact('response'));
        $this->set('_serialize', 'response');

    }
    
    public function initialize(){
        parent::initialize();
        $this->loadComponent('RequestHandler');
    }
}

function parse($value,$type){
    if($type === 'i' || $type === 'f'){
        return +$value;
    }else{
        return $value;
    }
}

function replaceWithKeys($keys,$result){
    $newArray = [];
    foreach ($result as $row) {
        $item = [];
        foreach ($row as $k => $v) {
            if(isset($keys[$k])){
                $item[$keys[$k]] = $v;
            }else{
                $item[$k] = $v;
            }
        }
        $newArray[] = $item;
    }
    return $newArray;

}

class ColumnCounter
{
    protected $tableName;
    protected $lang;
    protected $column;
    protected $targetId;

    public function __construct()
    {
        // $this->tableName = $tableName;
        // $this->column = $column;
    }
}

class ColumnCountryCounter extends ColumnCounter{
    public $tableName = 'adc';
    public $column = 'dictionary_country_id';

    public function make(array $country = [])
    {
            if(!is_array($country) || empty($country)){
                throw new \Exception('Country cannot be empty');
            }
            $id = $country['id'];
            $name = $country['name'];

            return "SUM(IF({$this->tableName}.{$this->column} = {$id},1,0)) as '{$name}'";
    }
}

class ColumnIndustryCounter extends ColumnCounter
{
    public $tableName = 'ai';
    public $column = 'dictionary_industry_id';

    public function make(array $industry = [])
    {
        if (!is_array($industry) || empty($industry)) {
            throw new \Error('Industry cannot be empty');
        }
        $id = $industry['id'];
        $name = $industry['name'];

        return "SUM(IF({$this->tableName}.{$this->column} = {$id},1,0)) as '{$name}'";
    }
}


class MappedLanguageHelper
{
    protected static $_mappedLanguages = [
        'ru' => 'ru_c',
        'en' => 'en_l',
        'uz' => 'uz_l',
    ];

    public static function get(string $field, string $locale)
    {
        if (isset(self::$_mappedLanguages[$locale])) {
            return "{$field}_" . (self::$_mappedLanguages[$locale]);
        }else{
            dd($locale);
            throw new \Error("Can't get lang, from current locale");
        }
    }
}

class DynamicColumns{
    protected $columns = [];

    public function concat(array $columns = [])
    {
        $this->columns = array_merge($this->columns, $columns);
    }

    public function render(){
        return implode(",\n",$this->columns);
    }

}
