<?php
namespace App\Controller\Api;

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
        $applicants = ['msg'=>$this->Auth->User()];
        $this->set(compact('applicants'));
        $this->set('_serialize', 'applicants');

    }


    public function initialize(){
        parent::initialize();
        $this->loadComponent('RequestHandler');
        $this->loadModel('');
    }
}
