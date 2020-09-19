<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Orders Model
 *
 * @property |\Cake\ORM\Association\BelongsTo $Users
 * @property |\Cake\ORM\Association\BelongsTo $Deliveries
 * @property |\Cake\ORM\Association\BelongsTo $Oplatas
 *
 * @method \App\Model\Entity\Order get($primaryKey, $options = [])
 * @method \App\Model\Entity\Order newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Order[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Order|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Order saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Order patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Order[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Order findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class OrdersTable extends Table
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

        $this->setTable('orders');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->hasMany('OrdersItems', [
            'foreignKey' => 'order_id',
            'joinType' => 'INNER'
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
            ->requirePresence('firstname', 'create')
            ->allowEmptyString('firstname', false);

        $validator
            ->scalar('phone')
            ->requirePresence('phone', 'create')
            ->allowEmptyString('phone', false);

        $validator
            ->email('email')
            ->requirePresence('email', 'create')
            ->allowEmptyString('email', false);

        $validator
            ->scalar('city')
            ->requirePresence('city', 'create')
            ->allowEmptyString('city', false);

        $validator
            ->scalar('lastname')
            ->requirePresence('lastname', 'create')
            ->allowEmptyString('lastname', false);

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
        //$rules->add($rules->isUnique(['email']));
        //$rules->add($rules->existsIn(['user_id'], 'Users'));
        //$rules->add($rules->existsIn(['delivery_id'], 'Deliveries'));
        //$rules->add($rules->existsIn(['oplata_id'], 'Oplatas'));

        return $rules;
    }
}
