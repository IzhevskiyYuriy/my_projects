<?php
namespace app\controllers;

use fw\core\base\Controller;

class AppController extends Controller
{
    public function __construct($route)
    {
        parent::__construct($route);
        $role = $this->route;
        if ($role['controller'] == 'Task' && $role['action'] == 'edit') {
            if (empty($_SESSION['admin'])) {
                 MessageSendRole(1, 'Недостаточно прав для совершения операции!');
            }
        }
    }

}