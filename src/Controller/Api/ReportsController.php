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
        $countries = $conn->query("SELECT id, {$countryNameColumn} as name FROM dictionary_countries")->fetchAll(\PDO::FETCH_ASSOC);
        $industries = $conn->query("SELECT id, {$countryNameColumn} as name FROM dictionary_industries")->fetchAll(\PDO::FETCH_ASSOC);
        
        $countryCounterColumns = array_map(function($country){
            $columnCounter = new ColumnCountryCounter();
            return $columnCounter->make($country);
        },$countries);

        $industryCounterColumns = array_map(function($industry){
            $columnCounter = new ColumnIndustryCounter();
            return $columnCounter->make($industry);
        },$industries);

        $dynamicColumns = new DynamicColumns();
        $commonColumns = [
            'dr.id',
            'dr.name_ru_c as region_name',
            "COUNT(a.id) as 'applicants'",
            "SUM(IF(a.sex = 'M',1,0)) as 'M'",
            "SUM(IF(a.sex = 'F',1,0)) as 'F'",
        ];
        $dynamicColumns->concat($commonColumns);
        $dynamicColumns->concat($countryCounterColumns);
        $dynamicColumns->concat($industryCounterColumns);
        
        $mainQuery = "
            SELECT
                {$dynamicColumns->render()}
            FROM dictionary_regions dr
            LEFT JOIN applicants a
                ON dr.id = a.address_region_id
            LEFT JOIN dictionary_countries dc
                ON a.address_country_id = dc.id
            LEFT JOIN applicant_desirable_countries adc
                ON a.id = adc.applicant_id
            LEFT JOIN applicant_industries ai
                ON ai.applicant_id = a.id
            GROUP BY dr.id
        ";

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
