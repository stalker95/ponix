<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * About Controller
 *
 * @property \App\Model\Table\AboutTable $About
 *
 * @method \App\Model\Entity\About[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class AboutController extends AppController
{
    public function initialize()
     {
        parent::initialize();
        $this->Auth->allow(['index']);
        $this->loadComponent('Flash');
        $this->loadModel('Aboutus');
    }
    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $about = $this->Aboutus->find()->first();

        $this->set(compact('about'));
    }

}
