<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Playlist Model
 *
 * @property \App\Model\Table\UsersTable|\Cake\ORM\Association\BelongsTo $Users
 * @property \App\Model\Table\CategoriesTable|\Cake\ORM\Association\BelongsTo $Categories
 *
 * @method \App\Model\Entity\Playlist get($primaryKey, $options = [])
 * @method \App\Model\Entity\Playlist newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Playlist[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Playlist|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Playlist saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Playlist patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Playlist[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Playlist findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class PlaylistTable extends Table
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

        $this->setTable('playlists');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        
        $this->belongsTo('Categories', [
            'foreignKey' => 'category_id',
            'targetForeignKey' => 'id',
            'propertyName' => 'Categories'
        ]);

        $this->belongsTo('Themes', [
            'foreignKey' => 'theme_id',
            'targetForeignKey' => 'id',
            'propertyName' => 'Themes'
        ]);

        $this->hasOne('Users', [
            'foreignKey' => 'user_id',
            'saveStrategy' => 'replace'

        ]);
         $this->belongsToMany('Playlists_users', [
            'foreignKey' => 'playlist_id',
            'targetForeignKey' => 'user_id',
            'joinTable' => 'playlists_users'
        ]);
         $this->belongsToMany('Playlists_Media', [
            'foreignKey' => 'playlist_id',
            'targetForeignKey' => 'media_id',
            'joinTable' => 'playlists_media'
        ]);

         $this->belongsToMany('Media', [
            'foreignKey' => 'playlist_id',
            'targetForeignKey' => 'media_id',
            'joinTable' => 'playlists_media'
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
            ->scalar('city')
            ->maxLength('city', 255)
            ->allowEmptyString('city');

        $validator
            ->scalar('region')
            ->maxLength('region', 255)
            ->allowEmptyString('region');

        $validator
            ->integer('time')
            ->allowEmptyString('time');

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
        $rules->add($rules->existsIn(['user_id'], 'Users'));
        $rules->add($rules->existsIn(['category_id'], 'Categories'));

        return $rules;
    }
}
