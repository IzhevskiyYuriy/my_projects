<?php
/**
  * @var \App\View\AppView $this
  */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Teaser'), ['action' => 'edit', $teaser->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Teaser'), ['action' => 'delete', $teaser->id], ['confirm' => __('Are you sure you want to delete # {0}?', $teaser->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Teasers'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Teaser'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Teasers'), ['controller' => 'Teasers', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Teaser'), ['controller' => 'Teasers', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Blocks Teasers Excludeds'), ['controller' => 'BlocksTeasersExcludeds', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Blocks Teasers Excluded'), ['controller' => 'BlocksTeasersExcludeds', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Teasers Views '), ['controller' => 'Teasers Views ', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Teasers Views '), ['controller' => 'Teasers Views ', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Categories'), ['controller' => 'Categories', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Category'), ['controller' => 'Categories', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="teasers view large-9 medium-8 columns content">
    <h3><?= h($teaser->title) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Img') ?></th>
            <?php if (!empty($teaser->getPath())) { ?>

            <?=$this->Form->hidden($teaser->getPath()); ?>
            <td><?= $this->Html->image($teaser->getPath(), [
                    'width' => '200px',
                    'height' => '200px',
                    'style' => 'width: 50%;',
                    'url' => '#'

                ]); ?></td>
            <?php } ?>
        </tr>
        <tr>
            <th scope="row"><?= __('Link') ?></th>
            <td><?= h($teaser->link) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Title') ?></th>
            <td><?= h($teaser->title) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($teaser->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Price') ?></th>
            <td><?= $this->Number->format($teaser->price) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Post Id') ?></th>
            <td><?= $this->Number->format($teaser->post_id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Teaser Id') ?></th>
            <td><?= $this->Number->format($teaser->teaser_id) ?></td>
        </tr>
    </table>
    <div class="row">
        <h4><?= __('Text') ?></h4>
        <?= $this->Text->autoParagraph(h($teaser->text)); ?>
    </div>
    <div class="related">
        <h4><?= __('Related Teasers') ?></h4>
        <?php if (!empty($teaser->teasers)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Img') ?></th>
                <th scope="col"><?= __('Link') ?></th>
                <th scope="col"><?= __('Text') ?></th>
                <th scope="col"><?= __('Title') ?></th>
                <th scope="col"><?= __('Price') ?></th>
                <th scope="col"><?= __('Post Id') ?></th>
                <th scope="col"><?= __('Teaser Id') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($teaser->teasers as $teasers): ?>
            <tr>
                <td><?= h($teasers->id) ?></td>
                <td><?= h($teasers->img) ?></td>
                <td><?= h($teasers->link) ?></td>
                <td><?= h($teasers->text) ?></td>
                <td><?= h($teasers->title) ?></td>
                <td><?= h($teasers->price) ?></td>
                <td><?= h($teasers->post_id) ?></td>
                <td><?= h($teasers->teaser_id) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Teasers', 'action' => 'view', $teasers->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Teasers', 'action' => 'edit', $teasers->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Teasers', 'action' => 'delete', $teasers->id], ['confirm' => __('Are you sure you want to delete # {0}?', $teasers->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
    <div class="related">
        <h4><?= __('Related Blocks Teasers Excludeds') ?></h4>
        <?php if (!empty($teaser->blocks_teasers_excludeds)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Block Id') ?></th>
                <th scope="col"><?= __('Teaser Id') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($teaser->blocks_teasers_excludeds as $blocksTeasersExcludeds): ?>
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
    <div class="related">
        <h4><?= __('Related Teasers Views') ?></h4>
        <?php if (!empty($teaser->teasers_views)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Block Id') ?></th>
                <th scope="col"><?= __('Teaser Id') ?></th>
                <th scope="col"><?= __('Event Hour') ?></th>
                <th scope="col"><?= __('Viewed') ?></th>
                <th scope="col"><?= __('Opened') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($teaser->teasers_views as $teasersViews): ?>
            <tr>
                <td><?= h($teasersViews->block_id) ?></td>
                <td><?= h($teasersViews->teaser_id) ?></td>
                <td><?= h($teasersViews->event_hour) ?></td>
                <td><?= h($teasersViews->viewed) ?></td>
                <td><?= h($teasersViews->opened) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'TeasersViews', 'action' => 'view', $teasersViews->block_id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'TeasersViews', 'action' => 'edit', $teasersViews->block_id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'TeasersViews', 'action' => 'delete', $teasersViews->block_id], ['confirm' => __('Are you sure you want to delete # {0}?', $teasersVieweds->block_id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
    <div class="related">
        <h4><?= __('Related Categories') ?></h4>
        <?php if (!empty($teaser->categories)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Name') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($teaser->categories as $categories): ?>
            <tr>
                <td><?= h($categories->id) ?></td>
                <td><?= h($categories->name) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Categories', 'action' => 'view', $categories->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Categories', 'action' => 'edit', $categories->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Categories', 'action' => 'delete', $categories->id], ['confirm' => __('Are you sure you want to delete # {0}?', $categories->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>
