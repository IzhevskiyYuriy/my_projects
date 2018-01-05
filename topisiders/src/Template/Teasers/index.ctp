<?php
/**
  * @var \App\View\AppView $this
  */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Teaser'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Blocks Teasers Excludeds'), ['controller' => 'BlocksTeasersExcludeds', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Blocks Teasers Excluded'), ['controller' => 'BlocksTeasersExcludeds', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Teasers Views '), ['controller' => 'TeasersViews ', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Teasers Views '), ['controller' => 'TeasersViews ', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Categories'), ['controller' => 'Categories', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Category'), ['controller' => 'Categories', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="teasers index large-9 medium-8 columns content">
    <h3><?= __('Teasers') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('img', 'Картинка') ?></th>
                <th scope="col"><?= $this->Paginator->sort('link', 'Ссылка') ?></th>
                <th scope="col"><?= $this->Paginator->sort('title', 'Заголовок') ?></th>
                <th scope="col"><?= $this->Paginator->sort('price', 'Цена за клик') ?></th>
                <th scope="col"><?= $this->Paginator->sort('teaser_id', 'Id тизера на burnsmi') ?></th>
                <th scope="col" class="actions"><?= __('#') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($teasers as $teaser): ?>
            <tr>
                <td><?= $this->Number->format($teaser->id) ?></td>
                <td><?= $this->Html->image($teaser->img, [
                        'width' => '100',
                        'height' => '100',
                    ]) ?></td>
                <td><?= h($teaser->link) ?></td>
                <td><?= h($teaser->title) ?></td>
                <td><?= $this->Number->format($teaser->price) ?></td>
                <td><?= $this->Number->format($teaser->teaser_id) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $teaser->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $teaser->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $teaser->id], ['confirm' => __('Are you sure you want to delete # {0}?', $teaser->id)]) ?>
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
