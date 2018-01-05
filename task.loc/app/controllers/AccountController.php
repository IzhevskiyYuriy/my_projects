<?php
namespace app\controllers;

use app\models\Account;
use vendor\core\libs;

class AccountController extends AppController
{
    public $layout = 'main';

    public function loginAction()
    {
        if (!empty($_POST)) {

            $admin = new Account();

            if ($admin->login()) {
                redirect('/');
            } else {
                MessageSendError(2, 'Логин/пароль введены неверно!');
            }
            redirect('/');
        }
    }

    public function logoutAction()
    {
        if (isset($_SESSION['admin'])) unset($_SESSION['admin']);
        redirect('/account/login/');
    }

}