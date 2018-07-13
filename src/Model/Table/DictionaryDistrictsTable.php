<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * DictionaryDistricts Model
 *
 * @property \App\Model\Table\DictionaryRegionsTable|\Cake\ORM\Association\BelongsTo $DictionaryRegions
 *
 * @method \App\Model\Entity\DictionaryDistrict get($primaryKey, $options = [])
 * @method \App\Model\Entity\DictionaryDistrict newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\DictionaryDistrict[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\DictionaryDistrict|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\DictionaryDistrict|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\DictionaryDistrict patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\DictionaryDistrict[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\DictionaryDistrict findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class DictionaryDistrictsTable extends Table
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

        $this->setTable('dictionary_districts');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('DictionaryRegions', [
            'foreignKey' => 'region_id',
            'joinType' => 'INNER'
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
            ->scalar('name_uz_c')
            ->maxLength('name_uz_c', 80)
            ->requirePresence('name_uz_c', 'create')
            ->notEmpty('name_uz_c');

        $validator
            ->scalar('name_uz_l')
            ->maxLength('name_uz_l', 80)
            ->requirePresence('name_uz_l', 'create')
            ->notEmpty('name_uz_l');

        $validator
            ->scalar('name_ru_c')
            ->maxLength('name_ru_c', 80)
            ->requirePresence('name_ru_c', 'create')
            ->notEmpty('name_ru_c');

        $validator
            ->scalar('name_en_l')
            ->maxLength('name_en_l', 80)
            ->requirePresence('name_en_l', 'create')
            ->notEmpty('name_en_l');

        $validator
            ->scalar('name_qr_c')
            ->maxLength('name_qr_c', 80)
            ->requirePresence('name_qr_c', 'create')
            ->notEmpty('name_qr_c');

        $validator
            ->scalar('name_qr_l')
            ->maxLength('name_qr_l', 80)
            ->requirePresence('name_qr_l', 'create')
            ->notEmpty('name_qr_l');

        $validator
            ->scalar('is_active')
            ->maxLength('is_active', 1)
            ->requirePresence('is_active', 'create')
            ->notEmpty('is_active');

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
        $rules->add($rules->existsIn(['region_id'], 'DictionaryRegions'));

        return $rules;
    }
}
