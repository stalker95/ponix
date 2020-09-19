<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Producers Model
 *
 * @method \App\Model\Entity\Producer get($primaryKey, $options = [])
 * @method \App\Model\Entity\Producer newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Producer[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Producer|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Producer saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Producer patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Producer[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Producer findOrCreate($search, callable $callback = null, $options = [])
 */
class ProducersTable extends Table
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

        $this->setTable('producers');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->hasMany('Products', [
            'foreignKey' => 'producer_id',
            'joinType' => 'INNER'
        ]);

        $this->hasMany('ProducersDiscounts', [
            'foreignKey' => 'producer_id',
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
            ->scalar('name')
            ->maxLength('name', 1000)
            ->requirePresence('name', 'create')
            ->allowEmptyString('name', false);

      /*  $validator
            ->scalar('image')
            ->maxLength('image', 1000)
            ->requirePresence('image', 'create')
            ->allowEmptyFile('image', false);
            */

        $validator
            ->scalar('slug')
            ->maxLength('slug', 1000)
            ->requirePresence('slug', 'create')
            ->allowEmptyString('slug', false);

        return $validator;
    }
}
