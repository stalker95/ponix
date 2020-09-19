<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * ProductsGallery Model
 *
 * @property \App\Model\Table\ProductsTable|\Cake\ORM\Association\BelongsTo $Products
 *
 * @method \App\Model\Entity\ProductsGallery get($primaryKey, $options = [])
 * @method \App\Model\Entity\ProductsGallery newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\ProductsGallery[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\ProductsGallery|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\ProductsGallery saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\ProductsGallery patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\ProductsGallery[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\ProductsGallery findOrCreate($search, callable $callback = null, $options = [])
 */
class ProductsGalleryTable extends Table
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

        $this->setTable('products_gallery');
        $this->setDisplayField('name');
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
            ->scalar('name')
            ->requirePresence('name', 'create')
            ->allowEmptyString('name', false);

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
