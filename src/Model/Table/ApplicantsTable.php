<?php
namespace App\Model\Table;

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
            ->requirePresence('is_archive', 'create')
            ->notEmpty('is_archive');

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
}
