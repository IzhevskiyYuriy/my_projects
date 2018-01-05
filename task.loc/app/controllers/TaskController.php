<?php
namespace app\controllers;

use app\models\Task;
use fw\core\libs;



class TaskController extends AppController
{
    public $layout = 'main';

    public function newAction(){}

    public function addAction()
    {
        $this->layout = false;

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $model = new Task();
            $validator = new \Validator();

            $name = $validator->clean($_POST['user_name']);
            $task = $validator->clean($_POST['user_task']);
            $email = $validator->clean($_POST['user_email']);

            $validationFormData = $model->validationFormAddData($name, $email, $task);
            $validationImage = $model->validationImage($_FILES['user_img']);

            if ($validationFormData && $validationImage == true) {
                $saveImage = $model->saveImage($_FILES['user_img']);
                $getImagePath = $model->pathImgForDB();

                $savingDataDatabase = $model->insert($name, $email, $task, $getImagePath);

                if ($saveImage && $savingDataDatabase == 1) {
                     MessageSendSuccess(1, 'Данные успешно соxранены!');
                } else {
                    MessageSendError(2, 'Данные не удалось сохранить. Попробуйте снова!');
                }
            }
        }
    }

    public function editAction()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $model = new Task();
            $validator = new \Validator();

            $id = integer($_POST['id']);
            $statusId = integer($_POST['status']);

            $task = $validator->clean($_POST['user_task']);
            $validationFormData = $model->validationFormEditData($task);

            if ($validationFormData) {
                $updateDataDatabase = $model->update($task, $statusId, $id);
                if ($updateDataDatabase == 1) {
                    MessageSendSuccess(1, 'Данные успешно соxранены!');
                } else {
                    MessageSendError(2, 'Данные не удалось сохранить. Попробуйте снова!');
                }
            }
        }

        $model = new Task;
        $get = intval($this->route['alias']);
        $findDataById = $model->getDataId($get);

        $this->set(compact('findDataById', 'model','get'));
    }

    public function viewAction()
    {
        $model = new Task;
        $get = intval($this->route['alias']);
        $findDataById = $model->getDataId($get);

        $this->set(compact('findDataById', 'model'));
    }

    /**
     * preview
     */
    public function ajaxAction()
    {
        $model = new Task();
        if($this->isAjax()) {
            $this->layout = false;
            $model->ajaxPreview();
        }
    }




}