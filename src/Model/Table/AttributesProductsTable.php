<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * AttributesProducts Model
 *
 * @property \App\Model\Table\AttributesTable|\Cake\ORM\Association\BelongsTo $Attributes
 * @property \App\Model\Table\ProductsTable|\Cake\ORM\Association\BelongsTo $Products
 *
 * @method \App\Model\Entity\AttributesProduct get($primaryKey, $options = [])
 * @method \App\Model\Entity\AttributesProduct newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\AttributesProduct[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\AttributesProduct|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\AttributesProduct saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\AttributesProduct patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\AttributesProduct[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\AttributesProduct findOrCreate($search, callable $callback = null, $options = [])
 */
class AttributesProductsTable extends Table
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

        $this->setTable('attributes_products');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('AttributesItems', [
            'foreignKey' => 'attribute_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Attributes', [
            'foreignKey' => 'attribute_id',
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
        $rules->add($rules->existsIn(['attribute_id'], 'AttributesItems'));
        $rules->add($rules->existsIn(['product_id'], 'Products'));

        return $rules;
    }
}
