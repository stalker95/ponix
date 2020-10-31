<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;
use Cake\ORM\TableRegistry;
use Cake\Filesystem\Folder;

/**
 * Product Entity
 *
 * @property int $id
 * @property string $title
 * @property string $slug
 * @property string $description
 * @property string $title_page
 * @property string $keywords
 * @property string $page_description
 * @property float $price
 * @property int $amount
 * @property \Cake\I18n\FrozenTime $created
 * @property int $status
 * @property string $image
 * @property int $category_id
 *
 * @property \App\Model\Entity\Category $category
 */
class Product extends Entity
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
        '*'  => true,
        'id' => true,
        'title' => true,
        'slug' => true,
        'description' => true,
        'title_page' => true,
        'keywords' => true,
        'page_description' => true,
        'price' => true,
        'amount' => true,
        'created' => true,
        'status' => true,
        'image' => true,
        'category_id' => true,
        'in_orders' => true,
        'category' => true
    ];

    public function saveOptions($data = null, $id_product)
    {
                 $this->ProductsOptions = TableRegistry::get('products_options');
        $product_options = $this->ProductsOptions
                               ->find()
                               ->where(['product_id' => $id_product])
                               ->toArray();
        foreach ($product_options as $key => $value) {
          $product_option = $this->ProductsOptions->get($value['id']);
          $this->ProductsOptions->delete($product_option);
            
        }                      
      $array_of_values = [];
      foreach ($data as $key => $value) {
                $key_array = $key;
            if (strpos($key_array, 'amount_option') === true OR strpos($key_array, 'amount_option') === 0) {
                foreach ($value as $keys => $item) {
                    array_push($array_of_values, $item);
                }
            }
      }
      
      $array_of_options = []; 
        foreach ($data as $key => $value) {
            
                $key_array = $key;
            if (strpos($key_array, 'options_item') === true OR strpos($key_array, 'options_item') === 0) {
                $option = explode('_', $key_array);
                foreach ($value as $keys => $item) {
                    array_push($array_of_options, $item);
                }
            }
            $key_array = "";
        } 


         foreach ($array_of_values as $key => $value) {
          if (!empty($value)) {
            $product_option = $this->ProductsOptions->newEntity();
            $product_option->product_id = $id_product;
            $product_option->value = $value;
            $product_option->options_items_id = $array_of_options[$key];
            $this->ProductsOptions->save($product_option);
          }
         }
    }

    public function saveAttributes($attributes, $attributes_values, $product_id)
    {
        $this->AttributesProducts = TableRegistry::get('attributes_products');
         if (!empty($attributes)) {
      foreach ($attributes as $key => $value) {
                $attribute_product = $this->AttributesProducts->newEntity();
                $attribute_product->product_id = $product_id;
                $attribute_product->attribute_id = (int)$value;
                $attribute_product->value = trim($attributes_values[$key]);
                if (!empty($attributes_values[$key])) {
                $this->AttributesProducts->save($attribute_product);
              }
      }
      }
    }


    public function getOptionsGroup($id_product, $persent_discount)
    {
        $this->ProductsOptions = TableRegistry::get('products_options');
        $this->Options = TableRegistry::get('options');
        $this->Products = TableRegistry::get('products');
         
        
       // debug($options_products);
        
        $options = $this->Options->find()->contain(['OptionsItems','OptionsItems.ProductsOptions'
                                                                   => [
                                                                     'conditions' => [
                                                                       'ProductsOptions.product_id' => $id_product
            ]
        ]
      ])->toArray();
        
       // debug($options);
        $product = $this->Products
                        ->find()
                        ->contain(['ProductsOptions.OptionsItems.Options','Discounts'])
                        ->where(['id' => $id_product])
                        ->first();

        $data = date("Y-m-d H:i:s");
        foreach ($product['discounts'] as $key => $values): 
         // debug($values);
          $date_compare1= date("Y-m-d H:i:s", strtotime($data));
            // date now
          $date_compare2= date("Y-m-d H:i:s", strtotime($values['end_data']->i18nFormat('YYY-MM-dd')));
          $start_data = date("Y-m-d H:i:s", strtotime($values['start_data']->i18nFormat('YYY-MM-dd')));

          if ($date_compare1 < $date_compare2 AND $date_compare1 > $start_data) {
            $products_discount = $values['price'];
            $discount = true;
            break;
          }

        endforeach;

        $group_options = [];
        $current_options = [];
        foreach ($options as $key => $value):
           $current_options[$value['name']] = [];
            foreach ($value['options_items'] as $key => $item) {
             foreach ($item['products_options'] as $key => $product_item) {
               if ($product_item['product_id'] == $id_product) {
                if ($persent_discount != 100) {
                 // debug($item['products_options'][0]['value']);
                  $item['products_options'][0]['value'] = $item['products_options'][0]['value'] - (($item['products_options'][0]['value'] / 100) * $persent_discount);
                 // debug($item['products_options'][0]['value']);
                }
                //debug($item['products_options']);
                array_push($group_options, $value['name']);
                
                array_push($current_options[$value['name']], $item);
               // $current_options[$value['name']] = $ite
              //   debug($item);
               }
             }
            }
            if (empty($current_options[$value['name']])) {
              unset($current_options[$value['name']]);
            }
        endforeach;
     // debug($group_options);
     // debug($current_options);
      return $current_options;
    }

    public function saveGallery($gallery, $alts, $id_product)
    {
      $this->ProductsGallery = TableRegistry::get('products_gallery');
      if (!empty($gallery)) {
      foreach ($gallery  as $key => $value) {
                $filename = "";
                if ($value['name']) {
                        $mm_dir = new Folder(WWW_ROOT . DS . 'products_gallery', true, 0777);
                        $target_path = $mm_dir->pwd() . DS;

                        $ext = pathinfo($value['name'], PATHINFO_EXTENSION);
                        $filename = md5($value['name'].microtime(true)) . '.' . $ext;
                        move_uploaded_file($value['tmp_name'], $target_path . $filename);
                        $product_media = $this->ProductsGallery->newEntity();
                        $product_media->product_id = $id_product;
                        $product_media->name = $filename;
                        $product_media->alt = $alts[$key];
                        $product_media->position = $key+1;
                        $this->ProductsGallery->save($product_media);
                        $filename = "";
                    }
            }
          }
    }
    public function deleteGallery($new_pictures, $products_gallery)
    {
      $this->ProductsGallery = TableRegistry::get('products_gallery');
      if (!empty($new_pictures)) {
      foreach ($new_pictures as $key => $value) {
                    if (!empty($value['name'])) {
                      if (isset($products_gallery[$key]['id'])) {
                        $product_gallery = $this->ProductsGallery->get($products_gallery[$key]['id']);
                        $this->ProductsGallery->delete($product_gallery);
                         $mm_dir = new Folder(WWW_ROOT  . DS . 'products_gallery', true, 0777);
                        $target_path = $mm_dir->pwd() . DS;
                        $oldfile = $target_path . $product_gallery->name;

                        if (file_exists($oldfile)) {
                            unlink($oldfile);
                        }
                      }
                    }
                }
              }
    }
    public function saveDiscounts($prices, $begin_data, $end_data, $product_id) 
    {
     // debug($prices);
      $this->Discounts = TableRegistry::get('discounts');
      
      $discounts = $this->Discounts->find()->where(['product_id' => $product_id])->toArray();
      

      foreach ($discounts as $key => $value) {
        $discount = $this->Discounts->get($value['id']);
        $this->Discounts->delete($discount);
      }
      
      
      if (!empty($prices)) {
       foreach ($prices as $key => $value) {
                    $discounts = $this->Discounts->newEntity();
                    $discounts->price = $value;
                    $discounts->start_data =  date("Y-m-d H:i:s", strtotime($begin_data[$key]));
                    $discounts->end_data =  date("Y-m-d H:i:s", strtotime($end_data[$key]));
                    $discounts->product_id = $product_id;

                    $this->Discounts->save($discounts);
                }
      }
      
    }
  

    public function copyElement($id = null)
    {
       $this->Products = TableRegistry::get('products');
       $this->AttributesProducts = TableRegistry::get('attributes_products');
       $this->ProductsOptions = TableRegistry::get('products_options');

       $product = $this->Products->get($id);

       $new_product = $this->Products->newEntity();

       $new_product->title = $product->title;
       $new_product->slug = $product->slug;
       $new_product->description = $product->description;
       $new_product->title_page = $product->title_page;
       $new_product->price = $product->price;
       $new_product->keywords = $product->keywords;
       $new_product->page_description = $product->page_description;
       $new_product->amount = $product->amount;
       $new_product->created = time();
       $new_product->status = $product->status;
       $new_product->image = $product->image;
       $new_product->category_id = $product->category_id;
       $new_product->producer_id = $product->producer_id;
       $new_product->video = $product->video;
       $new_product->cod = $product->cod;
       $new_product->currency_id = $product->currency_id;
       $new_product->hit = $product->hit;

       $this->Products->save($new_product);

       $old_attributes = $this->AttributesProducts->find()->where(['product_id' => $id])->toArray();
       $old_options = $this->ProductsOptions->find()->where(['product_id' => $id])->toArray();

       foreach ($old_attributes as $key => $value) {
         $new_attribute = $this->AttributesProducts->newEntity();
         $new_attribute->product_id = $new_product->id;
         $new_attribute->attribute_id = $value['attribute_id'];
         $new_attribute->value = $value['value'];
         $this->AttributesProducts->save($new_attribute); 

       }

       foreach ($old_options as $key => $value) {
         $new_option = $this->ProductsOptions->newEntity();
         $new_option->product_id = $new_product->id;
         $new_option->options_items_id = $value['options_items_id'];
         $new_option->value = $value['value'];
         $this->ProductsOptions->save($new_option); 

       }
       
    }

    public function deleteAllData($id_product)
    {

    }

     public function saveCoupons($coupons, $attributes_values, $product_id)
    {
        $this->CouponsProducts = TableRegistry::get('coupons_products');
         if (!empty($coupons)) {
      foreach ($coupons as $key => $value) {
                $attribute_product = $this->CouponsProducts->newEntity();
                $attribute_product->product_id = $product_id;
                $attribute_product->coupon_id = (int)$value;
                $attribute_product->discount = trim($attributes_values[$key]);
                if (!empty($attributes_values[$key])) {
                $this->CouponsProducts->save($attribute_product);
              }
      }
      }
    }
}
