<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Attributes Model
 *
 * @method \App\Model\Entity\Attribute get($primaryKey, $options = [])
 * @method \App\Model\Entity\Attribute newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Attribute[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Attribute|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Attribute saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Attribute patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Attribute[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Attribute findOrCreate($search, callable $callback = null, $options = [])
 */
class AttributesTable extends Table
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

        $this->setTable('attributes');
        $this->setDisplayField('name');

        $this->hasMany('AttributesItems', [
            'className' => 'AttributesItems',
            'foreignKey'            => 'parent_id',
      'associationForeignKey' => 'id'
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
            ->scalar('name')
            ->maxLength('name', 1000)
            ->requirePresence('name', 'create')
            ->allowEmptyString('name', false);

        return $validator;
    }
}
