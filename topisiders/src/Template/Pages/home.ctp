<?php
/**
  * @var \App\View\AppView $this
  */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Добро пожаловать') ?></li>
        <li><?= $this->Html->link(__('Вход'), ['controller' => 'Accounts', 'action' => 'login']) ?></li>
        <li><?= $this->Html->link(__('Регистрация'),['controller' => 'Accounts', 'action' => 'register']) ?></li>
    </ul>
</nav>

