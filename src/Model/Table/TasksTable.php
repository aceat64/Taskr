<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Tasks Model
 */
class TasksTable extends Table
{

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        $this->table('tasks');
        $this->displayField('name');
        $this->primaryKey('id');
        $this->addBehavior('Timestamp');
        $this->belongsTo('Users', [
            'foreignKey' => 'user_id'
        ]);
        $this->hasMany('Comments', [
            'foreignKey' => 'task_id'
        ]);
        $this->hasMany('Completions', [
            'foreignKey' => 'task_id'
        ]);
        $this->hasMany('Gifts', [
            'foreignKey' => 'task_id'
        ]);
        $this->hasMany('Votes', [
            'foreignKey' => 'task_id'
        ]);
        $this->belongsToMany('Tags', [
            'foreignKey' => 'task_id',
            'targetForeignKey' => 'tag_id',
            'joinTable' => 'tasks_tags'
        ]);
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator instance
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator)
    {
        $validator
            ->add('id', 'valid', ['rule' => 'numeric'])
            ->allowEmpty('id', 'create')
            ->add('status', 'valid', ['rule' => 'numeric'])
            ->requirePresence('status', 'create')
            ->notEmpty('status')
            ->add('user_id', 'valid', ['rule' => 'numeric'])
            ->requirePresence('user_id', 'create')
            ->notEmpty('user_id')
            ->requirePresence('name', 'create')
            ->notEmpty('name')
            ->requirePresence('description', 'create')
            ->notEmpty('description')
            ->add('base_points', 'valid', ['rule' => 'numeric'])
            ->requirePresence('base_points', 'create')
            ->notEmpty('base_points')
            ->add('gift_points', 'valid', ['rule' => 'numeric'])
            ->requirePresence('gift_points', 'create')
            ->notEmpty('gift_points')
            ->add('votes_count', 'valid', ['rule' => 'numeric'])
            ->requirePresence('votes_count', 'create')
            ->notEmpty('votes_count')
            ->add('completions_count', 'valid', ['rule' => 'numeric'])
            ->requirePresence('completions_count', 'create')
            ->notEmpty('completions_count');

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules)
    {
        $rules->add($rules->existsIn(['user_id'], 'Users'));
        return $rules;
    }

    public function findTagged(Query $query, array $options)
    {
        return $this->find()
            ->matching('Tags', function ($q) use ($options) {
                return $q->where(['Tags.name IN' => $options['tags']]);
            });
    }

    public function beforeSave($event, $entity, $options)
    {
        if ($entity->tag_string) {
            $entity->tags = $this->_buildTags($entity->tag_string);
        }
    }

    protected function _buildTags($tagString)
    {
        $new = array_unique(array_map('trim', explode(',', $tagString)));
        $out = [];
        $query = $this->Tags->find()
            ->where(['Tags.name IN' => $new]);

        // Remove existing tags from the list of new tags.
        foreach ($query->extract('name') as $existing) {
            $index = array_search($existing, $new);
            if ($index !== false) {
                unset($new[$index]);
            }
        }

        // Add existing tags.
        foreach ($query as $tag) {
            $out[] = $tag;
        }

        // Add new tags.
        foreach ($new as $tag) {
            $out[] = $this->Tags->newEntity(['name' => $tag]);
        }
        
        return $out;
    }
}
