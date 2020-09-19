<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Themes Model
 *
 * @method \App\Model\Entity\Theme get($primaryKey, $options = [])
 * @method \App\Model\Entity\Theme newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Theme[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Theme|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Theme saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Theme patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Theme[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Theme findOrCreate($search, callable $callback = null, $options = [])
 */
class ThemesTable extends Table
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

        $this->setTable('themes');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->belongsTo('Playlists', [
            'targetForeignKey' => 'theme_id',
            'propertyName' => 'Playlists'
            
        ]);
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
            ->maxLength('name', 255)
            ->allowEmptyString('name');

        $validator
            ->scalar('class')
            ->maxLength('class', 255)
            ->allowEmptyString('class');

        return $validator;
    }
}
