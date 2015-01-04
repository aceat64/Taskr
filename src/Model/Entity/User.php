<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;
use Cake\Auth\DefaultPasswordHasher;

/**
 * User Entity.
 */
class User extends Entity
{

    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * @var array
     */
    protected $_accessible = [
        'admin' => true,
        'username' => true,
        'password' => true,
        'email' => true,
        'display_name' => true,
        'credits' => true,
        'lifetime_points' => true,
        'votes_count' => false,
        //'comments' => true,
        //'completions' => true,
        //'flags' => true,
        //'gifts' => true,
        //'tasks' => true,
        //'votes' => true,
    ];

    protected function _setPassword($value)
    {
        $hasher = new DefaultPasswordHasher();
        return $hasher->hash($value);
    }
}
