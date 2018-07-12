<?php
namespace App\Controller\Admin;

use App\Controller\AppController;

/**
 * DictionaryRegions Controller
 *
 * @property \App\Model\Table\DictionaryRegionsTable $DictionaryRegions
 *
 * @method \App\Model\Entity\DictionaryRegion[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class DictionaryRegionsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $dictionaryRegions = $this->paginate($this->DictionaryRegions);

        $this->set(compact('dictionaryRegions'));
    }

    /**
     * View method
     *
     * @param string|null $id Dictionary Region id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $dictionaryRegion = $this->DictionaryRegions->get($id, [
            'contain' => []
        ]);

        $this->set('dictionaryRegion', $dictionaryRegion);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $dictionaryRegion = $this->DictionaryRegions->newEntity();
        if ($this->request->is('post')) {
            $dictionaryRegion = $this->DictionaryRegions->patchEntity($dictionaryRegion, $this->request->getData());
            if ($this->DictionaryRegions->save($dictionaryRegion)) {
                $this->Flash->success(__('The dictionary region has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The dictionary region could not be saved. Please, try again.'));
        }
        $this->set(compact('dictionaryRegion'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Dictionary Region id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $dictionaryRegion = $this->DictionaryRegions->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $dictionaryRegion = $this->DictionaryRegions->patchEntity($dictionaryRegion, $this->request->getData());
            if ($this->DictionaryRegions->save($dictionaryRegion)) {
                $this->Flash->success(__('The dictionary region has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The dictionary region could not be saved. Please, try again.'));
        }
        $this->set(compact('dictionaryRegion'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Dictionary Region id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $dictionaryRegion = $this->DictionaryRegions->get($id);
        if ($this->DictionaryRegions->delete($dictionaryRegion)) {
            $this->Flash->success(__('The dictionary region has been deleted.'));
        } else {
            $this->Flash->error(__('The dictionary region could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
