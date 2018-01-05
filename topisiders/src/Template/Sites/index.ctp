<?php
/**
  * @var \App\View\AppView $this
  */
/** @var $site \App\Model\Entity\Site  */
/** @var $block \App\Model\Entity\Block */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Ссылки') ?></li>
        <li><?= $this->Html->link(__('Добавить сайт'), ['action' => 'add']) ?></li>
    </ul>
</nav>
<div class="sites index large-9 medium-8 columns content">
    <h3><?= __('Сайты') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('category_id', 'Категория') ?></th>
                <th scope="col"><?= $this->Paginator->sort('domain', 'Домен') ?></th>
                <th scope="col"><?= $this->Paginator->sort('status', 'Статус') ?></th>
                <th scope="col"><?= __('Блоки') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($sites as $site): ?>
            <tr>
                <td><?= $this->Number->format($site->id) ?></td>
                <td><?= $site->has('category') ? $this->Html->link($site->category->name, ['controller' => 'Categories', 'action' => 'view', $site->category->id]) : '' ?></td>
                <td><?= h($site->domain) ?></td>
                <td><?= $site->statusName ?></td>
                <td>
                    <!--TODO: change place and looking of link 'add block' -->
                    <?= $this->Html->link(__('Добавить'), ['action' => 'add', 'controller' => 'Blocks']) ?>
                    <br />

                    <?php foreach ($site->blocks as $block): ?>
                        <?= $this->Html->link(h($block->name), ['controller' => 'Blocks', 'action' => 'view', $block->id], [
                                'data-block-id' => $block->id
                        ]) ?>
                        <br />
                    <?php endforeach; ?>
                </td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $site->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $site->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $site->id], ['confirm' => __('Уверены, что хотите удалить сайт # {0}?', $site->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->first('<< ' . __('Начало')) ?>
            <?= $this->Paginator->prev('< ' . __('Предыдущие')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('Следующие') . ' >') ?>
            <?= $this->Paginator->last(__('Конец') . ' >>') ?>
        </ul>
        <p><?= $this->Paginator->counter(['format' => __('Страница {{page}} из {{pages}}, показано {{current}} записей из {{count}}')]) ?></p>
    </div>
</div>
