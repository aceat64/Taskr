<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;
use Cake\Collection\Collection;

/**
 * Task Entity.
 */
class Task extends Entity
{

    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * @var array
     */
    protected $_accessible = [
        'status' => true,
        'user_id' => true,
        'name' => true,
        'description' => true,
        'total_points' => true,
        'base_points' => true,
        'gift_points' => true,
        //'vote_count' => true,
        //'completion_count' => true,
        //'comment_count' => true,
        //'user' => true,
        //'comments' => true,
        //'completions' => true,
        //'gifts' => true,
        //'votes' => true,
        'tags' => true,
        'tag_string' => true,
        'voted' => true,
    ];

    protected function _getVoted()
    {
        if (isset($this->_properties['voted'])) {
            return $this->_properties['voted'];
        }

        if (empty($this->votes)) {
            return false;
        }

        $votes = new Collection($this->votes);
        // This is the wrong way to get the user_id, but I don't know another way
        $user_votes = $votes->match(['user_id' => $_SESSION['Auth']['User']['id']]);

        // Previous vote by this user
        if ($user_votes->toArray()) {
            return true;
        } else {
            return false;
        }
    }

    protected function _getTagString()
    {
        if (isset($this->_properties['tag_string'])) {
            return $this->_properties['tag_string'];
        }
        if (empty($this->tags)) {
            return '';
        }
        $tags = new Collection($this->tags);
        $str = $tags->reduce(function ($string, $tag) {
            return $string . $tag->name . ', ';
        }, '');
        return trim($str, ', ');
    }
}
