<?php
/**
  * @var \App\View\AppView $this
  */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Block'), ['action' => 'edit', $block->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Block'), ['action' => 'delete', $block->id], ['confirm' => __('Are you sure you want to delete # {0}?', $block->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Blocks'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Block'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Sites'), ['controller' => 'Sites', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Site'), ['controller' => 'Sites', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Blocks Templates'), ['controller' => 'BlocksTemplates', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Blocks Template'), ['controller' => 'BlocksTemplates', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Blocks Teasers Excludeds'), ['controller' => 'BlocksTeasersExcludeds', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Blocks Teasers Excluded'), ['controller' => 'BlocksTeasersExcludeds', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="blocks view large-9 medium-8 columns content">
    <h3><?= h($block->name) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Site') ?></th>
            <td><?= $block->has('site') ? $this->Html->link($block->site->id, ['controller' => 'Sites', 'action' => 'view', $block->site->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Name') ?></th>
            <td><?= h($block->name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Blocks Template') ?></th>
            <td><?= $block->has('blocks_template') ? $this->Html->link($block->blocks_template->id, ['controller' => 'BlocksTemplates', 'action' => 'view', $block->blocks_template->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Width Units') ?></th>
            <td><?= h($block->width_units) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($block->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Amount X') ?></th>
            <td><?= $this->Number->format($block->amount_x) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Amount Y') ?></th>
            <td><?= $this->Number->format($block->amount_y) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Width') ?></th>
            <td><?= $this->Number->format($block->width) ?></td>
        </tr>
    </table>
    <div class="row">
        <h4><?= __('Код заглушки') ?></h4>
        <?= $this->Text->autoParagraph(h($block->no_elemens_code)); ?>
    </div>
    <div class="related">
        <h4><?= __('Related Blocks Teasers Excludeds') ?></h4>
        <?php if (!empty($block->blocks_teasers_excludeds)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Block Id') ?></th>
                <th scope="col"><?= __('Teaser Id') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($block->blocks_teasers_excludeds as $blocksTeasersExcludeds): ?>
            <tr>
                <td><?= h($blocksTeasersExcludeds->block_id) ?></td>
                <td><?= h($blocksTeasersExcludeds->teaser_id) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'BlocksTeasersExcludeds', 'action' => 'view', $blocksTeasersExcludeds->block_id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'BlocksTeasersExcludeds', 'action' => 'edit', $blocksTeasersExcludeds->block_id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'BlocksTeasersExcludeds', 'action' => 'delete', $blocksTeasersExcludeds->block_id], ['confirm' => __('Are you sure you want to delete # {0}?', $blocksTeasersExcludeds->block_id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>
