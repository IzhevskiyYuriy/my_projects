<?php $this->assign('title', 'Request Password Reset'); ?><div class="users content">
	<h3><?php echo __('Забыли пароль'); ?></h3>
	<?php
    	echo $this->Form->create();
        echo $this->Form->input('email', ['autofocus' => true, 'label' => 'Email address', 'required' => true]);
		echo $this->Form->button('Отправить');
    	echo $this->Form->end();
	?>
</div>

       




