<?php
/**
 * Created by PhpStorm.
 * User: ramil
 * Date: 12.07.18
 * Time: 13:55
 */

namespace App\Controller;


class ApplicantsController extends AppController
{

    public function registration()
    {
        $applicant = $this->Applicants->newEntity();
        if ($this->request->is('post')) {

            $userId = $this->request->getSession()->read('Auth.User.id');
            $data = $this->request->getData();
            if ($this->Applicants->registerApplicant($applicant, $data, $userId)) {
                $this->Flash->success(__('The applicant has been saved.'));

                return $this->redirect(['action' => 'preview']);
            }
            dd($applicant->getErrors());
            $this->Flash->error(__('The applicant could not be saved. Please, try again.'));
        }
        $countries = $this->Applicants->DictionaryCountries->find('list', ['limit' => 200]);
        $regions = $this->Applicants->DictionaryRegions->find('list', ['limit' => 200]);
        $districts = $this->Applicants->DictionaryDistricts->find('list', ['limit' => 200]);
        $educationLevels = $this->Applicants->DictionaryEducationLevels->find('list', ['limit' => 200]);
        $industries = $this->Applicants->Industries->find('list', ['limit' => 200]);
        $birthDateDays = $this->Applicants->getBirthDateDays();
        $birthDateMonths = $this->Applicants->getBirthDateMonths();
        $birthDateYears = $this->Applicants->getBirthDateYears();
        $sexList = $this->Applicants->getSexList();
        $this->set(compact(
                'applicant',
                'countries',
                'regions',
                'districts',
                'educationLevels',
                'industries',
                'birthDateDays',
                'birthDateMonths',
                'birthDateYears',
                'sexList'
            )
        );
    }

    public function preview()
    {
        $id = $this->request->getSession()->read('Auth.User.id');
        $applicant = $this->Applicants->find('all', [
            'contain' => [
                'DesirableCountries',
                'UndesirableCountries',
                'DictionaryRegions',
                'DictionaryDistricts',
                'DictionaryEducationLevels',
                'Industries',
                'ApplicantDocuments',
                'Users' => ['Tokens']
            ],
            'conditions' => [
                'Applicants.created_by' => $id
            ]
        ]);

        if(!$applicant->count()) {
            return $this->redirect(['action'=>'registration']);
        }
        $sexList = $this->Applicants->getSexList();
        $applicant = $applicant->toArray();
        $applicant = $applicant[0];
        $this->set(compact('applicant','sexList'));
    }

    public function delete()
    {
        $this->request->allowMethod(['post', 'delete']);

        $applicant = $this->Applicants->find()->where(['created_by' => $this->Auth->user('id')])->firstOrFail();
        if ($this->Applicants->delete($applicant)) {
            $this->Flash->success(__('The applicant has been deleted.'));
            return $this->redirect(['action' => 'registration']);
        } else {
            $this->Flash->error(__('The applicant could not be deleted. Please, try again.'));
            return $this->redirect(['action' => 'preview']);

        }
    }
}