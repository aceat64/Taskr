<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Completion Entity.
 */
class Completion extends Entity
{

    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * @var array
     */
    protected $_accessible = [
        'task_id' => true,
        'user_id' => true,
        'task' => true,
        'user' => true,
        'flags' => true,
    ];
}
