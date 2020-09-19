<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Faq Model
 *
 * @method \App\Model\Entity\Faq get($primaryKey, $options = [])
 * @method \App\Model\Entity\Faq newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Faq[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Faq|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Faq saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Faq patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Faq[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Faq findOrCreate($search, callable $callback = null, $options = [])
 */
class FaqTable extends Table
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

        $this->setTable('faq');
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
            ->scalar('description')
            ->maxLength('description', 2000)
            ->requirePresence('description', 'create')
            ->allowEmptyString('description', false);

        return $validator;
    }
}
