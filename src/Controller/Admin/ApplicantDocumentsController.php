<?php
namespace App\Controller\Admin;

use App\Controller\AppController;

/**
 * ApplicantDocuments Controller
 *
 * @property \App\Model\Table\ApplicantDocumentsTable $ApplicantDocuments
 *
 * @method \App\Model\Entity\ApplicantDocument[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ApplicantDocumentsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Applicants']
        ];
        $applicantDocuments = $this->paginate($this->ApplicantDocuments);

        $this->set(compact('applicantDocuments'));
    }

    /**
     * View method
     *
     * @param string|null $id Applicant Document id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $applicantDocument = $this->ApplicantDocuments->get($id, [
            'contain' => ['Applicants']
        ]);

        $this->set('applicantDocument', $applicantDocument);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $applicantDocument = $this->ApplicantDocuments->newEntity();
        if ($this->request->is('post')) {
            $applicantDocument = $this->ApplicantDocuments->patchEntity($applicantDocument, $this->request->getData());
            $userId = $this->Auth->user('id');
            $applicantDocument->created_by = $userId;
            $applicantDocument->modified_by = $userId;
            if ($this->ApplicantDocuments->save($applicantDocument)) {
                $this->Flash->success(__('The applicant document has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The applicant document could not be saved. Please, try again.'));
        }
        $applicants = $this->ApplicantDocuments->Applicants->find('list', ['limit' => 200]);
        $this->set(compact('applicantDocument', 'applicants'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Applicant Document id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $applicantDocument = $this->ApplicantDocuments->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $applicantDocument = $this->ApplicantDocuments->patchEntity($applicantDocument, $this->request->getData());
            $userId = $this->Auth->user('id');
            $applicantDocument->created_by = $userId;
            $applicantDocument->modified_by = $userId;
            if ($this->ApplicantDocuments->save($applicantDocument)) {
                $this->Flash->success(__('The applicant document has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The applicant document could not be saved. Please, try again.'));
        }
        $applicants = $this->ApplicantDocuments->Applicants->find('list', ['limit' => 200]);
        $this->set(compact('applicantDocument', 'applicants'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Applicant Document id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $applicantDocument = $this->ApplicantDocuments->get($id);
        if ($this->ApplicantDocuments->delete($applicantDocument)) {
            $this->Flash->success(__('The applicant document has been deleted.'));
        } else {
            $this->Flash->error(__('The applicant document could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
