<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;
use Cake\ORM\TableRegistry;
use Cake\Filesystem\Folder;

/**
 * Producer Entity
 *
 * @property int $id
 * @property string $name
 * @property string $image
 * @property string $slug
 */
class Producer extends Entity
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
        'image' => true,
        'slug' => true
    ];

    public function getAllProducers($category_id)
    {
       $this->Producers = TableRegistry::get('producers');

       $producers = $this->Producers->find('all')->contain(['Products' => function ($e) use ($category_id) {
                                    $e ->find('all');
                                    $e ->autoFields(true);
                                   
                                    $e ->where(['Products.category_id' => $category_id]);
                                    return $e;
                               }
        ])->toArray();

       $producers_list = [];
      // debug($producers);
      // debug($producers);
       foreach ($producers as $key => $value) {
        foreach ($value['products'] as $keys => $item) {
             if (!isset($producers_list[$value['name']])) {
             $producers_list[$value['name']] = [];
             $producers_list[$value['name']]['name'] = $value['name'];
             $producers_list[$value['name']]['id'] = $value['id'];
             $producers_list[$value['name']]['count'] = 1;
           } else {
            $producers_list[$value['name']]['count'] = $producers_list[$value['name']]['count'] + 1;
           }
        }
          
       }
      // debug($producers_list);

       return $producers_list;
    }

  public function getAllProducersAfterFilter($peoducts_list)
    {
      //debug($peoducts_list);
      $products_id = array_column($peoducts_list, 'product_id');
     // debug($products_id);
       $this->Producers = TableRegistry::get('producers');

       $producers = $this->Producers->find('all')->contain(['Products' => [
                                                                     'conditions' => [
                                                                       'Products.id IN ' => $products_id
            ]
        ]])->toArray();

       $producers_list = [];
      // debug($producers);
      // debug($producers);
       foreach ($producers as $key => $value) {
        foreach ($value['products'] as $keys => $item) {
             if (!isset($producers_list[$value['name']])) {
             $producers_list[$value['name']] = [];
             $producers_list[$value['name']]['name'] = $value['name'];
             $producers_list[$value['name']]['id'] = $value['id'];
             $producers_list[$value['name']]['count'] = 1;
           } else {
            $producers_list[$value['name']]['count'] = $producers_list[$value['name']]['count'] + 1;
           }
        }
          
       }
      // debug($producers_list);

       return $producers_list;
    }
}
