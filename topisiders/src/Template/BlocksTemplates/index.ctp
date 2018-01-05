<?php
/**
  * @var \App\View\AppView $this
  */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Blocks Template'), ['action' => 'add']) ?></li>
    </ul>
</nav>
<div class="blocksTemplates index large-9 medium-8 columns content">
    <h3><?= __('Blocks Templates') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('amount_x') ?></th>
                <th scope="col"><?= $this->Paginator->sort('amount_y') ?></th>
                <th scope="col"><?= $this->Paginator->sort('size_x') ?></th>
                <th scope="col"><?= $this->Paginator->sort('size_y') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($blocksTemplates as $blocksTemplate): ?>
            <tr>
                <td><?= $this->Number->format($blocksTemplate->id) ?></td>
                <td><?= $this->Number->format($blocksTemplate->amount_x) ?></td>
                <td><?= $this->Number->format($blocksTemplate->amount_y) ?></td>
                <td><?= $this->Number->format($blocksTemplate->size_x) ?></td>
                <td><?= $this->Number->format($blocksTemplate->size_y) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $blocksTemplate->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $blocksTemplate->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $blocksTemplate->id], ['confirm' => __('Are you sure you want to delete # {0}?', $blocksTemplate->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->first('<< ' . __('first')) ?>
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
            <?= $this->Paginator->last(__('last') . ' >>') ?>
        </ul>
        <p><?= $this->Paginator->counter(['format' => __('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')]) ?></p>
    </div>
</div>
