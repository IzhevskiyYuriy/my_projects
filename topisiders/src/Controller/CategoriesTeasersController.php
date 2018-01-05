<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * CategoriesTeasers Controller
 *
 * @property \App\Model\Table\CategoriesTeasersTable $CategoriesTeasers
 */
class CategoriesTeasersController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Categories', 'Teasers']
        ];
        $categoriesTeasers = $this->paginate($this->CategoriesTeasers);

        $this->set(compact('categoriesTeasers'));
        $this->set('_serialize', ['categoriesTeasers']);
    }

    /**
     * View method
     *
     * @param string|null $id Categories Teaser id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $categoriesTeaser = $this->CategoriesTeasers->get($id, [
            'contain' => ['Categories', 'Teasers']
        ]);

        $this->set('categoriesTeaser', $categoriesTeaser);
        $this->set('_serialize', ['categoriesTeaser']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $categoriesTeaser = $this->CategoriesTeasers->newEntity();
        if ($this->request->is('post')) {
            $categoriesTeaser = $this->CategoriesTeasers->patchEntity($categoriesTeaser, $this->request->getData());
            if ($this->CategoriesTeasers->save($categoriesTeaser)) {
                $this->Flash->success(__('The categories teaser has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The categories teaser could not be saved. Please, try again.'));
        }
        $categories = $this->CategoriesTeasers->Categories->find('list', ['limit' => 200]);
        $teasers = $this->CategoriesTeasers->Teasers->find('list', ['limit' => 200]);
        $this->set(compact('categoriesTeaser', 'categories', 'teasers'));
        $this->set('_serialize', ['categoriesTeaser']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Categories Teaser id.
     * @return \Cake\Network\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $categoriesTeaser = $this->CategoriesTeasers->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $categoriesTeaser = $this->CategoriesTeasers->patchEntity($categoriesTeaser, $this->request->getData());
            if ($this->CategoriesTeasers->save($categoriesTeaser)) {
                $this->Flash->success(__('The categories teaser has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The categories teaser could not be saved. Please, try again.'));
        }
        $categories = $this->CategoriesTeasers->Categories->find('list', ['limit' => 200]);
        $teasers = $this->CategoriesTeasers->Teasers->find('list', ['limit' => 200]);
        $this->set(compact('categoriesTeaser', 'categories', 'teasers'));
        $this->set('_serialize', ['categoriesTeaser']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Categories Teaser id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $categoriesTeaser = $this->CategoriesTeasers->get($id);
        if ($this->CategoriesTeasers->delete($categoriesTeaser)) {
            $this->Flash->success(__('The categories teaser has been deleted.'));
        } else {
            $this->Flash->error(__('The categories teaser could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
