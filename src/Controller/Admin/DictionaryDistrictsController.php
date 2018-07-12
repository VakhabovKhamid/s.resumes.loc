<?php
namespace App\Controller\Admin;

use App\Controller\AppController;

/**
 * DictionaryDistricts Controller
 *
 * @property \App\Model\Table\DictionaryDistrictsTable $DictionaryDistricts
 *
 * @method \App\Model\Entity\DictionaryDistrict[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class DictionaryDistrictsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['DictionaryRegions']
        ];
        $dictionaryDistricts = $this->paginate($this->DictionaryDistricts);

        $this->set(compact('dictionaryDistricts'));
    }

    /**
     * View method
     *
     * @param string|null $id Dictionary District id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $dictionaryDistrict = $this->DictionaryDistricts->get($id, [
            'contain' => ['DictionaryRegions']
        ]);

        $this->set('dictionaryDistrict', $dictionaryDistrict);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $dictionaryDistrict = $this->DictionaryDistricts->newEntity();
        if ($this->request->is('post')) {
            $dictionaryDistrict = $this->DictionaryDistricts->patchEntity($dictionaryDistrict, $this->request->getData());
            if ($this->DictionaryDistricts->save($dictionaryDistrict)) {
                $this->Flash->success(__('The dictionary district has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The dictionary district could not be saved. Please, try again.'));
        }
        $dictionaryRegions = $this->DictionaryDistricts->DictionaryRegions->find('list', ['limit' => 200]);
        $this->set(compact('dictionaryDistrict', 'dictionaryRegions'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Dictionary District id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $dictionaryDistrict = $this->DictionaryDistricts->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $dictionaryDistrict = $this->DictionaryDistricts->patchEntity($dictionaryDistrict, $this->request->getData());
            if ($this->DictionaryDistricts->save($dictionaryDistrict)) {
                $this->Flash->success(__('The dictionary district has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The dictionary district could not be saved. Please, try again.'));
        }
        $dictionaryRegions = $this->DictionaryDistricts->DictionaryRegions->find('list', ['limit' => 200]);
        $this->set(compact('dictionaryDistrict', 'dictionaryRegions'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Dictionary District id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $dictionaryDistrict = $this->DictionaryDistricts->get($id);
        if ($this->DictionaryDistricts->delete($dictionaryDistrict)) {
            $this->Flash->success(__('The dictionary district has been deleted.'));
        } else {
            $this->Flash->error(__('The dictionary district could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
