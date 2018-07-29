<?php
namespace App\Controller\Api;

use App\Controller\AppController;
use Cake\I18n\Date;
use Cake\ORM\Locator\TableLocator;
use App\Lib\QueryFilter\RulesSet;
use App\Lib\QueryFilter\Rules\AttributeRule;
use App\Lib\QueryFilter\Rules\ValueRule;

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

        $industriesRules = new RulesSet($data);
        $industriesRules->add(new AttributeRule(
            'ApplicantIndustries.dictionary_industry_id',
            'IN',
            'industry_id'
        ));
        $industriesRules = $industriesRules->get();
        
        $desirableCountriesRules = new RulesSet($data);
        $desirableCountriesRules->add(new AttributeRule(
            'ApplicantDesirableCountries.dictionary_country_id',
            'IN',
            'desirable_country_id'
        ));
        $desirableCountriesRules = $desirableCountriesRules->get();

        $query = $this->Applicants->find()
            ->contain([
                'DictionaryCountries',
                'DictionaryRegions',
                'DictionaryDistricts',
                'DictionaryEducationLevels',
                'DesirableCountries',
                'Industries',
                // 'ApplicantDocuments',
                // 'UndesirableCountries',
                'Users' => ['Tokens']
            ], true)
            ->innerJoinWith('ApplicantIndustries',function($q) use (&$industriesRules){
                if(count($industriesRules) > 0){
                    $q->where($industriesRules);
                }
                return $q;
            })
            ->innerJoinWith('ApplicantDesirableCountries',function($q) use(&$desirableCountriesRules){
                if(count($desirableCountriesRules) > 0){
                    $q->where($desirableCountriesRules);
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
        
        $industriesRules = new RulesSet($data);
        $industriesRules->add(new AttributeRule(
            'ApplicantIndustries.dictionary_industry_id',
            'IN',
            'industry_id'
        ));
        $industriesRules = $industriesRules->get();
        
        $desirableCountriesRules = new RulesSet($data);
        $desirableCountriesRules->add(new AttributeRule(
            'ApplicantDesirableCountries.dictionary_country_id',
            'IN',
            'desirable_country_id'
        ));
        $desirableCountriesRules = $desirableCountriesRules->get();
        
        // dd($desirableCountriesRules);
        $query = $this->Applicants->find()
            ->contain([
                'DictionaryCountries',
                'DictionaryRegions',
                'DictionaryDistricts',
                'DictionaryEducationLevels',
                'DesirableCountries' => [
                    'strategy' => 'subquery'
                ],
                'Industries' => [
                    'strategy' => 'subquery'
                ],
                // 'ApplicantDocuments',
                // 'UndesirableCountries',
                'Users' => ['Tokens']
            ], true)
            ->innerJoinWith('ApplicantIndustries',function($q) use (&$industriesRules){
                if(count($industriesRules) > 0){
                    $q->where($industriesRules);
                }
                return $q;
            })
            ->innerJoinWith('ApplicantDesirableCountries',function($q) use(&$desirableCountriesRules){
                if(count($desirableCountriesRules) > 0){
                    $q->where($desirableCountriesRules);
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
