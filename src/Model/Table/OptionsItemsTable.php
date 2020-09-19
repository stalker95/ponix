<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * OptionsItems Model
 *
 * @property \App\Model\Table\OptionsTable|\Cake\ORM\Association\BelongsTo $Options
 *
 * @method \App\Model\Entity\OptionsItem get($primaryKey, $options = [])
 * @method \App\Model\Entity\OptionsItem newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\OptionsItem[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\OptionsItem|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\OptionsItem saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\OptionsItem patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\OptionsItem[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\OptionsItem findOrCreate($search, callable $callback = null, $options = [])
 */
class OptionsItemsTable extends Table
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

        $this->setTable('options_items');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->belongsTo('Options', [
            'foreignKey' => 'option_id',
            'joinType' => 'INNER'
        ]);
        
        $this->belongsTo('Products', [
            'foreignKey' => 'product_id',
            'joinType' => 'INNER'
        ]);

         $this->hasMany('ProductsOptions', [
            'foreignKey' => 'options_items_id',
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
        $rules->add($rules->existsIn(['option_id'], 'Options'));

        return $rules;
    }
}
