<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * ContactForm Model
 *
 * @method \App\Model\Entity\ContactForm get($primaryKey, $options = [])
 * @method \App\Model\Entity\ContactForm newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\ContactForm[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\ContactForm|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\ContactForm saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\ContactForm patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\ContactForm[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\ContactForm findOrCreate($search, callable $callback = null, $options = [])
 */
class ContactFormTable extends Table
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

        $this->setTable('contact_form');
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
            ->requirePresence('email', 'create')
            ->add('email', 'valid', [
               'rule' => 'email',
               'message' => __('הזן כתובת דוא"ל נכונה  ')
             ])
            ->ascii('email', __('הזן כתובת דוא"ל נכונה  '))
            ->notEmpty('email', __('הזן כתובת דוא"ל נכונה  '));
        $validator
            ->scalar('name')
            ->maxLength('name', 1000)
            ->requirePresence('name', 'create')
            ->allowEmptyString('name', false);

        $validator
            ->scalar('message')
            ->maxLength('message', 1000)
            ->requirePresence('message', 'create')
            ->allowEmptyString('message', false);

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
  /*  public function buildRules(RulesChecker $rules)
    {
        $rules->add($rules->isUnique(['email']));

        return $rules;
    }
    */
}
