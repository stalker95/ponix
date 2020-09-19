<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;

/**
 * Blog Controller
 *
 *
 * @method \App\Model\Entity\Blog[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class BlogController extends AppController
{
    public function beforeFilter(Event $event)
    {
        parent::initialize();
        $this->Auth->allow(['index','register','view', 'category', 'search']);
        $this->loadModel('BlogCategories');
        $this->loadModel('Blogs');
        $this->loadComponent('Paginator');
    }
    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $this->paginate = [
                'limit' => '2'
            ];

            $_monthsList = array(
            "01" => "Січня",
            "02" => "Лютого",
            "03" => "Березня",
            "04" => "Квітня",
            "05" => "Травня",
            "06" => "Червня",
            "07" => "Липня",
            "08" => "Серпня",
            "09" => "Вересня",
            "10" => "Жовтня",
            "11" => "Листопада",
            "12" => "Грудня"
        );
            $search = "";
 
            $data = $this->request->getData();
         if ($this->request->is('post')) {
          debug('erg');
           $name = $data['search'];    
           $search = $data['search'];      
          $blogs = $this->Paginate($this->Blogs->find()->contain(['BlogCategories', 'Users'])->where(['title LIKE ' => "%".$name."%"]))->toArray();
         } else {
           $blogs = $this->paginate($this->Blogs->find()->contain(['Users']))->toArray();

         }

       
       


        $latest_news = $this->Blogs->find()->order(['id DESC'])->limit(8)->toArray();
        $blogCategories = $this->BlogCategories->find()->toArray();

        foreach ($blogs as $key => $value) {
            $_mD = date("m", strtotime($value['created']));
            $blogs[$key]['month'] = $_monthsList[$_mD];
        }

        $this->set(compact('blogs', 'blogCategories', 'latest_news', 'search'));
    }

    /**
     * View method
     *
     * @param string|null $id Blog id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($slug = null)
    {
      $search = "";
      $this->viewBuilder()->setLayout('blog');
      $slug = $this->request->params['param1'];
              $latest_news = $this->Blogs->find()->order(['id DESC'])->limit(8)->toArray();

         $_monthsList = array(
            "01" => "Січня",
            "02" => "Лютого",
            "03" => "Березня",
            "04" => "Квітня",
            "05" => "Травня",
            "06" => "Червня",
            "07" => "Липня",
            "08" => "Серпня",
            "09" => "Вересня",
            "10" => "Жовтня",
            "11" => "Листопада",
            "12" => "Грудня"
        );
        $blog = $this->Blogs->find()->contain(['BlogCategories','Users'])->where(['Blogs.slug' => $slug])->first();

        $prev_post = $this->Blogs
                          ->find()
                          ->where(['id < ' <= $blog->id])
                          ->where(['id != ' <= $blog->id])
                          ->limit('1')
                          ->first();

        $next_post =  $this->Blogs
                          ->find()
                          ->contain(['BlogCategories'])
                          ->where(['Blogs.id > ' => $blog->id])
                          ->limit('1')
                          ->first();
      //  debug($next_post);

        $other_posts = $this->Blogs
                             ->find()
                             ->order(['id DESC'])
                             ->limit(2)
                             ->toArray();

        $_mD = date("m", strtotime($blog->created));
        $blog->month = $_monthsList[$_mD];

        foreach ($other_posts as $key => $value) {
           $_mDD = date("m", strtotime($value['created']));
            $other_posts[$key]['month'] = $_monthsList[$_mDD];
        }

        
        

        $blogCategories = $this->BlogCategories->find()->toArray();

        $this->set('blog', $blog);
        $this->set('blogCategories', $blogCategories);
        $this->set(compact('next_post', 'prev_post', 'other_posts', 'latest_news', 'search'));
    }

    public function category($slug = null)
    {
              $latest_news = $this->Blogs->find()->order(['id DESC'])->limit(8)->toArray();

      $this->paginate = [
                'limit' => '2'
            ];
        $blog_category = $this->BlogCategories->find()->where(['slug' => $slug])->first();
        $blogs = $this->Paginate($this->Blogs->find()->contain(['BlogCategories', 'Users'])->where(['category_id' => $blog_category->id]))->toArray();
                $blogCategories = $this->BlogCategories->find()->toArray();

        $this->set('blogs', $blogs);
        $this->set('blogCategories', $blogCategories);
        $this->set('latest_news', $latest_news);
    }

    public function search()
    {
       $_monthsList = array(
            "01" => "Січня",
            "02" => "Лютого",
            "03" => "Березня",
            "04" => "Квітня",
            "05" => "Травня",
            "06" => "Червня",
            "07" => "Липня",
            "08" => "Серпня",
            "09" => "Вересня",
            "10" => "Жовтня",
            "11" => "Листопада",
            "12" => "Грудня"
        );
              $this->paginate = [
                'limit' => '2'
            ];
    if ($this->request->is('get')) {
          $data = $this->request->query;
          //debug($this->request);
           $name = $data['search'];    
           $search = $data['search'];      
          $blogs = $this->Paginate($this->Blogs->find()->contain(['BlogCategories', 'Users'])->where(['title LIKE ' => "%".$name."%"]))->toArray();
         } 
      $latest_news = $this->Blogs->find()->order(['id DESC'])->limit(8)->toArray();
        $blogCategories = $this->BlogCategories->find()->toArray();

        foreach ($blogs as $key => $value) {
            $_mD = date("m", strtotime($value['created']));
            $blogs[$key]['month'] = $_monthsList[$_mD];
        }

        $this->set(compact('blogs', 'blogCategories', 'latest_news', 'search'));
    }
}
