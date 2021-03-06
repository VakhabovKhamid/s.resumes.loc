<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * ApplicantDocuments Model
 *
 * @property \App\Model\Table\ApplicantsTable|\Cake\ORM\Association\BelongsTo $Applicants
 *
 * @method \App\Model\Entity\ApplicantDocument get($primaryKey, $options = [])
 * @method \App\Model\Entity\ApplicantDocument newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\ApplicantDocument[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\ApplicantDocument|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\ApplicantDocument|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\ApplicantDocument patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\ApplicantDocument[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\ApplicantDocument findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class ApplicantDocumentsTable extends Table
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

        $this->setTable('applicant_documents');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->addBehavior('AuditUser');
        $this->addBehavior('Timestamp');
        $this->addBehavior('Josegonzalez/Upload.Upload', [
            'name' => [
                'path' => 'webroot'.DS.'uploads'.DS.'applicant_documents'.DS.'{field-value:created_by}',
                'transformer' => function (\Cake\Datasource\RepositoryInterface $table, \Cake\Datasource\EntityInterface $entity, $data, $field, $settings) {

                    $extension = pathinfo($data['name'], PATHINFO_EXTENSION);
                    $filename = md5($data['name'].microtime()).'.'.$extension; //hashed filename
                    $entity->path = DS.'uploads'.DS.'applicant_documents'.DS.$entity->created_by.DS.$filename;

                    return [$data['tmp_name'] => $filename];
                },
                'writer' => 'Josegonzalez\Upload\File\Writer\DefaultWriter'
            ]
        ]);

        $this->belongsTo('Applicants', [
            'foreignKey' => 'applicant_id',
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
            ->scalar('anchor')
            ->maxLength('anchor', 80)
            ->requirePresence('anchor', 'create')
            ->notEmpty('anchor');

        $validator
            ->uploadedFile('name', [
                'types' => [
                    'application/pdf',
                    'image/png',
                    'image/pjpeg',
                    'image/jpeg'
                ],
                'maxSize' => 10000000, // 10Mb
                'optional' => false,
            ]);

        $validator
            ->scalar('path')
            ->maxLength('path', 240)
            ->allowEmpty('path');

        $validator
            ->integer('created_by')
            ->requirePresence('created_by', 'create')
            ->notEmpty('created_by');

        $validator
            ->integer('modified_by')
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
        $rules->add($rules->existsIn(['applicant_id'], 'Applicants'));

        return $rules;
    }
}
