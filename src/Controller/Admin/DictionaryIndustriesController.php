<?php
namespace App\Controller\Admin;

use App\Controller\AppController;

/**
 * DictionaryIndustries Controller
 *
 * @property \App\Model\Table\DictionaryIndustriesTable $DictionaryIndustries
 *
 * @method \App\Model\Entity\DictionaryIndustry[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class DictionaryIndustriesController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $dictionaryIndustries = $this->paginate($this->DictionaryIndustries);

        $this->set(compact('dictionaryIndustries'));
    }

    /**
     * View method
     *
     * @param string|null $id Dictionary Industry id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $dictionaryIndustry = $this->DictionaryIndustries->get($id, [
            'contain' => []
        ]);

        $this->set('dictionaryIndustry', $dictionaryIndustry);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $dictionaryIndustry = $this->DictionaryIndustries->newEntity();
        if ($this->request->is('post')) {
            $dictionaryIndustry = $this->DictionaryIndustries->patchEntity($dictionaryIndustry, $this->request->getData());
            $userId = $this->Auth->user('id');
            $dictionaryIndustry->created_by = $userId;
            $dictionaryIndustry->modified_by = $userId;
            if ($this->DictionaryIndustries->save($dictionaryIndustry)) {
                $this->Flash->success(__('The dictionary industry has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The dictionary industry could not be saved. Please, try again.'));
        }
        $this->set(compact('dictionaryIndustry'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Dictionary Industry id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $dictionaryIndustry = $this->DictionaryIndustries->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $dictionaryIndustry = $this->DictionaryIndustries->patchEntity($dictionaryIndustry, $this->request->getData());
            $userId = $this->Auth->user('id');
            $dictionaryIndustry->created_by = $userId;
            $dictionaryIndustry->modified_by = $userId;
            if ($this->DictionaryIndustries->save($dictionaryIndustry)) {
                $this->Flash->success(__('The dictionary industry has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The dictionary industry could not be saved. Please, try again.'));
        }
        $this->set(compact('dictionaryIndustry'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Dictionary Industry id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $dictionaryIndustry = $this->DictionaryIndustries->get($id);
        if ($this->DictionaryIndustries->delete($dictionaryIndustry)) {
            $this->Flash->success(__('The dictionary industry has been deleted.'));
        } else {
            $this->Flash->error(__('The dictionary industry could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
