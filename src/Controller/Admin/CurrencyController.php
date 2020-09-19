<?php
namespace App\Controller\Admin;

use App\Controller\AppController;

/**
 * Currency Controller
 *
 * @property \App\Model\Table\CurrencyTable $Currency
 *
 * @method \App\Model\Entity\Currency[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class CurrencyController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index($id = null)
    {
        $currency = $this->Currency->find()->first();

        if ($this->request->is(['patch', 'post', 'put'])) {
            $currency = $this->Currency->patchEntity($currency, $this->request->getData());
            if ($this->Currency->save($currency)) {
                $this->Flash->admin_success(__('Валюти змінено'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->admin_error(__('Валюти не змінено. Спробуйте пізніше.'));
        }

        $this->nav_['currencys'] = true; 
        $this->set(compact('currency'));
    }

    /*public function edit($id = null) {
        $this->autoRender = false;
        $currency = $this->Currency->find()->first();

        if ($this->request->is('post')) {
                    debug("ergerg");

            $currency = $this->Currency->patchEntity($currency, $this->request->getData());
            if ($this->Currency->save($currency)) {
                $this->Flash->admin_success(__('Валюти змінено'));

                return $this->redirect(['action' => 'index']);
            }
            debug($currency);
            $this->Flash->admin_error(__('Валюти не змінено. Спробуйте пізніше.'));
        }
    } */

}
