<?php
namespace App\Model\Table;

use App\Model\Entity\Applicant;
use Cake\I18n\Date;
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
        $this->belongsTo('DictionaryIndustries', [
            'foreignKey' => 'industry_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Users', [
            'foreignKey' => 'created_by',
            'joinType' => 'INNER'
        ]);
        $this->hasMany('ApplicantDocuments', [
            'foreignKey' => 'applicant_id'
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

        $validator
            ->scalar('latin_patronym')
            ->maxLength('latin_patronym', 80)
            ->allowEmpty('latin_patronym');

        $validator
            ->scalar('sex')
            ->maxLength('sex', 1)
            ->requirePresence('sex', 'create')
            ->notEmpty('sex');

        $validator
            ->date('birth_date')
            ->requirePresence('birth_date', 'create')
            ->notEmpty('birth_date');

        $validator
            ->scalar('address_extended')
            ->maxLength('address_extended', 240)
            ->allowEmpty('address_extended');

        $validator
            ->scalar('professional_skills')
            ->maxLength('professional_skills', 80)
            ->requirePresence('professional_skills', 'create')
            ->notEmpty('professional_skills');

        $validator
            ->scalar('desirable_countries')
            ->maxLength('desirable_countries', 4294967295)
            ->allowEmpty('desirable_countries');

        $validator
            ->scalar('undesirable_countries')
            ->maxLength('undesirable_countries', 4294967295)
            ->allowEmpty('undesirable_countries');

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
        $rules->add($rules->existsIn(['industry_id'], 'DictionaryIndustries'));

        return $rules;
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
            'M' => __('Мужской'),
            'F' => __('Женский'),
        ];
    }

    public function registerApplicant(Applicant $applicant, array $data, $userId)
    {
        $applicant = $this->patchEntity($applicant, $data, [
            'associated' => [
                'ApplicantDocuments' => [
                    'accessibleFields' => [
                        '*' => false,
                        'anchor' => true,
                        'name' => true,
                    ]
                ]
            ]
        ]);

        $applicant->created_by = $userId;
        $applicant->modified_by = $userId;
        array_map(function($document) use ($userId) {
            $document->created_by = $userId;
            $document->modified_by = $userId;
        }, $applicant->applicant_documents);

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
            $conditions['address_region_id'] = $data['region_id'];
        }

        if(!empty($data['district_id'])) {
            $conditions['address_district_id'] = $data['district_id'];
        }

        if(!empty($data['industry_id'])) {
            $conditions['industry_id'] = $data['industry_id'];
        }

        if(!empty($data['education_level_id'])) {
            $conditions['education_level_id'] = $data['education_level_id'];
        }

        if(!empty($data['sex'])) {
            $conditions['sex'] = $data['sex'];
        }

        return $conditions;
    }
}
