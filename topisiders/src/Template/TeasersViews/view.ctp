<?php
/**
  * @var \App\View\AppView $this
  */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Teasers View'), ['action' => 'edit', $teasersView->block_id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Teasers View'), ['action' => 'delete', $teasersView->block_id], ['confirm' => __('Are you sure you want to delete # {0}?', $teasersView->block_id)]) ?> </li>
        <li><?= $this->Html->link(__('List Teasers Views'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Teasers View'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Blocks'), ['controller' => 'Blocks', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Block'), ['controller' => 'Blocks', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Teasers'), ['controller' => 'Teasers', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Teaser'), ['controller' => 'Teasers', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="teasersViews view large-9 medium-8 columns content">
    <h3><?= h($teasersView->block_id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Block') ?></th>
            <td><?= $teasersView->has('block') ? $this->Html->link($teasersView->block->name, ['controller' => 'Blocks', 'action' => 'view', $teasersView->block->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Teaser') ?></th>
            <td><?= $teasersView->has('teaser') ? $this->Html->link($teasersView->teaser->title, ['controller' => 'Teasers', 'action' => 'view', $teasersView->teaser->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Event Hour') ?></th>
            <td><?= $this->Number->format($teasersView->event_hour) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Viewed') ?></th>
            <td><?= $this->Number->format($teasersView->viewed) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Opened') ?></th>
            <td><?= $this->Number->format($teasersView->opened) ?></td>
        </tr>
    </table>
</div>
