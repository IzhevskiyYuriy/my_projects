<?php
/**
  * @var \App\View\AppView $this
  */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Categories Teaser'), ['action' => 'edit', $categoriesTeaser->category_id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Categories Teaser'), ['action' => 'delete', $categoriesTeaser->category_id], ['confirm' => __('Are you sure you want to delete # {0}?', $categoriesTeaser->category_id)]) ?> </li>
        <li><?= $this->Html->link(__('List Categories Teasers'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Categories Teaser'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Categories'), ['controller' => 'Categories', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Category'), ['controller' => 'Categories', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Teasers'), ['controller' => 'Teasers', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Teaser'), ['controller' => 'Teasers', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="categoriesTeasers view large-9 medium-8 columns content">
    <h3><?= h($categoriesTeaser->category_id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Category') ?></th>
            <td><?= $categoriesTeaser->has('category') ? $this->Html->link($categoriesTeaser->category->name, ['controller' => 'Categories', 'action' => 'view', $categoriesTeaser->category->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Teaser') ?></th>
            <td><?= $categoriesTeaser->has('teaser') ? $this->Html->link($categoriesTeaser->teaser->title, ['controller' => 'Teasers', 'action' => 'view', $categoriesTeaser->teaser->id]) : '' ?></td>
        </tr>
    </table>
</div>
