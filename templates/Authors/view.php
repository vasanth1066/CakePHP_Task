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
            <?= $this->Html->link(__('Edit Author'), ['action' => 'edit', $author->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Author'), ['action' => 'delete', $author->id], ['confirm' => __('Are you sure you want to delete # {0}?', $author->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Authors'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Author'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column column-80">
        <div class="authors view content">
            <h3><?= h($author->first_name) ?></h3>
            <table>
                <tr>
                    <th><?= __('First Name') ?></th>
                    <td><?= h($author->first_name) ?></td>
                </tr>
                <tr>
                    <th><?= __('Email') ?></th>
                    <td><?= h($author->email) ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($author->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Created At') ?></th>
                    <td><?= h($author->created_at) ?></td>
                </tr>
                <tr>
                    <th><?= __('Updated At') ?></th>
                    <td><?= h($author->updated_at) ?></td>
                </tr>
            </table>
            <div class="related">
                <h4><?= __('Related Books') ?></h4>
                <?php if (!empty($author->books)) : ?>
                <div class="table-responsive">
                    <table>
                        <tr>
                            <th><?= __('Id') ?></th>
                            <th><?= __('Title') ?></th>
                            <th><?= __('Publication Date') ?></th>
                            <th><?= __('Publisher Id') ?></th>
                            <th><?= __('Author Id') ?></th>
                            <th><?= __('Created At') ?></th>
                            <th><?= __('Updated At') ?></th>
                            <th class="actions"><?= __('Actions') ?></th>
                        </tr>
                        <?php foreach ($author->books as $book) : ?>
                        <tr>
                            <td><?= h($book->id) ?></td>
                            <td><?= h($book->title) ?></td>
                            <td><?= h($book->publication_date) ?></td>
                            <td><?= h($book->publisher_id) ?></td>
                            <td><?= h($book->author_id) ?></td>
                            <td><?= h($book->created_at) ?></td>
                            <td><?= h($book->updated_at) ?></td>
                            <td class="actions">
                                <?= $this->Html->link(__('View'), ['controller' => 'Books', 'action' => 'view', $book->id]) ?>
                                <?= $this->Html->link(__('Edit'), ['controller' => 'Books', 'action' => 'edit', $book->id]) ?>
                                <?= $this->Form->postLink(__('Delete'), ['controller' => 'Books', 'action' => 'delete', $book->id], ['confirm' => __('Are you sure you want to delete # {0}?', $book->id)]) ?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </table>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
