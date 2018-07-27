<?php
namespace App\Model\Table;

use App\Model\Entity\Applicant;
use Cake\Database\Schema\TableSchema;
use Cake\Datasource\EntityInterface;
use Cake\Event\Event;
use Cake\I18n\Date;
use Cake\ORM\Entity;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

use App\Lib\QueryFilter\RulesSet;
use App\Lib\QueryFilter\Rules\AttributeRule;
use App\Lib\QueryFilter\Rules\ValueRule;

/**
 * Applicants Model
 *
 * @property \App\Model\Table\DictionaryCountriesTable|\Cake\ORM\Association\BelongsTo $DictionaryCountries
 * @property \App\Model\Table\DictionaryRegionsTable|\Cake\ORM\Association\BelongsTo $DictionaryRegions
 * @property \App\Model\Table\DictionaryDistrictsTable|\Cake\ORM\Association\BelongsTo $DictionaryDistricts
 * @property \App\Model\Table\DictionaryEducationLevelsTable|\Cake\ORM\Association\BelongsTo $DictionaryEducationLevels
 * @property \App\Model\Table\DictionaryIndustriesTable|\Cake\ORM\Association\BelongsTo $DictionaryIndustries
 * @property \App\Model\Table\ApplicantDocumentsTable|\Cake\ORM\Association\HasMany $ApplicantDocuments
 *
 * @method \App\Model\Entity\Applicant get($primaryKey, $options = [])
 * @method \App\Model\Entity\Applicant newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Applicant[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Applicant|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Applicant|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Applicant patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Applicant[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Applicant findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class ApplicantsTable extends Table
{

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->setTable('applicants');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('DictionaryCountries', [
            'foreignKey' => 'address_country_id'
        ]);
        $this->belongsTo('DictionaryRegions', [
            'foreignKey' => 'address_region_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('DictionaryDistricts', [
            'foreignKey' => 'address_district_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('DictionaryEducationLevels', [
            'foreignKey' => 'education_level_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Users', [
            'foreignKey' => 'created_by',
            'joinType' => 'INNER'
        ]);
        $this->hasMany('ApplicantDocuments', [
            'foreignKey' => 'applicant_id',
            'dependent' => true,
            'cascadeCallbacks' => true,
        ]);

        /*$this->belongsToMany('DesirableCountries', [
            'through' => 'ApplicantDesirableCountries',
            'className' => 'DictionaryCountries',
            'targetForeignKey' => 'dictionary_country_id',
            //'strategy' => 'subquery'
        ]);

        $this->belongsToMany('UndesirableCountries', [
            'through' => 'ApplicantUndesirableCountries',
            'className' => 'DictionaryCountries',
            'targetForeignKey' => 'dictionary_country_id',
            //'strategy' => 'subquery'
        ]);

        $this->belongsToMany('Industries', [
            'through' => 'ApplicantIndustries',
            'className' => 'DictionaryIndustries',
            'targetForeignKey' => 'dictionary_industry_id',
            //'strategy' => 'subquery'
        ]);*/


        $this->belongsToMany('DesirableCountries', [
            'joinTable'=>'ApplicantDesirableCountries',
            'className' => 'DictionaryCountries',
            'foreignKey' => 'applicant_id',
            'targetForeignKey' => 'dictionary_country_id'
        ]);

        $this->belongsToMany('UndesirableCountries', [
            'joinTable' => 'ApplicantUndesirableCountries',
            'className' => 'DictionaryCountries',
            'foreignKey' => 'applicant_id',
            'targetForeignKey' => 'dictionary_country_id'
        ]);

        $this->belongsToMany('Industries', [
            'joinTable' => 'ApplicantIndustries',
            'className' => 'DictionaryIndustries',
            'foreignKey' => 'applicant_id',
            'targetForeignKey' => 'dictionary_industry_id',
        ]);

        $this->hasMany('ApplicantIndustries');
        $this->hasMany('ApplicantDesirableCountries');
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator)
    {
        $validator
            ->allowEmpty('id', 'create');

        $validator
            ->scalar('latin_name')
            ->maxLength('latin_name', 80)
            ->requirePresence('latin_name', 'create')
            ->notEmpty('latin_name');

        $validator
            ->scalar('latin_surname')
            ->maxLength('latin_surname', 80)
            ->requirePresence('latin_surname', 'create')
            ->notEmpty('latin_surname');

        // $validator
        //     ->scalar('latin_patronym')
        //     ->maxLength('latin_patronym', 80)
        //     ->requirePresence('latin_patronym', 'create')
        //     ->notEmpty('latin_patronym');

        $validator
            ->scalar('sex')
            ->maxLength('sex', 1)
            ->requirePresence('sex', 'create')
            ->inList('sex', ['M', 'F'])
            ->notEmpty('sex');

        $validator
            ->date('birth_date', 'dmy')
            ->requirePresence('birth_date', 'true')
            ->notEmpty('birth_date');

        $validator
            ->scalar('address_extended')
            ->maxLength('address_extended', 240)
            ->allowEmpty('address_extended');

        $validator
            ->scalar('is_archive')
            ->maxLength('is_archive', 1)
            ->inList('is_archive', ['Y', 'N'])
            ->allowEmpty('is_archive');

        $validator
            ->requirePresence('created_by', 'create')
            ->notEmpty('created_by');

        $validator
            ->requirePresence('modified_by', 'create')
            ->notEmpty('modified_by');

        // $validator
        //     ->scalar('document_seria_number')
        //     ->regex('document_seria_number', '/^[A-Za-z]{2}\d{7}$/')
        //     ->maxLength('document_seria_number', 20)
        //     ->requirePresence('document_seria_number', 'create')
        //     ->notEmpty('document_seria_number');

        $validator->allowEmpty('professional_skills');

        $validator->integer('address_region_id')
            ->requirePresence('address_region_id');

        $validator->integer('address_district_id')
            ->requirePresence('address_district_id');

        $validator->integer('education_level_id')
            ->requirePresence('education_level_id');

        $validator->isArray('industries._ids');

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules)
    {
        $rules->add($rules->existsIn(['address_country_id'], 'DictionaryCountries'));
        $rules->add($rules->existsIn(['address_region_id'], 'DictionaryRegions'));
        $rules->add($rules->existsIn(['address_district_id'], 'DictionaryDistricts'));
        $rules->add($rules->existsIn(['education_level_id'], 'DictionaryEducationLevels'));
        //$rules->add($rules->existsIn(['industry_id'], 'DictionaryIndustries'));

        return $rules;
    }

    protected function _initializeSchema(TableSchema $schema)
    {
        $schema->setColumnType('professional_skills', 'json');
        return $schema;
    }

    public function beforeSave(Event $event, EntityInterface $entity, \ArrayObject $options)
    {
        // $date = \DateTime::createFromFormat('d-m-Y', $entity->birth_date);
        // $entity->birth_date = $date->format('Y-m-d');
    }

    public function getBirthDateDays()
    {
        $days = [];
        for($i=1; $i<=31; $i++)
        {
            $days[$i] = $i;
        }
        return $days;
    }

    public function getBirthDateMonths()
    {
        return [
            '1' => __('Январь'),
            '2' => __('Февраль'),
            '3' => __('Март'),
            '4' => __('Апрель'),
            '5' => __('Май'),
            '6' => __('Июнь'),
            '7' => __('Июль'),
            '8' => __('Август'),
            '9' => __('Сентябрь'),
            '10' => __('Октябрь'),
            '11' => __('Ноябрь'),
            '12' => __('Декабрь')
        ];
    }

    public function getBirthDateYears()
    {
        $years = [];
        $startYear = (new Date("-16 years"))->year;
        $endYear = (new Date("-65 years"))->year;
        for($i=$startYear; $i>=$endYear; $i--)
        {
            $years[$i] = $i;
        }
        return $years;
    }

    public function getSexList()
    {
        return [
            'M' => __('М'),
            'F' => __('Ж'),
        ];
    }

    public function registerApplicant(Applicant $applicant, array $data, $userId)
    {
        $data = $this->appendIndustriesIfEmpty($data);
        $data = $this->appendDesirableCountriesIfEmpty($data);

        $applicant = $this->patchEntity($applicant, $data, [
            'associated' => ['DesirableCountries._joinData', 'UndesirableCountries._joinData', 'Industries._joinData']
        ]);
        $applicant->created_by = $userId;
        $applicant->modified_by = $userId;

        array_map(function($country) use($userId) {

            $country->_joinData = new Entity([
                'created_by' => $userId,
                'modified_by' => $userId
            ], ['markNew' => true]);

        }, $applicant->desirable_countries);

        array_map(function($country) use($userId) {

            $country->_joinData = new Entity([
                'created_by' => $userId,
                'modified_by' => $userId
            ], ['markNew' => true]);

        }, $applicant->undesirable_countries);
        array_map(function($industry) use($userId) {

            $industry->_joinData = new Entity([
                'created_by' => $userId,
                'modified_by' => $userId
            ], ['markNew' => true]);

        }, $applicant->industries);

        if($this->save($applicant)) {
            return true;
        } else {
            return false;
        }
    }

    public function updateApplicant(Applicant $applicant, $data, $userId)
    {
        $data = $this->appendIndustriesIfEmpty($data);
        $data = $this->appendDesirableCountriesIfEmpty($data);
        //dd($data);
        $applicant = $this->patchEntity($applicant, $data);
        //dd($applicant);
        array_map(function($country) use($userId) {

            $country->_joinData = new Entity([
                'created_by' => $userId,
                'modified_by' => $userId
            ], ['markNew' => true]);

        }, $applicant->desirable_countries);

        array_map(function($country) use($userId) {

            $country->_joinData = new Entity([
                'created_by' => $userId,
                'modified_by' => $userId
            ], ['markNew' => true]);

        }, $applicant->undesirable_countries);
        array_map(function($industry) use($userId) {

            $industry->_joinData = new Entity([
                'created_by' => $userId,
                'modified_by' => $userId
            ], ['markNew' => true]);

        }, $applicant->industries);

        if($this->save($applicant)) {
            return true;
        } else {
            return false;
        }
    }

    private function appendIndustriesIfEmpty($data)
    {
        if(empty($data['industries']['_ids'])) {
            $industries = $this->Industries->find('list', ['limit' => 200])->toArray();
            $data['industries']['_ids'] = array_keys($industries);
        }

        return $data;
    }

    private function appendDesirableCountriesIfEmpty($data)
    {
        if(empty($data['desirable_countries']['_ids'])) {
            $countries = $this->DictionaryCountries->find('list', ['limit' => 200])->toArray();
            $countriesIds = array_keys($countries);

            if(!empty($data['undesirable_countries']['_ids'])) {
                $data['desirable_countries']['_ids'] = array_diff($countriesIds, $data['undesirable_countries']['_ids']);
            } else {
                $data['desirable_countries']['_ids'] = $countriesIds;
            }
        }
        return $data;
    }

    public function getSearchConditions(array $data)
    {

        $conditions = [];
        $filters = new RulesSet($data);

        if(empty($data['age_from'])) {
            $dateFrom = new Date('-16 years');
        } else {
            $age = $data['age_from'];
            $dateFrom = new Date('-'.$age.' years');
        }

        if (empty($data['age_to'])) {
            $dateTo = new Date('-100 years');
        } else {
            $age = $data['age_to'];
            $dateTo = new Date('-'.$age.' years');
        }

        $filters->mergeOperator('AND',[
            new ValueRule('birth_date','>=',$dateTo),
            new ValueRule('birth_date','<=',$dateFrom),
        ]);
        
        $filters
            ->add(new AttributeRule('address_region_id','IN','region_id'))
            ->add(new AttributeRule('address_district_id','IN','district_id'))
            ->add(new AttributeRule('education_level_id','IN','education_level_id'))
            ->add(new AttributeRule('sex','=','sex'));
            // ->add(new AttributeRule('Industries.id','IN','industry_id'))
            // ->add(new AttributeRule('DesirableCountries.id','IN','desirable_country_id'));

        // dd($filters->get());
        
        return $filters->get();
    }
}
