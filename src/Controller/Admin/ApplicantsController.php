<?php
namespace App\Controller\Admin;

use App\Controller\AppController;

/**
 * Applicants Controller
 *
 * @property \App\Model\Table\ApplicantsTable $Applicants
 *
 * @method \App\Model\Entity\Applicant[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ApplicantsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['DictionaryCountries', 'DictionaryRegions', 'DictionaryDistricts', 'DictionaryEducationLevels', 'DictionaryIndustries']
        ];
        $applicants = $this->paginate($this->Applicants);

        $this->set(compact('applicants'));
    }

    /**
     * View method
     *
     * @param string|null $id Applicant id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $applicant = $this->Applicants->get($id, [
            'contain' => ['DictionaryCountries', 'DictionaryRegions', 'DictionaryDistricts', 'DictionaryEducationLevels', 'DictionaryIndustries', 'ApplicantDocuments']
        ]);

        $this->set('applicant', $applicant);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $applicant = $this->Applicants->newEntity();
        if ($this->request->is('post')) {
            $applicant = $this->Applicants->patchEntity($applicant, $this->request->getData());
            $userId = $this->Auth->user('id');
            $applicant->created_by = $userId;
            $applicant->modified_by = $userId;
            if ($this->Applicants->save($applicant)) {
                $this->Flash->success(__('The applicant has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The applicant could not be saved. Please, try again.'));
        }
        $dictionaryCountries = $this->Applicants->DictionaryCountries->find('list', ['limit' => 200]);
        $dictionaryRegions = $this->Applicants->DictionaryRegions->find('list', ['limit' => 200]);
        $dictionaryDistricts = $this->Applicants->DictionaryDistricts->find('list', ['limit' => 200]);
        $dictionaryEducationLevels = $this->Applicants->DictionaryEducationLevels->find('list', ['limit' => 200]);
        $dictionaryIndustries = $this->Applicants->DictionaryIndustries->find('list', ['limit' => 200]);
        $this->set(compact('applicant', 'dictionaryCountries', 'dictionaryRegions', 'dictionaryDistricts', 'dictionaryEducationLevels', 'dictionaryIndustries'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Applicant id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $applicant = $this->Applicants->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $applicant = $this->Applicants->patchEntity($applicant, $this->request->getData());
            if ($this->Applicants->save($applicant)) {
                $this->Flash->success(__('The applicant has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The applicant could not be saved. Please, try again.'));
        }
        $dictionaryCountries = $this->Applicants->DictionaryCountries->find('list', ['limit' => 200]);
        $dictionaryRegions = $this->Applicants->DictionaryRegions->find('list', ['limit' => 200]);
        $dictionaryDistricts = $this->Applicants->DictionaryDistricts->find('list', ['limit' => 200]);
        $dictionaryEducationLevels = $this->Applicants->DictionaryEducationLevels->find('list', ['limit' => 200]);
        $dictionaryIndustries = $this->Applicants->DictionaryIndustries->find('list', ['limit' => 200]);
        $this->set(compact('applicant', 'dictionaryCountries', 'dictionaryRegions', 'dictionaryDistricts', 'dictionaryEducationLevels', 'dictionaryIndustries'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Applicant id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $applicant = $this->Applicants->get($id);
        if ($this->Applicants->delete($applicant)) {
            $this->Flash->success(__('The applicant has been deleted.'));
        } else {
            $this->Flash->error(__('The applicant could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
