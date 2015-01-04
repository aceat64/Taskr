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
        'base_points' => true,
        'gift_points' => true,
        'votes_count' => true,
        'completions_count' => true,
        'user' => true,
        'comments' => true,
        'completions' => true,
        'gifts' => true,
        'votes' => true,
        'tags' => true,
        'tag_string' => true,
    ];

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
            return $string . $tag->title . ', ';
        }, '');
        return trim($str, ', ');
    }
}
