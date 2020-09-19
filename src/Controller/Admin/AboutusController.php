<?php
namespace App\Controller\Admin;

use App\Controller\AppController;

/**
 * Aboutus Controller
 *
 * @property \App\Model\Table\AboutusTable $Aboutus
 *
 * @method \App\Model\Entity\Aboutus[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class AboutusController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $aboutus = $this->Aboutus->find()->first();
         if ($this->request->is(['patch', 'post', 'put'])) {
            $aboutus = $this->Aboutus->patchEntity($aboutus, $this->request->getData());
            if ($this->Aboutus->save($aboutus)) {
                $this->Flash->admin_success(__('Зміни збережено'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->admin_error(__('Зміни не збережено. Спробуйте пізніше'));
        }
        $this->nav_['aboutus'] = true;
        $this->set(compact('aboutus'));
    }

  
}
