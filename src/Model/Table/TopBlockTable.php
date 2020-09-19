<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * TopBlock Model
 *
 * @method \App\Model\Entity\TopBlock get($primaryKey, $options = [])
 * @method \App\Model\Entity\TopBlock newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\TopBlock[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\TopBlock|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\TopBlock saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\TopBlock patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\TopBlock[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\TopBlock findOrCreate($search, callable $callback = null, $options = [])
 */
class TopBlockTable extends Table
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

        $this->setTable('top_block');
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

       /* $validator
            ->scalar('image')
            ->maxLength('image', 1000)
            ->requirePresence('image', 'create')
            ->allowEmptyFile('image', false);
            */

        $validator
            ->scalar('name')
            ->maxLength('name', 1000)
            ->requirePresence('name', 'create')
            ->allowEmptyString('name', false);

        return $validator;
    }
}
