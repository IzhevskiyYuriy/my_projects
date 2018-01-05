<?php
/**
  * @var \App\View\AppView $this
  */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Blocks Template'), ['action' => 'edit', $blocksTemplate->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Blocks Template'), ['action' => 'delete', $blocksTemplate->id], ['confirm' => __('Are you sure you want to delete # {0}?', $blocksTemplate->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Blocks Templates'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Blocks Template'), ['action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="blocksTemplates view large-9 medium-8 columns content">
    <h3><?= h($blocksTemplate->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($blocksTemplate->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Amount X') ?></th>
            <td><?= $this->Number->format($blocksTemplate->amount_x) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Amount Y') ?></th>
            <td><?= $this->Number->format($blocksTemplate->amount_y) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Size X') ?></th>
            <td><?= $this->Number->format($blocksTemplate->size_x) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Size Y') ?></th>
            <td><?= $this->Number->format($blocksTemplate->size_y) ?></td>
        </tr>
    </table>
</div>
