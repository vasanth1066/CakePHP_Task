
<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Publisher $publisher
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('List of Data'), ['action' => 'display'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column column-80">
        <div class="publishers form content">
        <?= $this->Form->create($test, ['type' => 'file']) ?>
            <fieldset>
                <legend><?= isset($test->id) ? __('Edit Data') : __('Add New Data') ?></legend>
                <?= $this->Form->control('email',['label' => 'Email','placeholder' => 'Example@gmail.com']) ?>
                <?= $this->Form->control('password', ['type' => 'password']) ?>
                <?= $this->Form->control('first_name', ['label' => 'First Name']) ?>
                <?= $this->Form->control('last_name', ['label' => 'Last Name']) ?>
                <?= $this->Form->control('address', ['type' => 'textarea', 'label' => 'Address']) ?>

                <?= $this->Form->control('gender', [
                    'type' => 'radio', 
                    'options' => ['male' => 'Male', 'female' => 'Female'], 
                    'label' => 'Gender'
                ]) ?>

                <?= $this->Form->control('birthday', ['type' => 'date', 'label' => 'Birthday Date']) ?>
                
                <?= $this->Form->control('user_type', [
                    'type' => 'select', 
                    'options' => ['employee' => 'Employee', 'student' => 'Student', 'other' => 'Other'], 
                    'empty' => 'Select User Type'
                ]) ?>
                
                
            </fieldset>
        <?= $this->Form->control('terms', ['type' => 'checkbox', 'label' => 'Accept all terms and conditions']) ?>
        <?= $this->Form->button(isset($test->id) ? __('Update') : __('Save')) ?>
        <?= $this->Form->end() ?>

    </div>
</div>



