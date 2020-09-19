<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Socials Model
 *
 * @method \App\Model\Entity\Social get($primaryKey, $options = [])
 * @method \App\Model\Entity\Social newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Social[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Social|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Social saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Social patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Social[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Social findOrCreate($search, callable $callback = null, $options = [])
 */
class SocialsTable extends Table
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

        $this->setTable('socials');
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
            ->scalar('name')
            ->requirePresence('name', 'create')
            ->allowEmptyString('name', false);

        $validator
            ->scalar('url')
            ->requirePresence('url', 'create')
            ->allowEmptyString('url', false);

        $validator
            ->scalar('image')
            ->requirePresence('image', 'create')
            ->allowEmptyFile('image', false);

        return $validator;
    }
}
