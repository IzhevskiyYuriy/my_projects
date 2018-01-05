<?php
/**
  * @var \App\View\AppView $this
  */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $teasersView->block_id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $teasersView->block_id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Teasers Views'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Blocks'), ['controller' => 'Blocks', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Block'), ['controller' => 'Blocks', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Teasers'), ['controller' => 'Teasers', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Teaser'), ['controller' => 'Teasers', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="teasersViews form large-9 medium-8 columns content">
    <?= $this->Form->create($teasersView) ?>
    <fieldset>
        <legend><?= __('Edit Teasers View') ?></legend>
        <?php
            echo $this->Form->control('viewed');
            echo $this->Form->control('opened');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
