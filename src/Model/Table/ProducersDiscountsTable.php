<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * ProducersDiscounts Model
 *
 * @property \App\Model\Table\ProducersTable|\Cake\ORM\Association\BelongsTo $Producers
 *
 * @method \App\Model\Entity\ProducersDiscount get($primaryKey, $options = [])
 * @method \App\Model\Entity\ProducersDiscount newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\ProducersDiscount[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\ProducersDiscount|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\ProducersDiscount saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\ProducersDiscount patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\ProducersDiscount[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\ProducersDiscount findOrCreate($search, callable $callback = null, $options = [])
 */
class ProducersDiscountsTable extends Table
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

        $this->setTable('producers_discounts');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('Producers', [
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
            ->numeric('discount')
            ->requirePresence('discount', 'create')
            ->allowEmptyString('discount', false);

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
        $rules->add($rules->existsIn(['producer_id'], 'Producers'));

        return $rules;
    }
}
