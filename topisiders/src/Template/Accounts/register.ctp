<div class="accounts form large-9 medium-8 columns content">
    <?= $this->Form->create('Account') ?>
    <fieldset>
        <legend><?= __('Регистрация') ?></legend>
        <?php
            echo $this->Form->control('email');
            echo $this->Form->control('password');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
