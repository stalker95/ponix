<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * ActionsProducts Model
 *
 * @property \App\Model\Table\ActionsTable|\Cake\ORM\Association\BelongsTo $Actions
 * @property \App\Model\Table\ProductsTable|\Cake\ORM\Association\BelongsTo $Products
 *
 * @method \App\Model\Entity\ActionsProduct get($primaryKey, $options = [])
 * @method \App\Model\Entity\ActionsProduct newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\ActionsProduct[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\ActionsProduct|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\ActionsProduct saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\ActionsProduct patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\ActionsProduct[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\ActionsProduct findOrCreate($search, callable $callback = null, $options = [])
 */
class ActionsProductsTable extends Table
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

        $this->setTable('actions_products');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('Actions', [
            'foreignKey' => 'action_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Products', [
            'foreignKey' => 'products_id',
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
        $rules->add($rules->existsIn(['action_id'], 'Actions'));
        $rules->add($rules->existsIn(['products_id'], 'Products'));

        return $rules;
    }
}
