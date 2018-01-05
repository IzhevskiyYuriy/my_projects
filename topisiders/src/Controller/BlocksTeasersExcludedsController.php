<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * BlocksTeasersExcludeds Controller
 *
 * @property \App\Model\Table\BlocksTeasersExcludedsTable $BlocksTeasersExcludeds
 */
class BlocksTeasersExcludedsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Blocks'/*, 'Teasers'*/]
        ];
        $blocksTeasersExcludeds = $this->paginate($this->BlocksTeasersExcludeds);

        $this->set(compact('blocksTeasersExcludeds'));
        $this->set('_serialize', ['blocksTeasersExcludeds']);
    }

    /**
     * View method
     *
     * @param string|null $id Blocks Teasers Excluded id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $blocksTeasersExcluded = $this->BlocksTeasersExcludeds->get($id, [
            'contain' => ['Blocks'/*, 'Teasers'*/]
        ]);

        $this->set('blocksTeasersExcluded', $blocksTeasersExcluded);
        $this->set('_serialize', ['blocksTeasersExcluded']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $blocksTeasersExcluded = $this->BlocksTeasersExcludeds->newEntity();
        if ($this->request->is('post')) {
            $blocksTeasersExcluded = $this->BlocksTeasersExcludeds->patchEntity($blocksTeasersExcluded, $this->request->getData());
            if ($this->BlocksTeasersExcludeds->save($blocksTeasersExcluded)) {
                $this->Flash->success(__('The blocks teasers excluded has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The blocks teasers excluded could not be saved. Please, try again.'));
        }
        $blocks = $this->BlocksTeasersExcludeds->Blocks->find('list', ['limit' => 200]);
        $teasers = []; //$this->BlocksTeasersExcludeds->Teasers->find('list', ['limit' => 200]);
        $this->set(compact('blocksTeasersExcluded', 'blocks', 'teasers'));
        $this->set('_serialize', ['blocksTeasersExcluded']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Blocks Teasers Excluded id.
     * @return \Cake\Network\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $blocksTeasersExcluded = $this->BlocksTeasersExcludeds->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $blocksTeasersExcluded = $this->BlocksTeasersExcludeds->patchEntity($blocksTeasersExcluded, $this->request->getData());
            if ($this->BlocksTeasersExcludeds->save($blocksTeasersExcluded)) {
                $this->Flash->success(__('The blocks teasers excluded has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The blocks teasers excluded could not be saved. Please, try again.'));
        }
        $blocks = $this->BlocksTeasersExcludeds->Blocks->find('list', ['limit' => 200]);
        $teasers = []; //$this->BlocksTeasersExcludeds->Teasers->find('list', ['limit' => 200]);
        $this->set(compact('blocksTeasersExcluded', 'blocks', 'teasers'));
        $this->set('_serialize', ['blocksTeasersExcluded']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Blocks Teasers Excluded id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $blocksTeasersExcluded = $this->BlocksTeasersExcludeds->get($id);
        if ($this->BlocksTeasersExcludeds->delete($blocksTeasersExcluded)) {
            $this->Flash->success(__('The blocks teasers excluded has been deleted.'));
        } else {
            $this->Flash->error(__('The blocks teasers excluded could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
