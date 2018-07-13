<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * ApplicantIndustry Entity
 *
 * @property int $id
 * @property int $applicant_id
 * @property int $dictionary_industry_id
 * @property \Cake\I18n\FrozenTime $created
 * @property int $created_by
 * @property \Cake\I18n\FrozenTime $modified
 * @property int $modified_by
 *
 * @property \App\Model\Entity\Applicant $applicant
 * @property \App\Model\Entity\DictionaryIndustry $dictionary_industry
 */
class ApplicantIndustry extends Entity
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
        'applicant_id' => true,
        'dictionary_industry_id' => true,
        'created' => true,
        'created_by' => true,
        'modified' => true,
        'modified_by' => true,
        'applicant' => true,
        'dictionary_industry' => true,
        '_joinData' => true,
    ];
}
