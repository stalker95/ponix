<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Rewiev Model
 *
 * @property \App\Model\Table\ProductsTable|\Cake\ORM\Association\BelongsTo $Products
 *
 * @method \App\Model\Entity\Rewiev get($primaryKey, $options = [])
 * @method \App\Model\Entity\Rewiev newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Rewiev[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Rewiev|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Rewiev saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Rewiev patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Rewiev[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Rewiev findOrCreate($search, callable $callback = null, $options = [])
 */
class RewievTable extends Table
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

        $this->setTable('rewiev');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('Products', [
            'foreignKey' => 'product_id',
            'joinType' => 'INNER'
        ]);

        $this->hasMany('ParentReview', [
            'className' => 'Rewiev',
            'foreignKey' => 'parent_id'
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
            ->scalar('user_name')
            ->requirePresence('user_name', 'create')
            ->allowEmptyString('user_name', false);

        $validator
            ->scalar('user_email')
            ->requirePresence('user_email', 'create')
            ->allowEmptyString('user_email', false);

        $validator
            ->scalar('rewiev_text')
            ->requirePresence('rewiev_text', 'create')
            ->allowEmptyString('rewiev_text', false);

        $validator
            ->numeric('rating')
            ->requirePresence('rating', 'create')
            ->allowEmptyString('rating', false);

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
