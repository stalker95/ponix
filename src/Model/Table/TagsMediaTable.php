<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * TagsMedia Model
 *
 * @property \App\Model\Table\MediaTable|\Cake\ORM\Association\BelongsTo $Media
 * @property \App\Model\Table\TagsTable|\Cake\ORM\Association\BelongsTo $Tags
 *
 * @method \App\Model\Entity\TagsMedia get($primaryKey, $options = [])
 * @method \App\Model\Entity\TagsMedia newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\TagsMedia[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\TagsMedia|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\TagsMedia saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\TagsMedia patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\TagsMedia[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\TagsMedia findOrCreate($search, callable $callback = null, $options = [])
 */
class TagsMediaTable extends Table
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

        $this->setTable('tags_media');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('Media', [
            'foreignKey' => 'media_id'
        ]);
        $this->belongsTo('Tags', [
            'foreignKey' => 'tags_id'
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
        $rules->add($rules->existsIn(['tags_id'], 'Tags'));

        return $rules;
    }
}
