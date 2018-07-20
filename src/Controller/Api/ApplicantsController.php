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
                'DesirableCountries',
                'UndesirableCountries',
                'Industries',
                'ApplicantDocuments',
                'Users' => ['Tokens']
            ])
            ->where($searchConditions);

        $applicants = $this->paginate($query);

        $this->set(compact('applicants'));
        $this->set('_serialize', ['applicants']);
    }
}
