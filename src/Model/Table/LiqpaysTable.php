<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Liqpays Model
 *
 * @method \App\Model\Entity\Liqpay get($primaryKey, $options = [])
 * @method \App\Model\Entity\Liqpay newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Liqpay[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Liqpay|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Liqpay saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Liqpay patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Liqpay[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Liqpay findOrCreate($search, callable $callback = null, $options = [])
 */
class LiqpaysTable extends Table
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

        $this->setTable('liqpays');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');
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
            ->integer('public_key')
            ->requirePresence('public_key', 'create')
            ->allowEmptyString('public_key', false);

        $validator
            ->integer('private_key')
            ->requirePresence('private_key', 'create')
            ->allowEmptyString('private_key', false);

        return $validator;
    }
}
