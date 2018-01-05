<?php
/**
  * @var \App\View\AppView $this
  */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Blocks Css'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="blocksCss form large-9 medium-8 columns content">
    <?= $this->Form->create($blocksCs) ?>
    <fieldset>
        <legend><?= __('Add Blocks Cs') ?></legend>
        <?php
            echo $this->Form->control('block');
            echo $this->Form->control('link');
            echo $this->Form->control('teaser');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
