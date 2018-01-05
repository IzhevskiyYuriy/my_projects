<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * BlocksTemplates Controller
 *
 * @property \App\Model\Table\BlocksTemplatesTable $BlocksTemplates
 */
class BlocksTemplatesController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $blocksTemplates = $this->paginate($this->BlocksTemplates);

        $this->set(compact('blocksTemplates'));
        $this->set('_serialize', ['blocksTemplates']);
    }

    /**
     * View method
     *
     * @param string|null $id Blocks Template id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $blocksTemplate = $this->BlocksTemplates->get($id, [
            'contain' => []
        ]);

        $this->set('blocksTemplate', $blocksTemplate);
        $this->set('_serialize', ['blocksTemplate']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $blocksTemplate = $this->BlocksTemplates->newEntity();
        if ($this->request->is('post')) {
            $blocksTemplate = $this->BlocksTemplates->patchEntity($blocksTemplate, $this->request->getData());
            if ($this->BlocksTemplates->save($blocksTemplate)) {
                $this->Flash->success(__('The blocks template has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The blocks template could not be saved. Please, try again.'));
        }
        $this->set(compact('blocksTemplate'));
        $this->set('_serialize', ['blocksTemplate']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Blocks Template id.
     * @return \Cake\Network\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $blocksTemplate = $this->BlocksTemplates->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $blocksTemplate = $this->BlocksTemplates->patchEntity($blocksTemplate, $this->request->getData());
            if ($this->BlocksTemplates->save($blocksTemplate)) {
                $this->Flash->success(__('The blocks template has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The blocks template could not be saved. Please, try again.'));
        }
        $this->set(compact('blocksTemplate'));
        $this->set('_serialize', ['blocksTemplate']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Blocks Template id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $blocksTemplate = $this->BlocksTemplates->get($id);
        if ($this->BlocksTemplates->delete($blocksTemplate)) {
            $this->Flash->success(__('The blocks template has been deleted.'));
        } else {
            $this->Flash->error(__('The blocks template could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
