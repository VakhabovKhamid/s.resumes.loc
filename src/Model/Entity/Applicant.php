<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Applicant Entity
 *
 * @property int $id
 * @property string $latin_name
 * @property string $latin_surname
 * @property string $latin_patronym
 * @property string $sex
 * @property \Cake\I18n\FrozenDate $birth_date
 * @property int $address_country_id
 * @property int $address_region_id
 * @property int $address_district_id
 * @property string $address_extended
 * @property int $education_level_id
 * @property int $industry_id
 * @property string $professional_skills
 * @property string $desirable_countries
 * @property string $undesirable_countries
 * @property string $is_archive
 * @property \Cake\I18n\FrozenTime $created
 * @property int $created_by
 * @property \Cake\I18n\FrozenTime $modified
 * @property int $modified_by
 *
 * @property \App\Model\Entity\DictionaryCountry $dictionary_country
 * @property \App\Model\Entity\DictionaryRegion $dictionary_region
 * @property \App\Model\Entity\DictionaryDistrict $dictionary_district
 * @property \App\Model\Entity\DictionaryEducationLevel $dictionary_education_level
 * @property \App\Model\Entity\DictionaryIndustry $dictionary_industry
 * @property \App\Model\Entity\ApplicantDocument[] $applicant_documents
 */
class Applicant extends Entity
{

    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array
     */
    protected $_accessible = [
        'latin_name' => true,
        'latin_surname' => true,
        'latin_patronym' => true,
        'sex' => true,
        'birth_date' => true,
        'address_country_id' => true,
        'address_region_id' => true,
        'address_district_id' => true,
        'address_extended' => true,
        'education_level_id' => true,
        'industry_id' => true,
        'professional_skills' => true,
        'desirable_countries' => true,
        'undesirable_countries' => true,
        'is_archive' => true,
        'created' => true,
        'created_by' => true,
        'modified' => true,
        'modified_by' => true,
        'dictionary_country' => true,
        'dictionary_region' => true,
        'dictionary_district' => true,
        'dictionary_education_level' => true,
        'dictionary_industry' => true,
        'applicant_documents' => true
    ];
}
