<?php
/**
  * @var \App\View\AppView $this
  */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Blocks Teasers Excluded'), ['action' => 'edit', $blocksTeasersExcluded->block_id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Blocks Teasers Excluded'), ['action' => 'delete', $blocksTeasersExcluded->block_id], ['confirm' => __('Are you sure you want to delete # {0}?', $blocksTeasersExcluded->block_id)]) ?> </li>
        <li><?= $this->Html->link(__('List Blocks Teasers Excludeds'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Blocks Teasers Excluded'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Blocks'), ['controller' => 'Blocks', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Block'), ['controller' => 'Blocks', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="blocksTeasersExcludeds view large-9 medium-8 columns content">
    <h3><?= h($blocksTeasersExcluded->block_id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Block') ?></th>
            <td><?= $blocksTeasersExcluded->has('block') ? $this->Html->link($blocksTeasersExcluded->block->name, ['controller' => 'Blocks', 'action' => 'view', $blocksTeasersExcluded->block->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Teaser Id') ?></th>
            <td><?= $this->Number->format($blocksTeasersExcluded->teaser_id) ?></td>
        </tr>
    </table>
</div>
