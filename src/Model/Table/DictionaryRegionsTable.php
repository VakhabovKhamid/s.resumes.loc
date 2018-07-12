<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * DictionaryRegions Model
 *
 * @method \App\Model\Entity\DictionaryRegion get($primaryKey, $options = [])
 * @method \App\Model\Entity\DictionaryRegion newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\DictionaryRegion[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\DictionaryRegion|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\DictionaryRegion|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\DictionaryRegion patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\DictionaryRegion[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\DictionaryRegion findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class DictionaryRegionsTable extends Table
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

        $this->setTable('dictionary_regions');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');
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
}
