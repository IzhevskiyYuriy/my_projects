<?php
/**
  * @var \App\View\AppView $this
  */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Blocks Cs'), ['action' => 'edit', $blocksCs->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Blocks Cs'), ['action' => 'delete', $blocksCs->id], ['confirm' => __('Are you sure you want to delete # {0}?', $blocksCs->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Blocks Css'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Blocks Cs'), ['action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="blocksCss view large-9 medium-8 columns content">
    <h3><?= h($blocksCs->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($blocksCs->id) ?></td>
        </tr>
    </table>
    <div class="row">
        <h4><?= __('Block') ?></h4>
        <?= $this->Text->autoParagraph(h($blocksCs->block)); ?>
    </div>
    <div class="row">
        <h4><?= __('Link') ?></h4>
        <?= $this->Text->autoParagraph(h($blocksCs->link)); ?>
    </div>
    <div class="row">
        <h4><?= __('Teaser') ?></h4>
        <?= $this->Text->autoParagraph(h($blocksCs->teaser)); ?>
    </div>
</div>
