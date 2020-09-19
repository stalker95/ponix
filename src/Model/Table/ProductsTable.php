<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Products Model
 *
 * @property \App\Model\Table\CategoriesTable|\Cake\ORM\Association\BelongsTo $Categories
 *
 * @method \App\Model\Entity\Product get($primaryKey, $options = [])
 * @method \App\Model\Entity\Product newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Product[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Product|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Product saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Product patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Product[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Product findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class ProductsTable extends Table
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

        $this->setTable('products');
        $this->setDisplayField('title');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Categories', [
            'foreignKey' => 'category_id',
            'joinType' => 'INNER'
        ]);

        $this->belongsTo('Producers', [
            'foreignKey' => 'producer_id',
            'joinType' => 'INNER'
        ]);

        $this->hasMany('AttributesProducts', [
            'foreignKey' => 'product_id',
            'joinType' => 'INNER'
        ]);

        $this->hasMany('ProductsGallery', [
            'foreignKey' => 'product_id',
            'joinType' => 'INNER'
        ]);

        $this->hasMany('Rewiev', [
            'foreignKey' => 'product_id',
            'joinType' => 'INNER'
        ]);

        $this->hasMany('Actions', [
            'foreignKey' => 'product_id',
            'joinType' => 'INNER'
        ]);

        $this->hasMany('ActionsProducts', [
            'foreignKey' => 'products_id',
            'joinType' => 'INNER'
        ]);

        $this->hasMany('Discounts', [
            'foreignKey' => 'product_id',
            'joinType' => 'INNER'
        ]);

        $this->hasMany('Wishlists', [
            'foreignKey' => 'product_id',
            'joinType' => 'INNER'
        ]);

        $this->hasMany('ProductsOptions', [
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
       /* $validator
            ->integer('id')
            ->requirePresence('id', 'create')
            ->allowEmptyString('id', false);
        */
        $validator
            ->scalar('title')
            ->requirePresence('title', 'create')
            ->allowEmptyString('title', false);

        $validator
            ->scalar('slug')
            ->requirePresence('slug', 'create')
            ->allowEmptyString('slug', false);

        $validator
            ->scalar('description')
            ->requirePresence('description', 'create')
            ->allowEmptyString('description', false);

        $validator
            ->scalar('title_page')
            ->requirePresence('title_page', 'create')
            ->allowEmptyString('title_page', false);

      /*  $validator
            ->scalar('keywords')
            ->requirePresence('keywords', 'create')
            ->allowEmptyString('keywords', false);

        $validator
            ->scalar('page_description')
            ->requirePresence('page_description', 'create')
            ->allowEmptyString('page_description', false);
            */

        $validator
            ->numeric('price')
            ->requirePresence('price', 'create')
            ->allowEmptyString('price', false);

        $validator
            ->integer('amount')
            ->requirePresence('amount', 'create')
            ->allowEmptyString('amount', false);

        $validator
            ->integer('status')
            ->requirePresence('status', 'create')
            ->allowEmptyString('status', false);

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
        $rules->add($rules->existsIn(['category_id'], 'Categories'));

        return $rules;
    }
}
