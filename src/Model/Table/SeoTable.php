<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Seo Model
 *
 * @method \App\Model\Entity\Seo get($primaryKey, $options = [])
 * @method \App\Model\Entity\Seo newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Seo[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Seo|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Seo saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Seo patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Seo[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Seo findOrCreate($search, callable $callback = null, $options = [])
 */
class SeoTable extends Table
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

        $this->setTable('seo');
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
            ->maxLength('description', 1000)
            ->requirePresence('description', 'create')
            ->allowEmptyString('description', false);

        $validator
            ->scalar('keywords')
            ->maxLength('keywords', 1000)
            ->requirePresence('keywords', 'create')
            ->allowEmptyString('keywords', false);

        return $validator;
    }
}
