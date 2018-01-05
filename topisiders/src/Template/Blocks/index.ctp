<?php
/**
  * @var \App\View\AppView $this
  */

echo $this->Html->css('https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css', [
    'integrity' => 'sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u',
    'crossorigin' => 'anonymous'
]);
echo $this->Html->css('https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css', [
    'integrity' => 'sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp',
    'crossorigin' => 'anonymous'
]);
echo $this->Html->css('site');
echo $this->Html->script('jquery-3.2.0.min.js');
echo $this->Html->script('https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js', [
    'integrity' => 'sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa',
    'crossorigin' => 'anonymous'
]);
?>

<script type="text/javascript">
    var scriptDomain = "<?= \Cake\Routing\Router::fullBaseUrl() ?>";
</script>

<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Block'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Sites'), ['controller' => 'Sites', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Site'), ['controller' => 'Sites', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Blocks Templates'), ['controller' => 'BlocksTemplates', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Blocks Template'), ['controller' => 'BlocksTemplates', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Blocks Teasers Excludeds'), ['controller' => 'BlocksTeasersExcludeds', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Blocks Teasers Excluded'), ['controller' => 'BlocksTeasersExcludeds', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="blocks index large-9 medium-8 columns content">
    <h3><?= __('Blocks') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('site_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('name') ?></th>
                <th scope="col"><?= $this->Paginator->sort('amount_x') ?></th>
                <th scope="col"><?= $this->Paginator->sort('amount_y') ?></th>
                <th scope="col"><?= $this->Paginator->sort('width') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($blocks as $block): ?>
            <tr class="item-row" data-block-id="<?= $block->id ?>">
                <td><?= $this->Number->format($block->id) ?></td>
                <td><?= $block->has('site') ? $this->Html->link($block->site->domain, ['controller' => 'Sites', 'action' => 'view', $block->site->id]) : '' ?></td>
                <td><?= h($block->name) ?></td>
                <td><?= $this->Number->format($block->amount_x) ?></td>
                <td><?= $this->Number->format($block->amount_y) ?></td>
                <td><?= $this->Number->format($block->width) . ' ' . h($block->width_units) ?></td>
                <td class="actions">
                    <button type="button" class="btn btn-info btn-sm open-block-code" data-toggle="modal">Open Modal</button>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $block->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $block->id], ['confirm' => __('Are you sure you want to delete # {0}?', $block->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <style type="text/css">
        code: {border-style: none};
    </style>

    <!-- Modal -->
    <div class="modal fade" id="js-code-modal" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Скопируйте и вставьте код</h4>
                </div>
                <div class="modal-body">
                    <pre><code>Some text in the modal.</code></pre>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>

        </div>
    </div>

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
