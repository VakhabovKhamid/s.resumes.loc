<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * DictionaryDistrict Entity
 *
 * @property int $id
 * @property int $region_id
 * @property string $name_uz_c
 * @property string $name_uz_l
 * @property string $name_ru_c
 * @property string $name_en_l
 * @property string $name_qr_c
 * @property string $name_qr_l
 * @property string $is_active
 * @property \Cake\I18n\FrozenTime $created
 * @property int $created_by
 * @property \Cake\I18n\FrozenTime $modified
 * @property int $modified_by
 *
 * @property \App\Model\Entity\DictionaryRegion $dictionary_region
 */
class DictionaryDistrict extends Entity
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
        'region_id' => true,
        'name_uz_c' => true,
        'name_uz_l' => true,
        'name_ru_c' => true,
        'name_en_l' => true,
        'name_qr_c' => true,
        'name_qr_l' => true,
        'is_active' => true,
        'created' => true,
        'created_by' => true,
        'modified' => true,
        'modified_by' => true,
        'dictionary_region' => true
    ];
}
