<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Solution Model
 *
 * @method \App\Model\Entity\Solution get($primaryKey, $options = [])
 * @method \App\Model\Entity\Solution newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Solution[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Solution|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Solution saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Solution patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Solution[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Solution findOrCreate($search, callable $callback = null, $options = [])
 */
class SolutionTable extends Table
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

        $this->setTable('solution');
        $this->setDisplayField('title');
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
            ->scalar('title')
            ->maxLength('title', 1000)
            ->requirePresence('title', 'create')
            ->allowEmptyString('title', false);

        /*$validator
            ->scalar('image')
            ->maxLength('image', 1000)
            ->requirePresence('image', 'create')
            ->allowEmptyFile('image', false);
          */
        $validator
            ->scalar('url')
            ->maxLength('url', 1000)
            ->requirePresence('url', 'create')
            ->allowEmptyString('url', false);

        $validator
            ->scalar('link')
            ->maxLength('link', 1000)
            ->requirePresence('link', 'create')
            ->allowEmptyString('link', false);

        return $validator;
    }
}
