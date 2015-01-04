<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Flag Entity.
 */
class Flag extends Entity
{

    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * @var array
     */
    protected $_accessible = [
        'status' => true,
        'completion_id' => true,
        'user_id' => true,
        'description' => true,
        'completion' => true,
        'user' => true,
    ];
}
