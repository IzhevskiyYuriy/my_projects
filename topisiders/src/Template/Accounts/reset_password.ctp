
<?php $this->assign('title', 'Reset Password'); ?>
<div class="users form large-9 medium-8 columns content">
    <?php echo $this->Form->create() ?>
    <fieldset>
        <legend><?php echo __('Восстановить пароль') ?>
    <?php
        echo $this->Form->control('password', ['required' => true, 'autofocus' => true]); ?>
        <!--<p class="helper">Пароли должны содержать не менее 8 символов и содержать не менее 1 цифры, 1 прописные буквы, 1 строчные буквы и 1 специальный символ</p> -->
    <?php 
        echo $this->Form->input('password_confirm', ['type' => 'password', 'required' => true]);
    ?>
    </fieldset>
 	<?php echo $this->Form->button(__('Submit')); ?>
    <?php echo $this->Form->end(); ?>
</div>

