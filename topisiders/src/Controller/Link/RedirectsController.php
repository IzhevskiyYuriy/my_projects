<?php

namespace App\Controller\Link;

use App\Controller\AppController;
use App\Model\Table\TeasersTable;
use App\Model\Table\TeasersViewsTable;
use Cake\Event\Event;

class RedirectsController extends AppController
{
    const REDIRECT_TO = "http://burnsmi.com/onews/index";

    public function go()
    {
        $this->viewBuilder()->setLayout(false);
        $this->autoRender = false;

        $getParams = (array) $this->request->getQuery();
        // 'web_site_id', 'post_id', 'teaser_id', 'block_id'

        $this->loadModel('TeasersViews');
        $this->TeasersViews->registerOpen($getParams);
        unset($getParams['b_id']);
        unset($getParams['lt_id']);

        return $this->redirect(static::REDIRECT_TO . '?' . http_build_query($getParams));
    }


    function beforeFilter(Event $event) {
        $this->Auth->allow( 'go' );
    }
}
