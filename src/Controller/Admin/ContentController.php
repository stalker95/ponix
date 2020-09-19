<?php
namespace App\Controller\Admin;

use App\Controller\AppController;

/**
 * Content Controller
 *
 *
 * @method \App\Model\Entity\Content[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ContentController extends AppController
{
   
     public function initialize()
     {
        parent::initialize();
        
        // Include the FlashComponent
        $this->loadComponent('Flash');
        
        // Load Files model
        $this->loadModel('Faq');
        $this->loadModel('Terms');
    }
    
     /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */

    public function index()
    {
        if ($this->user->is_us()):
          return $this->redirect(['controller' => 'dashboard', 'action' => 'index', 'prefix' => 'admin']);
        endif;
        $faq = $this->paginate($this->Faq);
        $terms = $this->paginate($this->Terms);

        $this->set(compact('faq'));
        $this->set(compact('terms'));
    }

  
}
