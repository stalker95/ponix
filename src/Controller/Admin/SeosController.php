<?php
namespace App\Controller\Admin;

use App\Controller\AppController;

/**
 * Seo Controller
 *
 * @property \App\Model\Table\SeoTable $Seo
 *
 * @method \App\Model\Entity\Seo[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class SeosController extends AppController
{
    public function initialize()
     {
        parent::initialize();
        $this->Auth->allow(['index','register']);
        // Include the FlashComponent
        $this->loadComponent('Flash');
        
        // Load Files model
        $this->loadModel('Seo');
    }
    /**
    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $seo = $this->Seo->find('all')->first();

        if ($this->request->is('post')) {
            debug('regerg');

            $seo = $this->Seo->patchEntity($seo, $this->request->getData());
            if ($this->Seo->save($seo)) {
                $this->Flash->admin_success(__('Налаштування збережено'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->admin_error(__('Налаштування не збережено'));
        }

        $this->nav_['seo'] = true;

        $this->set(compact('seo'));
    }

    public function edit($id = null)
    {
        $this->autoRender = false;
       $seo = $this->Seo->find('all')->first();

            $seo = $this->Seo->patchEntity($seo, $this->request->getData());
            if ($this->Seo->save($seo)) {
                $this->Flash->admin_success(__('Налаштування збережено'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->admin_error(__('Налаштування не збережено'));
        
    }

  
}
