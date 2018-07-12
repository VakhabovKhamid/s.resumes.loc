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
    }

    public function search()
    {
        if($this->request->is('ajax')) {
            $this->response->disableCache();

            $data = $this->request->getData();
            $searchConditions = $this->Applicants->getSearchConditions($data);

            $this->paginate = [
                'contain' => ['DictionaryCountries', 'DictionaryRegions', 'DictionaryDistricts', 'DictionaryEducationLevels', 'DictionaryIndustries', 'ApplicantDocuments', 'Users'],
                'conditions' => $searchConditions
            ];
            $applicants = $this->paginate($this->Applicants);
            //TODO Delete this code
            $countries = $this->Applicants->DictionaryCountries;
            foreach ($applicants as $applicant) {
                $applicant->desirable_countries = $countries->findById($applicant->desirable_countries);
                $applicant->undesirable_countries = $countries->findById($applicant->undesirable_countries);
            }

            $this->set(compact('applicants'));
            $this->set('_serialize', ['applicants']);
        }
    }
}
