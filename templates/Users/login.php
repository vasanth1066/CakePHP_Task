<?= $this->Flash->render() ?>

<div class="users form content">    
    <div class="users form">
    
    <h3>Login</h3>
    <?= $this->Form->create() ?>
        <?= $this->Form->control('email', ['required' => true]) ?>
        <?= $this->Form->control('password', ['required' => true]) ?>
    <?= $this->Form->submit(__('Login')); ?>
    <?= $this->Form->end() ?>

    <?= $this->Html->link("Register", ['action' => 'register'], ['class' => 'login-link']) ?>
</div>
</div>
