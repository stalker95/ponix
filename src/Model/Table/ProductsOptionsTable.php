<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * ProductsOptions Model
 *
 * @property \App\Model\Table\OptionsItemsTable|\Cake\ORM\Association\BelongsTo $OptionsItems
 * @property \App\Model\Table\ProductsTable|\Cake\ORM\Association\BelongsTo $Products
 *
 * @method \App\Model\Entity\ProductsOption get($primaryKey, $options = [])
 * @method \App\Model\Entity\ProductsOption newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\ProductsOption[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\ProductsOption|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\ProductsOption saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\ProductsOption patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\ProductsOption[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\ProductsOption findOrCreate($search, callable $callback = null, $options = [])
 */
class ProductsOptionsTable extends Table
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

        $this->setTable('products_options');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('OptionsItems', [
            'foreignKey' => 'options_items_id',
            'joinType' => 'INNER'
        ]);
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
            ->integer('value')
            ->requirePresence('value', 'create')
            ->allowEmptyString('value', false);

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
        $rules->add($rules->existsIn(['options_items_id'], 'OptionsItems'));
        $rules->add($rules->existsIn(['product_id'], 'Products'));

        return $rules;
    }
}
