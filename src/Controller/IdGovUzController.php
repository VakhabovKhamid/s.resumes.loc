<?php
namespace App\Controller;

use App\Controller\AppController;
use App\Form\SoliqUzPersonalDataRetrieveForm;
use Cake\Event\Event;

/**
 * IdGovUz Controller
 *
 *
 * @method \App\Model\Entity\IdGovUz[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class IdGovUzController extends AppController
{
    const HASH_KEY = 'E001|oDlpS4ZiwZEd5giUkMSxKXBIb9bOafcOJOBXRnzuVyepiReYCylXFRL4qz9gV';

    public function initialize()
    {
        parent::initialize();

        $this->loadComponent('RequestHandler');
        $this->modelFactory('Endpoint', ['Muffin\Webservice\Model\EndpointRegistry', 'get']);
    }

    public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event);

        $this->loadModel('Taxpayers', 'Endpoint');
    }

    public function retrievePersonalDataSoliqUz()
    {
        if($this->request->is('ajax')) {
            $person = [];
            $data = $this->request->getData();
            $soliqUzForm = new SoliqUzPersonalDataRetrieveForm($this->Taxpayers);
            if($soliqUzForm->validate($data)) {
                $person = $soliqUzForm->execute($data);
                unset($person['address']);
                unset($person['ns10_code']);
                unset($person['ns11_code']);
                unset($person['tin']);
            }

            $this->set(compact('person'));
            $this->set('_serialize', ['person']);
        }

    }
}
