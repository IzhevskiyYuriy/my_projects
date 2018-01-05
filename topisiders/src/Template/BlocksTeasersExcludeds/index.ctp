<?php
/**
  * @var \App\View\AppView $this
  */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Blocks Teasers Excluded'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Blocks'), ['controller' => 'Blocks', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Block'), ['controller' => 'Blocks', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="blocksTeasersExcludeds index large-9 medium-8 columns content">
    <h3><?= __('Blocks Teasers Excludeds') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('block_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('teaser_id') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($blocksTeasersExcludeds as $blocksTeasersExcluded): ?>
            <tr>
                <td><?= $blocksTeasersExcluded->has('block') ? $this->Html->link($blocksTeasersExcluded->block->name, ['controller' => 'Blocks', 'action' => 'view', $blocksTeasersExcluded->block->id]) : '' ?></td>
                <td><?= $this->Number->format($blocksTeasersExcluded->teaser_id) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $blocksTeasersExcluded->block_id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $blocksTeasersExcluded->block_id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $blocksTeasersExcluded->block_id], ['confirm' => __('Are you sure you want to delete # {0}?', $blocksTeasersExcluded->block_id)]) ?>
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
