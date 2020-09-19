<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;
use Cake\ORM\TableRegistry;
use Cake\Filesystem\Folder;

/**
 * Category Entity
 *
 * @property int $id
 * @property string $name
 *
 * @property \App\Model\Entity\Playlist[] $playlist
 */
class Category extends Entity
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
        '*'    => true,
        'name' => true,
        
    ];

    public  function getAllHits()
    {
        $this->Categories = TableRegistry::get('categories');
         $products = $this->Categories->find()->contain(['Products'=> [
                                                                     'conditions' => [
                                                                       'Products.hit' => 1
            ]
        ],'Products.ActionsProducts','Products.ActionsProducts.Actions','Products.Discounts','Products.Rewiev','ParentCategories','ParentCategories.ParentCategories'])->toArray();

      // debug($products);
        
        $final = [];
        $arr = [];
        $i = 0;
        foreach ($products as $key => $value) {
            
            if (!empty($value['products'])) {

            if ($value['parent_category']['parent_category']['name'] != null) {
               // debug($value['parent_category']['parent_category']['name']);
                $final[$value['parent_category']['parent_category']['name']]['image'] = $value['parent_category']['parent_category']['image'];
                $final[$value['parent_category']['parent_category']['name']]['products'] = $value['products'];
                array_push($arr, $value['products']);
            } 
            elseif($value['parent_category']['name'] != null) {
                //debug($value['parent_category']['name']);
                $final[$value['parent_category']['name']]['image'] = $value['parent_category']['image'];
                $final[$value['parent_category']['name']]['products'] = $value['products'];
                array_push($arr, $value['products']);
                 $i++;
            } else {
              //  debug($value['name']);
                $final[$value['name']]['image'] = $value['image'];
                $final[$value['name']]['products'] = $value['products'];
                array_push($arr, $value['products']);
                 $i++;
            }
        }

            
            

        }
       //  var_dump($i);
       // debug($final);

       return $final;
    }
}
