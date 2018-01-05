<?php

namespace app\models;

use fw\core\base\Model;
use fw\core\libs;

class Account extends Model
{
    public $table = 'account';

    public function login()
    {
        $login = !empty(trim($_POST['login'])) ? trim($_POST['login']) : null;
        $password = !empty(trim($_POST['password'])) ? trim($_POST['password']) : null;

        if ($login && $password) {
            $admin = $this->findBySql("SELECT * FROM {$this->table} WHERE login = ? AND role = 'admin'", [$login]);

            if (!empty($admin)) {
                if (password_verify($password, $admin[0]['password'])) {

                    foreach ($admin as $k => $v) {
                        if ($v != 'password') $_SESSION['admin']= $v;
                    }
                    return true;
                }
            }
        }
        return false;
    }
}