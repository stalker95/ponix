<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * PlaylistsMedia Model
 *
 * @property \App\Model\Table\PlaylistsTable|\Cake\ORM\Association\BelongsTo $Playlists
 * @property \App\Model\Table\MediaTable|\Cake\ORM\Association\BelongsTo $Media
 *
 * @method \App\Model\Entity\PlaylistsMedia get($primaryKey, $options = [])
 * @method \App\Model\Entity\PlaylistsMedia newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\PlaylistsMedia[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\PlaylistsMedia|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\PlaylistsMedia saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\PlaylistsMedia patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\PlaylistsMedia[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\PlaylistsMedia findOrCreate($search, callable $callback = null, $options = [])
 */
class PlaylistsMediaTable extends Table
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

        $this->setTable('playlists_media');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('Playlists', [
            'foreignKey' => 'id',
            'targetForeignKey' => 'playlist_id',
        ]);
        $this->belongsTo('Media', [
             'foreignKey' => 'id',
            'foreignKey' => 'media_id',
             'targetForeignKey' => 'Media',
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
            ->integer('rank')
            ->allowEmptyString('rank');
        $validator
            ->integer('is_abs')
            ->allowEmptyString('is_abs');    

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
        $rules->add($rules->existsIn(['playlist_id'], 'Playlists'));
        $rules->add($rules->existsIn(['media_id'], 'Media'));

        return $rules;
    }
}
