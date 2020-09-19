<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Media Model
 *
 * @method \App\Model\Entity\Media get($primaryKey, $options = [])
 * @method \App\Model\Entity\Media newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Media[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Media|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Media saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Media patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Media[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Media findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class MediaTable extends Table
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

        $this->setTable('media');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsToMany('Playlists_Media', [
            'foreignKey' => 'media_id',
            'targetForeignKey' => 'playlist_id',
            'joinTable' => 'playlists_media'
        ]);
        $this->belongsToMany('Tags', [
            'foreignKey' => 'media_id',
            'targetForeignKey' => 'tags_id',
            'joinTable' => 'tags_media'
        ]);
        $this->belongsTo('Users', [
            'foreignKey' => 'user_id',
            'propertyName' => 'Users',
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

        $validator
            ->scalar('name')
            ->maxLength('name', 255)
            ->allowEmptyString('name');

       /* $validator
            ->scalar('file')
            ->maxLength('file', 255)
            ->allowEmptyFile('file'); */

        $validator
            ->scalar('type')
            ->allowEmptyString('type');

        $validator
            ->boolean('active')
            ->allowEmptyString('active');

        return $validator;
    }
}
