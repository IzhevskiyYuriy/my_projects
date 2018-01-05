<?php
namespace App\Controller;

/**
 * Blocks Controller
 *
 * @property \App\Model\Table\BlocksTable $Blocks
 */
class BlocksController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Sites', 'BlocksTemplates']
        ];
        $blocks = $this->paginate($this->Blocks);

        $this->set(compact('blocks'));
        $this->set('_serialize', ['blocks']);
    }

    /**
     * View method
     *
     * @param string|null $id Block id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $block = $this->Blocks->get($id, [
            'contain' => ['Sites', 'BlocksTemplates', 'BlocksTeasersExcludeds', 'BlocksStyles']
        ]);

        $this->set('block', $block);
        $this->set('_serialize', ['block']);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $block = $this->Blocks->newEntity(null, [
            'associated' => ['BlocksStyles']
        ]);

        if ($this->request->is('post')) {
            $block = $this->Blocks->patchEntity($block, $this->request->getData(), [
                'associated' => ['BlocksStyles']
            ]);

            if ($this->Blocks->save($block)) {
                $this->Flash->success(__('The block has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The block could not be saved. Please, try again.'));
        }

        $sites = $this->Blocks->Sites
            ->find('list', [
                'limit' => 200,
                'keyField' => 'id',
                'valueField' => 'domain'
            ])
            ->where(['account_id' => $this->Auth->user('id')]);
        $blocksTemplates = $this->Blocks->BlocksTemplates
            ->find('list', [
                'limit' => 200,
                'keyField' => 'id',
                'valueField' => 'template'
            ]);
        $blocksTemplatesObjs = $this->Blocks->BlocksTemplates
            ->find('all', ['limit' => 200])
            ->formatResults(function ($results) {
                return $results->indexBy('id');
            });
        $this->set(compact('block', 'sites', 'blocksTemplates', 'blocksTemplatesObjs'));
        $this->set('_serialize', ['block']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Block id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $block = $this->Blocks->get($id, [
            'contain' => ['BlocksStyles']
        ]);

        if ($this->request->is(['patch', 'post', 'put'])) {
            $block = $this->Blocks->patchEntity($block, $this->request->getData(), [
                'associated' => ['BlocksStyles']
            ]);
            if ($this->Blocks->save($block)) {
                $this->Flash->success(__('The block has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The block could not be saved. Please, try again.'));
        }
        $sites = $this->Blocks->Sites
            ->find('list', [
                'limit' => 200,
                'keyField' => 'id',
                'valueField' => 'domain'
            ])
            ->where(['account_id' => $this->Auth->user('id')]);

        $blocksTemplates = $this->Blocks->BlocksTemplates
            ->find('list', [
                'limit' => 200,
                'keyField' => 'id',
                'valueField' => 'template'
            ]);
        $blocksTemplatesObjs = $this->Blocks->BlocksTemplates
            ->find('all', ['limit' => 200])
            ->formatResults(function ($results) {
                return $results->indexBy('id');
            });
        $this->set(compact('block', 'sites', 'blocksTemplates', 'blocksTemplatesObjs'));
        $this->set('_serialize', ['block']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Block id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $block = $this->Blocks->get($id, [
            'contain' => ['BlocksStyles']
        ]);
        if ($this->Blocks->delete($block)) {
            $this->Flash->success(__('The block has been deleted.'));
        } else {
            $this->Flash->error(__('The block could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
