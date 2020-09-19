<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * AttributesCategories Model
 *
 * @property \App\Model\Table\AttributesTable|\Cake\ORM\Association\BelongsTo $Attributes
 * @property \App\Model\Table\CategoriesTable|\Cake\ORM\Association\BelongsTo $Categories
 *
 * @method \App\Model\Entity\AttributesCategory get($primaryKey, $options = [])
 * @method \App\Model\Entity\AttributesCategory newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\AttributesCategory[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\AttributesCategory|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\AttributesCategory saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\AttributesCategory patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\AttributesCategory[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\AttributesCategory findOrCreate($search, callable $callback = null, $options = [])
 */
class AttributesCategoriesTable extends Table
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

        $this->setTable('attributes_categories');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('Attributes', [
            'foreignKey' => 'attribute_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Categories', [
            'foreignKey' => 'category_id',
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
        $rules->add($rules->existsIn(['attribute_id'], 'Attributes'));
        $rules->add($rules->existsIn(['category_id'], 'Categories'));

        return $rules;
    }
}
