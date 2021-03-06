<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Marques Model
 *
 * @method \App\Model\Entity\Marque get($primaryKey, $options = [])
 * @method \App\Model\Entity\Marque newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Marque[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Marque|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Marque saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Marque patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Marque[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Marque findOrCreate($search, callable $callback = null, $options = [])
 */
class MarquesTable extends Table
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

        $this->setTable('marques');
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
            ->scalar('text')
            ->maxLength('text', 255)
            ->allowEmptyString('text');

        return $validator;
    }
}
