<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * MainBlock Model
 *
 * @method \App\Model\Entity\MainBlock get($primaryKey, $options = [])
 * @method \App\Model\Entity\MainBlock newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\MainBlock[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\MainBlock|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\MainBlock saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\MainBlock patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\MainBlock[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\MainBlock findOrCreate($search, callable $callback = null, $options = [])
 */
class MainBlockTable extends Table
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

        $this->setTable('main_block');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');
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
            ->scalar('image')
            ->maxLength('image', 1000)
            ->requirePresence('image', 'create')
            ->allowEmptyFile('image', false);

        $validator
            ->scalar('name')
            ->maxLength('name', 1000)
            ->requirePresence('name', 'create')
            ->allowEmptyString('name', false);

        return $validator;
    }
}
