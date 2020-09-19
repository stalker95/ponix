<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Statistics Model
 *
 * @method \App\Model\Entity\Statistic get($primaryKey, $options = [])
 * @method \App\Model\Entity\Statistic newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Statistic[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Statistic|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Statistic saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Statistic patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Statistic[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Statistic findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class StatisticsTable extends Table
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

        $this->setTable('statistics');

        $this->addBehavior('Timestamp');
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
            ->requirePresence('id', 'create')
            ->allowEmptyString('id', false);

        $validator
            ->integer('ip')
            ->requirePresence('ip', 'create')
            ->allowEmptyString('ip', false);

        return $validator;
    }
}
