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
            <?= $this->Html->link(__('Edit Publisher'), ['action' => 'edit', $publisher->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Publisher'), ['action' => 'delete', $publisher->id], ['confirm' => __('Are you sure you want to delete # {0}?', $publisher->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Publishers'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Publisher'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column column-80">
        <div class="publishers view content">
            <h3><?= h($publisher->name) ?></h3>
            <table>
                <tr>
                    <th><?= __('Name') ?></th>
                    <td><?= h($publisher->name) ?></td>
                </tr>
                <tr>
                    <th><?= __('Website') ?></th>
                    <td><?= h($publisher->website) ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($publisher->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Created At') ?></th>
                    <td><?= h($publisher->created_at) ?></td>
                </tr>
                <tr>
                    <th><?= __('Updated At') ?></th>
                    <td><?= h($publisher->updated_at) ?></td>
                </tr>
            </table>
            <div class="related">
                <h4><?= __('Related Books') ?></h4>
                <?php if (!empty($publisher->books)) : ?>
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
                        <?php foreach ($publisher->books as $book) : ?>
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
