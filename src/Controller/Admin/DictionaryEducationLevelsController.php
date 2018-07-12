<?php
namespace App\Controller\Admin;

use App\Controller\AppController;

/**
 * DictionaryEducationLevels Controller
 *
 * @property \App\Model\Table\DictionaryEducationLevelsTable $DictionaryEducationLevels
 *
 * @method \App\Model\Entity\DictionaryEducationLevel[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class DictionaryEducationLevelsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $dictionaryEducationLevels = $this->paginate($this->DictionaryEducationLevels);

        $this->set(compact('dictionaryEducationLevels'));
    }

    /**
     * View method
     *
     * @param string|null $id Dictionary Education Level id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $dictionaryEducationLevel = $this->DictionaryEducationLevels->get($id, [
            'contain' => []
        ]);

        $this->set('dictionaryEducationLevel', $dictionaryEducationLevel);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $dictionaryEducationLevel = $this->DictionaryEducationLevels->newEntity();
        if ($this->request->is('post')) {
            $dictionaryEducationLevel = $this->DictionaryEducationLevels->patchEntity($dictionaryEducationLevel, $this->request->getData());
            $userId = $this->Auth->user('id');
            $dictionaryEducationLevel->created_by = $userId;
            $dictionaryEducationLevel->modified_by = $userId;
            if ($this->DictionaryEducationLevels->save($dictionaryEducationLevel)) {
                $this->Flash->success(__('The dictionary education level has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The dictionary education level could not be saved. Please, try again.'));
        }
        $this->set(compact('dictionaryEducationLevel'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Dictionary Education Level id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $dictionaryEducationLevel = $this->DictionaryEducationLevels->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $dictionaryEducationLevel = $this->DictionaryEducationLevels->patchEntity($dictionaryEducationLevel, $this->request->getData());
            $userId = $this->Auth->user('id');
            $dictionaryEducationLevel->created_by = $userId;
            $dictionaryEducationLevel->modified_by = $userId;
            if ($this->DictionaryEducationLevels->save($dictionaryEducationLevel)) {
                $this->Flash->success(__('The dictionary education level has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The dictionary education level could not be saved. Please, try again.'));
        }
        $this->set(compact('dictionaryEducationLevel'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Dictionary Education Level id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $dictionaryEducationLevel = $this->DictionaryEducationLevels->get($id);
        if ($this->DictionaryEducationLevels->delete($dictionaryEducationLevel)) {
            $this->Flash->success(__('The dictionary education level has been deleted.'));
        } else {
            $this->Flash->error(__('The dictionary education level could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
