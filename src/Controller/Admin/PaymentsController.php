<?php
namespace App\Controller\Admin;

use App\Controller\AppController;

/**
 * Payments Controller
 *
 * @property \App\Model\Table\PaymentsTable $Payments
 *
 * @method \App\Model\Entity\Payment[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class PaymentsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $payments = $this->Payments->find()->first();
         if ($this->request->is(['patch', 'post', 'put'])) {
            $payments = $this->Payments->patchEntity($payments, $this->request->getData());
            if ($this->Payments->save($payments)) {
                $this->Flash->admin_success(__('Зміни збережено'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->admin_error(__('Зміни не збережено. Спробуйте пізніше'));
        }
        $this->nav_['payments'] = true;
        $this->set(compact('payments'));
    }

}
