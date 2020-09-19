<?php
namespace App\Controller\Admin;

use App\Controller\AppController;

/**
 * DeliveryPage Controller
 *
 * @property \App\Model\Table\DeliveryPageTable $DeliveryPage
 *
 * @method \App\Model\Entity\DeliveryPage[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class DeliveryPageController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $deliveryPage = $this->DeliveryPage->find()->first();
        if ($this->request->is(['patch', 'post', 'put'])) {
            $deliveryPage = $this->DeliveryPage->patchEntity($deliveryPage, $this->request->getData());
            if ($this->DeliveryPage->save($deliveryPage)) {
                $this->Flash->admin_success(__('Зміни збережено'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->admin_error(__('Зміни не збережено'));
        }
        $this->nav_['delivery'] = true;
        $this->set(compact('deliveryPage'));
    }
}
