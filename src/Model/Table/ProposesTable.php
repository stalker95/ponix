<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Proposes Model
 *
 * @property \App\Model\Table\ProductsTable|\Cake\ORM\Association\BelongsTo $Products
 *
 * @method \App\Model\Entity\Propose get($primaryKey, $options = [])
 * @method \App\Model\Entity\Propose newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Propose[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Propose|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Propose saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Propose patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Propose[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Propose findOrCreate($search, callable $callback = null, $options = [])
 */
class ProposesTable extends Table
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

        $this->setTable('proposes');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('Products', [
            'foreignKey' => 'product_id',
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
            ->integer('position')
            ->requirePresence('position', 'create')
            ->allowEmptyString('position', false);

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
        $rules->add($rules->existsIn(['product_id'], 'Products'));

        return $rules;
    }
}
