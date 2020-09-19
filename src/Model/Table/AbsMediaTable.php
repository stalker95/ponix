<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * AbsMedia Model
 *
 * @property \App\Model\Table\MediaTable|\Cake\ORM\Association\BelongsTo $Media
 *
 * @method \App\Model\Entity\AbsMedia get($primaryKey, $options = [])
 * @method \App\Model\Entity\AbsMedia newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\AbsMedia[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\AbsMedia|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\AbsMedia saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\AbsMedia patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\AbsMedia[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\AbsMedia findOrCreate($search, callable $callback = null, $options = [])
 */
class AbsMediaTable extends Table
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

        $this->setTable('abs_media');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('Media', [
            'foreignKey' => 'media_id',
            'joinType' => 'INNER'
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
        $rules->add($rules->existsIn(['media_id'], 'Media'));

        return $rules;
    }
}
