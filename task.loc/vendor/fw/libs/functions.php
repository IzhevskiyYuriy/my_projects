<?php

function debug ($arr)
{
    echo '<pre>'.print_r($arr, true) . '</pre>';
}

function MessageSendError($p1, $p2)
{
    if($p1 == 2) $p1 = 'Ошибка ';
    elseif($p1 == 3) $p1 = 'Внимание';
    $_SESSION['message'] = '<div class = "mesage_block"><b>'.$p1.'</b>: ' .$p2. '</div>';
    exit(header('Location:' .$_SERVER['HTTP_REFERER']));
}

function redirect($http = false)
{
    if ($http) {
        $redirect = $this;
    } else {
        $redirect = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : '/';
    }
    header('Location:'. $redirect);
}

function MessageSendRole($p1, $p2)
{
    if ($p1 == 1) $p1 = 'Права доступа';
    $_SESSION['message'] = '<div class = "mesage_block"><b>'.$p1.'</b>: ' .$p2. '</div>';
    exit(header('Location:' .'/'));
}

function MessageSendSuccess($p1, $p2)
{
    if ($p1 == 1) $p1 = 'Успех';
    $_SESSION['message'] = '<div class = "alert alert-success"><b>'.$p1.'</b>: ' .$p2. '</div>';
    exit(header('Location:' .$_SERVER['HTTP_REFERER']));
}

function MessageShow()
{
    $message = '';
    if ($_SESSION['message']) $message = $_SESSION['message'];
    echo $message;
    $_SESSION['message'] = [];
}

function h($text)
{
    return htmlspecialchars($text, ENT_QUOTES | ENT_SUBSTITUTE);
}

function integer($str){
    return filter_var($str, FILTER_VALIDATE_INT);
}

function is_email($email) {
    return preg_match("/^([a-zA-Z0-9])+([\.a-zA-Z0-9_-])*@([a-zA-Z0-9_-])+(\.[a-zA-Z0-9_-]+)*\.([a-zA-Z]{2,6})$/", $email);
}
