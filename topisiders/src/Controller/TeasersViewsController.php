<?php
namespace App\Controller;


/**
 * TeasersViews Controller
 *
 * @property \App\Model\Table\TeasersViewsTable $TeasersViews
 */
class TeasersViewsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $query = $this->TeasersViews->Blocks->Sites
            ->find('all')
            ->contain(['Blocks', 'Blocks.TeasersViews', 'Blocks.TeasersViews.Teasers'])
            ->where(['Sites.account_id' => $this->Auth->user('id')]);

        $teasersViews = $this->paginate($query);

        $this->set(compact('teasersViews'));
        $this->set('_serialize', ['teasersViews']);
    }

    /**
     * View method
     *
     * @param string|null $id Teasers View id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $teasersView = $this->TeasersViews->get($id, [
            'contain' => ['Blocks', 'Teasers']
        ]);

        $this->set('teasersView', $teasersView);
        $this->set('_serialize', ['teasersView']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $teasersView = $this->TeasersViews->newEntity();
        if ($this->request->is('post')) {
            $teasersView = $this->TeasersViews->patchEntity($teasersView, $this->request->getData());
            if ($this->TeasersViews->save($teasersView)) {
                $this->Flash->success(__('The teasers view has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The teasers view could not be saved. Please, try again.'));
        }
        $blocks = $this->TeasersViews->Blocks->find('list', ['limit' => 200]);
        $teasers = $this->TeasersViews->Teasers->find('list', ['limit' => 200]);
        $this->set(compact('teasersView', 'blocks', 'teasers'));
        $this->set('_serialize', ['teasersView']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Teasers View id.
     * @return \Cake\Network\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $teasersView = $this->TeasersViews->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $teasersView = $this->TeasersViews->patchEntity($teasersView, $this->request->getData());
            if ($this->TeasersViews->save($teasersView)) {
                $this->Flash->success(__('The teasers view has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The teasers view could not be saved. Please, try again.'));
        }
        $blocks = $this->TeasersViews->Blocks->find('list', ['limit' => 200]);
        $teasers = $this->TeasersViews->Teasers->find('list', ['limit' => 200]);
        $this->set(compact('teasersView', 'blocks', 'teasers'));
        $this->set('_serialize', ['teasersView']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Teasers View id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $teasersView = $this->TeasersViews->get($id);
        if ($this->TeasersViews->delete($teasersView)) {
            $this->Flash->success(__('The teasers view has been deleted.'));
        } else {
            $this->Flash->error(__('The teasers view could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
