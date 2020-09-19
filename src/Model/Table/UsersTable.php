<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use Cake\ORM\TableRegistry;
/**
 * Users Model
 *
 * @method \App\Model\Entity\User get($primaryKey, $options = [])
 * @method \App\Model\Entity\User newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\User[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\User|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\User saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\User patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\User[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\User findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
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
        parent::initialize($config);

        $this->setTable('users');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        
        $this->hasOne('Playlist', [
            'foreignKey' => 'user_id',
            'className'    => 'Playlist', 
            'saveStrategy' => 'replace',
            'dependent' => true
        ]); 
         $this->belongsTo('Parent', [
           'foreignKey' => 'parent_id',
            'className'    => 'users', 
            'saveStrategy' => 'replace',
            'dependent' => true
        ]);
         $this->belongsTo('Media', [
            'className' => 'Media',
            'foreignKey' => 'user_id',
            'saveStrategy' => 'replace',
            'dependent' => true
            
        ]);
         $this->belongsTo('Programs', [
            'foreignKey' => 'program_id',
            'className'    => 'Programs', 
            'saveStrategy' => 'replace',
            'dependent' => true
        ]);

        $this->hasMany('Wishlists', [
            'foreignKey' => 'user_id',
            'className'    => 'Wishlists', 
        ]);

        $this->hasMany('Compares', [
            'foreignKey' => 'user_id',
            'className'    => 'Compares', 
        ]);
         
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator)
    {
        $validator
            ->integer('id')
            ->allowEmptyString('id', 'create');

        $validator
            ->scalar('firstname')
            ->maxLength('firstname', 255)
            ->requirePresence('firstname', 'create')
            ->allowEmptyString('firstname', false);

        $validator
            ->scalar('lastname')
            ->maxLength('lastname', 255)
            ->requirePresence('lastname', 'create')
            ->allowEmptyString('lastname', false);

        $validator
            ->scalar('mail')
            ->maxLength('mail', 50)
            ->requirePresence('mail', 'create')
            ->allowEmptyString('mail', false)
            ->add('mail', 'unique', ['rule' => 'validateUnique', 'provider' => 'table']);

        $validator
            ->boolean('is_admin')
            ->allowEmptyString('is_admin');

        $validator
            ->boolean('active')
            ->allowEmptyString('active');

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
        $rules->add($rules->isUnique(['mail']));

        return $rules;
    }
    
}
