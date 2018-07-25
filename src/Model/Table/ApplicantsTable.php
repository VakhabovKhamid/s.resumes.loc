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

        $this->belongsToMany('DesirableCountries', [
            'through' => 'ApplicantDesirableCountries',
            'className' => 'DictionaryCountries',
            'targetForeignKey' => 'dictionary_country_id',
        ]);

        $this->belongsToMany('UndesirableCountries', [
            'through' => 'ApplicantUndesirableCountries',
            'className' => 'DictionaryCountries',
            'targetForeignKey' => 'dictionary_country_id',
        ]);

        $this->belongsToMany('Industries', [
            'through' => 'ApplicantIndustries',
            'className' => 'DictionaryIndustries',
            'targetForeignKey' => 'dictionary_industry_id',
        ]);
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
            '1' => __('January'),
            '2' => __('February'),
            '3' => __('March'),
            '4' => __('April'),
            '5' => __('May'),
            '6' => __('June'),
            '7' => __('Jule'),
            '8' => __('August'),
            '9' => __('September'),
            '10' => __('October'),
            '11' => __('November'),
            '12' => __('December')
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
//dd($data);

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

    public function updateApplicant(Applicant $applicant, $userId)
    {
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

    public function getSearchConditions(array $data)
    {
        $conditions = [];
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

        $conditions['AND'] = [
            'birth_date >=' => $dateTo,
            'birth_date <=' => $dateFrom
        ];

        if(!empty($data['region_id'])) {
            $conditions['address_region_id IN'] = $data['region_id'];
        }

        if(!empty($data['district_id'])) {
            $conditions['address_district_id IN'] = $data['district_id'];
        }

        /*if(!empty($data['industry_id'])) {
            $conditions['Industries.id IN'] = $data['industry_id'];
        }*/

        if(!empty($data['education_level_id'])) {
            $conditions['education_level_id IN'] = array_map(function($level){return (int)$level; }, $data['education_level_id']);
        }

        if(!empty($data['sex'])) {
            $conditions['sex'] = $data['sex'];
        }

        return $conditions;
    }
}
