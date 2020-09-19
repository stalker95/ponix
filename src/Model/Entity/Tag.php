<?php
namespace App\Model\Entity;
use Cake\ORM\TableRegistry;
use Cake\ORM\Entity;

/**
 * Tag Entity
 *
 * @property int $id
 * @property string|null $name
 */
class Tag extends Entity
{
    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array
     */
    protected $_accessible = [
        'name' => true,
        'media' => true
    ];

    public function getMedia($id = null) {
      $this->Tags = TableRegistry::get('tags');
      $this->TagsMedia = TableRegistry::get('tags_media');
      $query;
      $query_find=$this->TagsMedia->find('list',['valueField'=>'tags_id'])->where(['media_id'=>$id])->toArray(); 
      if ($query_find) {
         $query=$this->Tags->find('All')->where(['Tags.id in' => $query_find])->toArray();
      } 
       return $query;
    }
}
