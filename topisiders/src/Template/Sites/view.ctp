<?php
/**
  * @var \App\View\AppView $this
  */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Ссылки') ?></li>
        <li><?= $this->Html->link(__('Редактировать сайт'), ['action' => 'edit', $site->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Удалить сайт'), ['action' => 'delete', $site->id], ['confirm' => __('Уверены, что хотите удалить сайт # {0}?', $site->id)]) ?> </li>
        <li><?= $this->Html->link(__('Список сайтов'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('Добавить сайт'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('Список блоков'), ['controller' => 'Blocks', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('Добавить блок'), ['controller' => 'Blocks', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="sites view large-9 medium-8 columns content">
    <h3><?= h($site->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Категория') ?></th>
            <td><?= $site->has('category') ? $this->Html->link($site->category->name, ['controller' => 'Categories', 'action' => 'view', $site->category->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Домен') ?></th>
            <td><?= h($site->domain) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($site->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Статус') ?></th>
            <td><?= $site->statusName ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Создан') ?></th>
            <td><?= h($site->created) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Редактирован') ?></th>
            <td><?= h($site->modified) ?></td>
        </tr>
    </table>
    <div class="related">
        <h4><?= __('Блоки сайта') ?></h4>
        <?php if (!empty($site->blocks)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Id сайта') ?></th>
                <th scope="col"><?= __('Название') ?></th>
                <th scope="col"><?= __('Блоков по горизонали') ?></th>
                <th scope="col"><?= __('Блоков по вертикали') ?></th>
                <th scope="col"><?= __('Ширина') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($site->blocks as $blocks): ?>
            <tr>
                <td><?= h($blocks->id) ?></td>
                <td><?= h($blocks->site_id) ?></td>
                <td><?= h($blocks->name) ?></td>
                <td><?= h($blocks->amount_x) ?></td>
                <td><?= h($blocks->amount_y) ?></td>
                <td><?= h($blocks->width) .  h($blocks->width_units)?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Blocks', 'action' => 'view', $blocks->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Blocks', 'action' => 'edit', $blocks->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Blocks', 'action' => 'delete', $blocks->id], ['confirm' => __('Are you sure you want to delete # {0}?', $blocks->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>
