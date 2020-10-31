<?php
namespace App\Controller\Admin;

use App\Controller\AppController;
use Cake\Routing\Router;

/**
 * XmlController Controller
 *
 *
 * @method \App\Model\Entity\XmlController[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class XmlController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $this->loadModel('Categories');
        $Categories = $this->paginate($this->Categories->find()->where(['Categories.parent_id !=' => 0]))->toArray();
if ($this->request->is('post')) {
    $ids = $this->request->getData('ids');
    $categories = $this->paginate($this->Categories
                        ->find()
                        ->contain('Products.Producers')
                        ->where(['Categories.id IN' => $ids])
                        ->where(['Categories.parent_id !=' => 0]))
                        ->toArray();
    $products = array_column($categories, 'products');
           $protocol = "http";
$url_site = $protocol . "://" . $_SERVER['HTTP_HOST'].'/';
    $text = '';

    $start_xml = '<!--This XML file does not appear to have any style information associated with it. The document tree is shown below. -->
<rss xmlns:g="http://base.google.com/ns/1.0" version="2.0">
<channel>
<title>Example - Online Store</title>
<link>http://www.example.com</link>
<description>
This is a sample feed containing the required and recommended attributes for a variety of different products
</description>
<!--
 First example shows what attributes are required and recommended for items that are not in the apparel category 
-->';

    foreach ($products[0] as $key => $value) {

        //debug($value['producer']);
        $url = $url_site.'products/'.$value['slug'];
        $file = $url_site.'img/products/'.$value['image'];
        $description = $value['description'];
        $description = str_replace('&nbsp;', ' ', $description);
        $description = str_replace('&bull;', ' ', $description);
        $description = str_replace('&Oslash;', ' ', $description);
        $text = $text.'<item>
<!--  The following attributes are always required  -->
<g:id>'.$value['id'].'</g:id>
<g:title>'.$value['title'].'</g:title>
<g:description>'.$description.'</g:description>
<g:link>'.$url.'</g:link>
<g:image_link>'.$file.'</g:image_link>
<g:condition>used</g:condition>
<g:availability>in stock</g:availability>
<g:price>'.$value['price'].' USD</g:price>
<g:shipping>
<g:country>UA</g:country>
<g:service>Standard</g:service>
<g:price>0 USD</g:price>
</g:shipping>
<!--
 2 of the following 3 attributes are required fot this item according to the Unique Product Identifier Rules 
-->
<g:gtin>'.$value['cod'].'</g:gtin>
<g:brand>'.$value['producer']->title.'</g:brand>
<g:mpn>22LB4510/US</g:mpn>
</item>';
    }
    $string = $start_xml.$text.'</channel>
</rss>';
           file_put_contents("myxmlfile.xml", $string);
           $this->Flash->admin_success(__('Xml файл створено'));

        }
        $this->set(compact('Categories'));
    }



    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $xmlController = $this->XmlController->newEntity();
        if ($this->request->is('post')) {
            $string = "dfgdf";
           file_put_contents("myxmlfile.xml", $string);

        }
        $this->set(compact('xmlController'));
    }

    
}
