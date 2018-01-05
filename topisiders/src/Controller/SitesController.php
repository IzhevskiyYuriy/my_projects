<?php
namespace App\Controller;

/**
 * Sites Controller
 *
 * @property \App\Model\Table\SitesTable $Sites
 */
class SitesController extends AppController
{
    public function isAuthorized($account)
    {
        $action = $this->request->getParam('action');
        if (in_array($action, ['index', 'add'])) return true;
        
        if (!$this->request->getParam('pass.0')) return false;
        
        $id = $this->request->getParam('pass.0');
        $site = $this->Sites->get($id);
        if ($site->account_id == $account['id']) return true;
        
        parent::isAuthorized($account);
    }

    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'conditions' =>[
                'Sites.account_id' => $this->Auth->user('id')],
    
            'contain' => ['Categories', 'Accounts', 'Blocks']
        ];

        $sites = $this->paginate($this->Sites);
        $sites->account_id = $this->Auth->user('id');
        $this->set(compact('sites'));
        $this->set('_serialize', ['sites']);
    }

    /**
     * View method
     *
     * @param string|null $id Site id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $site = $this->Sites->get($id, [
            'contain' => ['Categories', 'Accounts', 'Blocks']
        ]);
        
       
        $this->set('site', $site);
        $this->set('_serialize', ['site']);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $site = $this->Sites->newEntity();

        if ($this->request->is('post')) {
            $site = $this->Sites->patchEntity($site, $this->request->getData());
            $site->account_id = $this->Auth->user('id');

            if ($this->Sites->save($site)) {
                $this->Flash->success(__('The site has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The site could not be saved. Please, try again.'));
        }

        $categories = $this->Sites->Categories->find('list', ['limit' => 200]);
        $accounts = $this->Sites->Accounts->find('list', ['limit' => 200]);
        $this->set(compact('site', 'categories', 'accounts'));
        $this->set('_serialize', ['site']);
        
    }

    /**
     * Edit method
     *
     * @param string|null $id Site id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $site = $this->Sites->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $site = $this->Sites->patchEntity($site, $this->request->getData());
            $site->account_id = $this->Auth->user('id');
        if ($this->Sites->save($site)) {
                $this->Flash->success(__('The site has been saved.'));
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The site could not be saved. Please, try again.'));
        }
        
        $categories = $this->Sites->Categories->find('list', ['limit' => 200]);
        $accounts = $this->Sites->Accounts->find('list', ['limit' => 200]);
        $this->set(compact('site', 'categories', 'accounts'));
        $this->set('_serialize', ['site']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Site id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $site = $this->Sites->get($id);
        if ($this->Sites->delete($site)) {
            $this->Flash->success(__('The site has been deleted.'));
        } else {
            $this->Flash->error(__('The site could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
