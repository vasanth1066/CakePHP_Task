<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Author $author
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('List Authors'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column column-80">
        <div class="authors form content">
            <?= $this->Form->create($author) ?>
            <fieldset>
                <legend><?= __('Add Author') ?></legend>
                <?php
                    echo $this->Form->control('first_name');
                    echo $this->Form->control('email');
                    echo $this->Form->control('created_at', ['empty' => true]);
                    echo $this->Form->control('updated_at', ['empty' => true]);
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
