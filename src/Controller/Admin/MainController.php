<?php
namespace App\Controller\Admin;

use App\Controller\AppController;

/**
 * Main Controller
 *
 *
 * @method \App\Model\Entity\Main[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class MainController extends AppController
{
    public function initialize()
     {
        parent::initialize();
        
        // Include the FlashComponent
        $this->loadComponent('Flash');
        
        // Load Files model
        $this->loadModel('TopBlock');
        $this->loadModel('Solution');
        $this->loadModel('Programs');
        $this->loadModel('Titles');
        $this->loadModel('AdvertisingsMain');
        $this->loadModel('Statistics');
        $this->loadModel('About');
    }
    
    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
     public function index()
    {
        $main_block = $this->paginate($this->TopBlock);
        $solution = $this->paginate($this->Solution);
        $programs = $this->paginate($this->Programs);
        $titles = $this->Titles->find('all')->where(['OR' => ['id ' => 1,'id' => 2]])->toArray();
        $advertisingsMain =  $this->AdvertisingsMain->find('all')->toArray();
        $statistics = $this->paginate($this->Statistics);

        $about = $this->paginate($this->About);

        $this->set(compact('main_block'));
        $this->set(compact('solution'));
        $this->set(compact('programs'));
        $this->set(compact('titles'));
        $this->set(compact('advertisingsMain'));
        $this->set(compact('statistics'));
        $this->set(compact('about'));
    }

    
}
