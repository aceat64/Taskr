<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Votes Model
 */
class VotesTable extends Table
{

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        $this->table('votes');
        $this->displayField('id');
        $this->primaryKey('id');
        $this->addBehavior('Timestamp');
        $this->belongsTo('Tasks', [
            'foreignKey' => 'task_id'
        ]);
        $this->belongsTo('Users', [
            'foreignKey' => 'user_id'
        ]);

        $this->addBehavior('CounterCache', [
            'Tasks' => [
                'vote_count',
                'total_points' => function ($event, $entity, $table) {
                    $task = $table->Tasks->get($entity->task_id);
                    $total_points = $task->base_points + $task->gift_points + $task->vote_count;
                    return $total_points;
                }
            ],
            'Users' => ['vote_count']
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
            ->add('task_id', 'valid', ['rule' => 'numeric'])
            ->requirePresence('task_id', 'create')
            ->notEmpty('task_id')

            /* Disabled, validateUnique is not working
            ->add('task_id', [
                'validateUnique' => [
                    'rule' => ['validateUnique', ['scope' => 'user_id']],
                    'last' => true,
                    'message' => 'Vote already cast',
                    'provider' => 'table',
                ],
                'numeric' => [
                    'rule' => 'numeric',
                    'message' => 'Must be a valid task id.',
                ]
            ])
            */

            ->add('user_id', 'valid', ['rule' => 'numeric'])
            ->requirePresence('user_id', 'create')
            ->notEmpty('user_id');

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
        $rules->add($rules->existsIn(['task_id'], 'Tasks'));
        $rules->add($rules->existsIn(['user_id'], 'Users'));
        return $rules;
    }
}
