<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Token Entity
 *
 * @property int $id
 * @property int $user_id
 * @property string $token
 * @property \Cake\I18n\FrozenTime $expire
 * @property \Cake\I18n\FrozenTime $created
 * @property int $created_by
 * @property string $phone
 */
class Token extends Entity
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
        'token' => true,
        'expire' => true,
        'created' => true,
        'created_by' => true,
        'phone' => true,
        'user_id' => true,
    ];

    /**
     * Fields that are excluded from JSON versions of the entity.
     *
     * @var array
     */
    protected $_hidden = [
        'token'
    ];
}
