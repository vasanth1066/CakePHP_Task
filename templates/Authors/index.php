<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\Author> $authors
 */
?>
<div class="authors index content">
    <?= $this->Html->link(__('New Author'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __('Authors') ?></h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('id') ?></th>
                    <th><?= $this->Paginator->sort('first_name') ?></th>
                    <th><?= $this->Paginator->sort('email') ?></th>
                    <th><?= $this->Paginator->sort('created_at') ?></th>
                    <th><?= $this->Paginator->sort('updated_at') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($authors as $author): ?>
                <tr>
                    <td><?= $this->Number->format($author->id) ?></td>
                    <td><?= h($author->first_name) ?></td>
                    <td><?= h($author->email) ?></td>
                    <td><?= h($author->created_at) ?></td>
                    <td><?= h($author->updated_at) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $author->id]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $author->id]) ?>
                        <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $author->id], ['confirm' => __('Are you sure you want to delete # {0}?', $author->id)]) ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->first('<< ' . __('first')) ?>
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
            <?= $this->Paginator->last(__('last') . ' >>') ?>
        </ul>
        <p><?= $this->Paginator->counter(__('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')) ?></p>
    </div>
</div>
