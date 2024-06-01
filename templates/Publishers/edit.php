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
            <?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $publisher->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $publisher->id), 'class' => 'side-nav-item']
            ) ?>
            <?= $this->Html->link(__('List Publishers'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column column-80">
        <div class="publishers form content">
            <?= $this->Form->create($publisher) ?>
            <fieldset>
                <legend><?= __('Edit Publisher') ?></legend>
                <?php
                    echo $this->Form->control('name');
                    echo $this->Form->control('website');
                    echo $this->Form->control('created_at', ['empty' => true]);
                    echo $this->Form->control('updated_at', ['empty' => true]);
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
