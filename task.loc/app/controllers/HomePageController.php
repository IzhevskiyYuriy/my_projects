<?php
namespace app\controllers;

use app\models\HomePage;

class HomePageController extends AppController
{
    public $layout = 'main';

    public function indexAction()
    {
        $model = new HomePage;
        $findAll = $model->getAllEntries();

        $this->set(compact('findAll', 'model'));
    }
}