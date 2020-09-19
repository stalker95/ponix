<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * AdvertisingsMain Model
 *
 * @method \App\Model\Entity\AdvertisingsMain get($primaryKey, $options = [])
 * @method \App\Model\Entity\AdvertisingsMain newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\AdvertisingsMain[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\AdvertisingsMain|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\AdvertisingsMain saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\AdvertisingsMain patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\AdvertisingsMain[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\AdvertisingsMain findOrCreate($search, callable $callback = null, $options = [])
 */
class AdvertisingsMainTable extends Table
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

        $this->setTable('advertisings_main');
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

        /*$validator
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

        $validator
            ->scalar('description')
            ->maxLength('description', 1000)
            ->requirePresence('description', 'create')
            ->allowEmptyString('description', false);

        return $validator;
    }
}
