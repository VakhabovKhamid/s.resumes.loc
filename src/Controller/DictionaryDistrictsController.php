<?php
/**
 * Created by PhpStorm.
 * User: ramil
 * Date: 13.07.18
 * Time: 14:38
 */

namespace App\Controller;


class DictionaryDistrictsController extends AppController
{
    public function initialize()
    {
        parent::initialize();

        $this->loadComponent('RequestHandler');
    }

    public function ajaxRegionDistricts()
    {
        if($this->request->is('ajax')) {
            $region_id = $this->request->getQuery('region_id');
            $districts = $this->DictionaryDistricts->find('list', [
                'conditions' => [
                    'DictionaryDistricts.region_id' => $region_id
                ]
            ])->toArray();
            $this->set(compact('districts'));
            $this->set('_serialize', ['districts']);
        }
    }
}