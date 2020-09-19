<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * AttributesItems Model
 *
 * @property \App\Model\Table\AttributesItemsTable|\Cake\ORM\Association\BelongsTo $ParentAttributesItems
 * @property \App\Model\Table\AttributesItemsTable|\Cake\ORM\Association\HasMany $ChildAttributesItems
 *
 * @method \App\Model\Entity\AttributesItem get($primaryKey, $options = [])
 * @method \App\Model\Entity\AttributesItem newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\AttributesItem[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\AttributesItem|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\AttributesItem saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\AttributesItem patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\AttributesItem[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\AttributesItem findOrCreate($search, callable $callback = null, $options = [])
 */
class AttributesItemsTable extends Table
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

        $this->setTable('attributes_items');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->belongsTo('ParentAttributesItems', [
            'className' => 'Attributes',
            'foreignKey' => 'parent_id'
        ]);

        $this->hasMany('AttributesProducts', [
            'foreignKey' => 'attribute_id',
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

        return $rules;
    }
}
