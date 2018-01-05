<?php
/**
  * @var \App\View\AppView $this
  */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Teasers View'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Blocks'), ['controller' => 'Blocks', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Block'), ['controller' => 'Blocks', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Teasers'), ['controller' => 'Teasers', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Teaser'), ['controller' => 'Teasers', 'action' => 'add']) ?></li>
    </ul>
</nav>

<?php


?>
<div class="teasersViews index large-9 medium-8 columns content">
    <h1><?= __('Просмотры тизеров') ?></h1>

    <?php foreach ($teasersViews as $siteViews): ?>
        <?php if ($siteViews->isWithoutStat()) continue; ?>
        <div class="row">
            <h2>Сайт <?= $this->Html->link($siteViews->domain, ['controller' => 'Sites', 'action' => 'view', $siteViews->id]) ?> (Прибыль: <?= $siteViews->calcStatProfit() ?>)</h2>

            <?php foreach ($siteViews->blocks as $blockViews): ?>
                <?php if (empty($blockViews->teasers_views)) continue; ?>

                <div class="col-md-11">
                    <h3>Блок <?= $this->Html->link($blockViews->name, ['controller' => 'Blocks', 'action' => 'view', $blockViews->id]) ?> (Прибыль: <?= $blockViews->calcStatProfit() ?>)</h3>

                    <table cellpadding="0" cellspacing="0">
                        <thead>
                        <tr>
                            <th scope="col">Teaser</th>
                            <th scope="col">Время</th>
                            <th scope="col">Переходы</th>
                            <th scope="col">Доход</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($blockViews->teasers_views as $teasersView): ?>
                            <tr>
                                <td><?= $teasersView->has('teaser') ? $this->Html->link($teasersView->teaser->title, ['controller' => 'Teasers', 'action' => 'view', $teasersView->teaser->id]) : '' ?></td>
                                <td><?= date ( 'Y-m-d H:00:00', $teasersView->event_hour) ?></td>
                                <td><?= $this->Number->format($teasersView->opened) ?></td>
                                <td><?= $this->Number->precision($teasersView->opened * $teasersView->teaser->price, 2) ?></td>

                            </tr>
                        <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endforeach; ?>
