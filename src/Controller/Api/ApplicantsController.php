<?php
namespace App\Controller\Api;

use App\Controller\AppController;
use Cake\I18n\Date;
use Cake\ORM\Locator\TableLocator;

/**
 * Applicants Controller
 *
 * @property \App\Model\Table\ApplicantsTable $Applicants
 *
 * @method \App\Model\Entity\Applicant[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ApplicantsController extends AppController
{
    public function initialize()
    {
        parent::initialize();

        $this->loadComponent('RequestHandler');
        $this->loadComponent('BryanCrowe/ApiPagination.ApiPagination');
        $this->Auth->allow();
    }

    public function search()
    {
        if($this->request->is('ajax')) {
            $this->response->withDisabledCache();

            $data = $this->request->getData();
            $searchConditions = $this->Applicants->getSearchConditions($data);


            //dd($industries);
            $query = $this->Applicants->find()
                //->distinct('*')
                ->contain([
                    //'DictionaryCountries',
                    'DictionaryRegions',
                    'DictionaryDistricts',
                    'DictionaryEducationLevels',
                    'DesirableCountries',
                    'UndesirableCountries',
                    'Industries',
                    'ApplicantDocuments',
                    'Users' => ['Tokens']
                ])
                ->where($searchConditions);
            if(!empty($data['industry_id'])){
                $industries = array_map(function($val){ return (int)$val;}, $data['industry_id']);
                $query = $query->leftJoinWith('Industries')->where(['Industries.id IN' => $industries]);
            }

            /*$query = $this->Applicants->find()
                ->distinct('Applicants')
                ->matching('Industries', function ($q) use ($industries) {
                return $q->where(['Industries.id IN' => $industries]);
            });*/

            /*$query = $this->Applicants->find()->contain('Industries', function ($q) use ($industries) {
                return $q
                    ->select(['Industries.id'])
                    ->where(['Industries.id IN' => $industries]);
            });*/



            $this->paginate = [
                'limit' => 2,
            ];
            //dd($query->sql());
            /*$this->paginate = [
                'conditions' => $searchConditions,
                'contain' => [
                    //'DictionaryCountries',
                    'DictionaryRegions',
                    'DictionaryDistricts',
                    'DictionaryEducationLevels',
                    'DesirableCountries',
                    'UndesirableCountries',
                    'Industries',
                    'ApplicantDocuments',
                    'Users' => ['Tokens']
                ],
                'limit' => 2,
            ];*/
            $applicants = $this->paginate($query);

            //dd($applicants);
            //TODO Delete this code
            /*$countries = $this->Applicants->DictionaryCountries;
            foreach ($applicants as $applicant) {
                $applicant->desirable_countries = $countries->findById($applicant->desirable_countries);
                $applicant->undesirable_countries = $countries->findById($applicant->undesirable_countries);
            }*/

            $this->set(compact('applicants'));
            $this->set('_serialize', ['applicants']);
        }
    }
}
