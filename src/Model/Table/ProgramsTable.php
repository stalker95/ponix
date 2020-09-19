<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Programs Model
 *
 * @method \App\Model\Entity\Program get($primaryKey, $options = [])
 * @method \App\Model\Entity\Program newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Program[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Program|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Program saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Program patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Program[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Program findOrCreate($search, callable $callback = null, $options = [])
 */
class ProgramsTable extends Table
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

        $this->setTable('programs');
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

        $validator
            ->scalar('price')
            ->maxLength('price', 1000)
            ->requirePresence('price', 'create')
            ->allowEmptyString('price', false);

        $validator
            ->scalar('title_two')
            ->maxLength('title_two', 1000)
            ->requirePresence('title_two', 'create')
            ->allowEmptyString('title_two', false);

        $validator
            ->scalar('description')
            ->maxLength('description', 1000)
            ->requirePresence('description', 'create')
            ->allowEmptyString('description', false);

        $validator
            ->scalar('button_text')
            ->maxLength('button_text', 1000)
            ->requirePresence('button_text', 'create')
            ->allowEmptyString('button_text', false);

        return $validator;
    }
}
