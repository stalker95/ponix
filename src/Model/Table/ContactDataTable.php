<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * ContactData Model
 *
 * @method \App\Model\Entity\ContactData get($primaryKey, $options = [])
 * @method \App\Model\Entity\ContactData newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\ContactData[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\ContactData|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\ContactData saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\ContactData patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\ContactData[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\ContactData findOrCreate($search, callable $callback = null, $options = [])
 */
class ContactDataTable extends Table
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

        $this->setTable('contact_data');
        $this->setDisplayField('id');
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
            ->email('email')
            ->requirePresence('email', 'create')
            ->allowEmptyString('email', false);

        $validator
            ->scalar('phone')
            ->maxLength('phone', 1000)
            ->requirePresence('phone', 'create')
            ->allowEmptyString('phone', false);

        $validator
            ->scalar('location')
            ->requirePresence('location', 'create')
            ->allowEmptyString('location', false);

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
        $rules->add($rules->isUnique(['email']));

        return $rules;
    }
}
