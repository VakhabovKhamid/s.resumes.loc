<?php
/**
 * Created by PhpStorm.
 * User: ramil
 * Date: 16.07.18
 * Time: 18:01
 */

namespace App\Form;


use Cake\Event\EventManager;
use Cake\Form\Form;
use Cake\Form\Schema;
use Cake\Validation\Validator;

class SoliqUzPersonalDataRetrieveForm extends Form
{
    private $Taxpayers;

    public function __construct($Taxpayers, EventManager $eventManager = null)
    {
        parent::__construct($eventManager);
        $this->Taxpayers = $Taxpayers;
    }

    protected function _buildSchema(Schema $schema)
    {
        return $schema->addField('document_seria_number', 'string');
    }

    protected function _buildValidator(Validator $validator)
    {
        $validator
            ->scalar('document_seria_number')
            ->notEmpty('document_seria_number')
            ->regex('document_seria_number', '/^[A-Za-z]{2}[0-9]{7}$/');

    }

    protected function _execute(array $data)
    {
        $person = [];

        preg_match('/^([A-Z]{2})(\d+)$/', $data['document_seria_number'], $matches);

        $result = $this->Taxpayers->find('all', [
            'conditions' => [
                'Taxpayers.document_seria' => $matches[1],
                'Taxpayers.document_number' => $matches[2]
            ]
        ]);

        if($result) {
            $person = $result->first();
        }

        return $person;
    }

}