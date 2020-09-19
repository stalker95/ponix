<?php
namespace App\Controller\Admin;

use App\Controller\AppController;

/**
 * Rules Controller
 *
 * @property \App\Model\Table\RulesTable $Rules
 *
 * @method \App\Model\Entity\Rule[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class RulesController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $rules = $this->Rules->find()->first();
        if ($this->request->is(['patch', 'post', 'put'])) {
            $rules = $this->Rules->patchEntity($rules, $this->request->getData());
            if ($this->Rules->save($rules)) {
                $this->Flash->admin_success(__('Зміни збережено'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->admin_error(__('Зміни не збережено. Спробуйте пізніше'));
        }
        $this->nav_['rules'] = true;
        $this->set(compact('rules'));
    }

   
}
