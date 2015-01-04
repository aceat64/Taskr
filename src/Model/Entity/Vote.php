<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Vote Entity.
 */
class Vote extends Entity
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
    ];
}
