<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * SocialIcons Model
 *
 * @method \App\Model\Entity\SocialIcon get($primaryKey, $options = [])
 * @method \App\Model\Entity\SocialIcon newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\SocialIcon[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\SocialIcon|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\SocialIcon saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\SocialIcon patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\SocialIcon[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\SocialIcon findOrCreate($search, callable $callback = null, $options = [])
 */
class SocialIconsTable extends Table
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

        $this->setTable('social_icons');
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
            ->maxLength('name', 1000)
            ->requirePresence('name', 'create')
            ->allowEmptyString('name', false);

        $validator
            ->scalar('class')
            ->maxLength('class', 1000)
            ->requirePresence('class', 'create')
            ->allowEmptyString('class', false);

        $validator
            ->scalar('url')
            ->maxLength('url', 1000)
            ->requirePresence('url', 'create')
            ->allowEmptyString('url', false);

        return $validator;
    }
}
