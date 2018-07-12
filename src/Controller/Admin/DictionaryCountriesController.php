<?php
namespace App\Controller\Admin;

use App\Controller\AppController;

/**
 * DictionaryCountries Controller
 *
 * @property \App\Model\Table\DictionaryCountriesTable $DictionaryCountries
 *
 * @method \App\Model\Entity\DictionaryCountry[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class DictionaryCountriesController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $dictionaryCountries = $this->paginate($this->DictionaryCountries);

        $this->set(compact('dictionaryCountries'));
    }

    /**
     * View method
     *
     * @param string|null $id Dictionary Country id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $dictionaryCountry = $this->DictionaryCountries->get($id, [
            'contain' => []
        ]);

        $this->set('dictionaryCountry', $dictionaryCountry);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $dictionaryCountry = $this->DictionaryCountries->newEntity();
        if ($this->request->is('post')) {
            $dictionaryCountry = $this->DictionaryCountries->patchEntity($dictionaryCountry, $this->request->getData());
            if ($this->DictionaryCountries->save($dictionaryCountry)) {
                $this->Flash->success(__('The dictionary country has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The dictionary country could not be saved. Please, try again.'));
        }
        $this->set(compact('dictionaryCountry'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Dictionary Country id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $dictionaryCountry = $this->DictionaryCountries->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $dictionaryCountry = $this->DictionaryCountries->patchEntity($dictionaryCountry, $this->request->getData());
            if ($this->DictionaryCountries->save($dictionaryCountry)) {
                $this->Flash->success(__('The dictionary country has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The dictionary country could not be saved. Please, try again.'));
        }
        $this->set(compact('dictionaryCountry'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Dictionary Country id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $dictionaryCountry = $this->DictionaryCountries->get($id);
        if ($this->DictionaryCountries->delete($dictionaryCountry)) {
            $this->Flash->success(__('The dictionary country has been deleted.'));
        } else {
            $this->Flash->error(__('The dictionary country could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
