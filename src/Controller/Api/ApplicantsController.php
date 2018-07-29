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
class ApplicantsController extends ApiController
{
    public function initialize()
    {
        parent::initialize();

        $this->loadComponent('RequestHandler');
        $this->loadComponent('BryanCrowe/ApiPagination.ApiPagination');
    }

    public function search()
    {
        $this->response->withDisabledCache();

        $data = $this->request->getData();
        
        $searchConditions = $this->Applicants->getSearchConditions($data);
        
        $query = $this->Applicants->find()
            ->contain([
                //'DictionaryCountries',
                'DictionaryRegions',
                'DictionaryDistricts',
                'DictionaryEducationLevels',
                // 'ApplicantDocuments',
                'DesirableCountries',
                'Industries',
                //'UndesirableCountries',
                'Users' => ['Tokens']
            ], true)
            ->innerJoinWith('ApplicantIndustries',function($q) use ($data){
                if(!empty($data['industry_id'])){
					$q->where(['dictionary_industry_id IN' => $data['industry_id']]);
                }
                return $q;
            })
            ->innerJoinWith('ApplicantDesirableCountries',function($q) use($data){
                if(!empty($data['desirable_country_id'])){
                    $q->where(['dictionary_country_id IN' => $data['desirable_country_id']]);
                }
                return $q;
            })
            ->distinct()
            ->where($searchConditions);
			
        $applicants = $this->paginate($query);
		
        $this->set(compact('applicants'));
        $this->set('_serialize', ['applicants']);
    }

    public function fullList()
    {
        $this->response->withDisabledCache();

        $data = $this->request->getData();
        
        $searchConditions = $this->Applicants->getSearchConditions($data);
        
        $query = $this->Applicants->find()
            ->contain([
                //'DictionaryCountries',
                'DictionaryRegions',
                'DictionaryDistricts',
                'DictionaryEducationLevels',
                'DesirableCountries',
                'UndesirableCountries',
                'Industries',
                // 'ApplicantDocuments',
                'Users' => ['Tokens']
            ], true)
            ->innerJoinWith('ApplicantIndustries',function($q) use ($data){
                if(!empty($data['industry_id'])){
					$q->where(['dictionary_industry_id IN' => $data['industry_id']]);
                }
                return $q;
            })
            ->innerJoinWith('ApplicantDesirableCountries',function($q) use($data){
                if(!empty($data['desirable_country_id'])){
                    $q->where(['dictionary_country_id IN' => $data['desirable_country_id']]);
                }
                return $q;
            })
            ->distinct()
            ->where($searchConditions);
			
        $applicants = $query->all();
		
        $this->set(compact('applicants'));
        $this->set('_serialize', ['applicants']);
    }
}
