
<div class="users form content">
<div class="users form">
<h3>Register</h3>
    <?= $this->Form->create($user) ?>
        <?= $this->Form->control('username') ?>
        <?= $this->Form->control('email') ?>
        <?= $this->Form->control('password', ['type' => 'password']) ?>
    <?= $this->Form->submit(__('Submit')); ?>
    <?= $this->Form->end() ?>
    <?= $this->Html->link("Login", ['action' => 'login'], ['class' => 'login-link']) ?>
</div>
</div>


