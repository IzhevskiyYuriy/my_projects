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
                ['action' => 'delete', $blocksTeasersExcluded->block_id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $blocksTeasersExcluded->block_id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Blocks Teasers Excludeds'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Blocks'), ['controller' => 'Blocks', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Block'), ['controller' => 'Blocks', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="blocksTeasersExcludeds form large-9 medium-8 columns content">
    <?= $this->Form->create($blocksTeasersExcluded) ?>
    <fieldset>
        <legend><?= __('Edit Blocks Teasers Excluded') ?></legend>
        <?php
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
