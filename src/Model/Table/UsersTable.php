<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Users Model
 */
class UsersTable extends Table
{

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        $this->table('users');
        $this->displayField('id');
        $this->primaryKey('id');
        $this->hasMany('Comments', [
            'foreignKey' => 'user_id'
        ]);
        $this->hasMany('Completions', [
            'foreignKey' => 'user_id'
        ]);
        $this->hasMany('Flags', [
            'foreignKey' => 'user_id'
        ]);
        $this->hasMany('Gifts', [
            'foreignKey' => 'user_id'
        ]);
        $this->hasMany('Tasks', [
            'foreignKey' => 'user_id'
        ]);
        $this->hasMany('Votes', [
            'foreignKey' => 'user_id'
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

            ->add('admin', 'valid', ['rule' => 'boolean'])
            ->requirePresence('admin', 'create')
            ->notEmpty('admin')

            ->add('username', [
                'unique' => [
                    'rule' => 'validateUnique',
                    'provider' => 'table',
                    'message' => 'This username is already taken.',
                ]
            ])
            ->requirePresence('username', 'create')
            ->notEmpty('username')

            ->requirePresence('password', 'create')
            ->notEmpty('password', 'Please enter a password', 'create')

            ->requirePresence('display_name')
            ->notEmpty('display_name', 'Please enter a display name')

            ->add('email', [
                'unique' => [
                    'rule' => 'validateUnique',
                    'last' => true,
                    'message' => 'This address is already taken.',
                    'provider' => 'table',
                ],
                'email' => [
                    'rule' => 'email',
                    'message' => 'Must be a valid e-mail address.',
                ]
            ])
            ->requirePresence('email', 'create')
            ->notEmpty('email')

            ->add('credits', 'valid', ['rule' => 'decimal'])
            ->requirePresence('credits', 'create')
            ->notEmpty('credits')

            ->add('lifetime_points', 'valid', ['rule' => 'numeric'])
            ->requirePresence('lifetime_points', 'create')
            ->notEmpty('lifetime_points')

            ->add('votes_count', 'valid', ['rule' => 'numeric'])
            ->requirePresence('votes_count', 'create')
            ->notEmpty('votes_count');

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
        $rules->add($rules->isUnique(['username']));
        $rules->add($rules->isUnique(['email']));
        return $rules;
    }
}
