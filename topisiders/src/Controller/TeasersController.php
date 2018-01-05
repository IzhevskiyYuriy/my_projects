<?php
namespace App\Controller;

use App\Controller\AppController;
use App\Model\Entity\RemoteTeaser;
use Cake\Network\Exception\NotFoundException;
use Cake\Event\Event;
use Cake\Controller\Controller;
use Cake\Filesystem\File;
use Cake\View\View;

/**
 * Teasers Controller
 *
 * @property \App\Model\Table\TeasersTable $Teasers
 */
class TeasersController extends AppController
{
    const DEFAULT_LIMIT = 10;
    const DEFAULT_OFFSET = 0;

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $this->paginate = [];
        $teasers = $this->paginate($this->Teasers);

        $this->set(compact('teasers'));
        $this->set('_serialize', ['teasers']);
    }

    /**
     * View method
     *
     * @param string|null $id Teaser id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $teaser = $this->Teasers->get($id, [
            'contain' => ['Categories', 'Teasers', 'BlocksTeasersExcludeds', 'TeasersViews']
        ]);

        $this->set('teaser', $teaser);
        $this->set('_serialize', ['teaser']);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */

    public function add()
    {
        $teaser = $this->Teasers->newEntity();
        if ($this->request->is('post')) {
            $teaser = $this->Teasers->patchEntity($teaser, $this->request->getData());

            if (!empty ($this->request->getData('img'))) {
                $teaser->upload($this->request->getData('img'));
            }

            if ($this->Teasers->save($teaser)) {
                $this->Flash->success(__('The teaser has been saved.'));
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The teaser could not be saved. Please, try again.'));
        }

        $this->loadModel('Teaser');
        $this->loadModel('Relink');
        $teasers =  $this->Teaser
            ->find('list', [
                'limit' => 200,
                'keyField' => 'teaser_id',
                'valueField' => 'rowName'
            ]);
        $relinks = $this->Relink
            ->find('list', [
                'keyField' => 'teaser_id',
                'valueField' => 'editor_id'
            ])->toArray();
        $categories = $this->Teasers->Categories->find('list', ['limit' => 200]);
        $this->set(compact('teaser', 'categories','teasers', 'relinks'));
        $this->set('_serialize', ['teaser']);
    }


    /**
     * Edit method
     *
     * @param string|null $id Teaser id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $teaser = $this->Teasers->get($id, [
            'contain' => ['Categories']
        ]);

        if ($this->request->is(['patch', 'post', 'put'])) {
             $teaser = $this->Teasers->patchEntity($teaser, $this->request->getData());

           if (!empty ($this->request->getData('img_new'))) {
                if ($teaser->upload($this->request->getData('img_new')))
                {

                }
           }
           if ($this->Teasers->save($teaser)) {

                $this->Flash->success(__('The teaser has been saved.'));

                return $this->redirect(['action' => 'index']);
           }
            $this->Flash->error(__('The teaser could not be saved. Please, try again.'));
        }

        $this->loadModel('Teaser');
        $teasers =  $this->Teaser
            ->find('list', [
                'limit' => 200,
                'keyField' => 'teaser_id',
                'valueField' => 'rowName'
            ]);

        $categories = $this->Teasers->Categories->find('list', ['limit' => 200]);
        $this->set(compact('teaser', 'posts', 'categories','teasers'));
        $this->set('_serialize', ['teaser']);
    }

    /**
     * Delete method
     *`
     * @param string|null $id Teaser id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $teaser = $this->Teasers->get($id);

        if ($this->Teasers->delete($teaser)){
            $teaser->deleteImageFolderTeaser();
            $this->Flash->success(__('The teaser has been deleted.'));
        } else {
            $this->Flash->error(__('The teaser could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    public function getList()
    {
        $limit = (int) $this->request->getQuery('limit', static::DEFAULT_LIMIT);
        $offset = (int) $this->request->getQuery('offset', static::DEFAULT_OFFSET);

        $domain = RemoteTeaser::DOMAIN_PREFIX;

        $teasers = $this->Teasers->find('all')
            ->offset($offset)
            ->limit($limit)
            ->all();

        $block = null;
        $blockId = $this->request->getQuery('block_id');

        if ($blockId > 0) {
            $this->loadModel('Blocks');
            $block = $this->Blocks->get(intval($blockId), [
                'contain' => ['BlocksStyles']
            ]);
        }

        $view = new View($this->request, $this->response, null);
        $view->viewPath = 'Teasers';
        $view->layout = false;

        $view->set(compact('block'));
        $css = $view->render('css');
        $view->hasRendered = false;
        $blockHtml = $view->render('block');

        $this->set(compact('teasers', 'domain', 'css', 'blockHtml'));
        $this->set('_serialize', ['teasers', 'domain', 'css', 'blockHtml']);
        $this->set("_jsonp", true);
    }

    function beforeFilter(Event $event) {
        $this->Auth->allow( 'getList' );
    }
}
