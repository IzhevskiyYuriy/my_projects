<?php
/**
  * @var \App\View\AppView $this
  */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Вход'), ['controller' => 'Accounts', 'action' => 'login']) ?></li>
        <li><?= $this->Html->link(__('Востановление пароля'), ['controller' => 'Accounts', 'action' => 'pass_recovery']) ?></li>
       
    </ul>
</nav>
<div class="sites form large-9 medium-8 columns content">
    
   <div class = "users form">
    <?= $this->Flash->render() ?>
    <?= $this->Form->create() ?>
    <fieldset>
        <legend><?= __('Пожалуйста, введи свое имя и пароль')?></legend>
       <?= $this->Form->create() ?>
<?= $this->Form->input('email') ?>
<?= $this->Form->input('password') ?>
        
<?= $this->Form->button('Войти') ?>
<?= $this->Form->end() ?>
    </fieldset>
</div>

    

       


