<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Gift Entity.
 */
class Gift extends Entity
{

    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * @var array
     */
    protected $_accessible = [
        'task_id' => true,
        'user_id' => true,
        'credits' => true,
        'points' => true,
        'task' => true,
        'user' => true,
    ];
}
