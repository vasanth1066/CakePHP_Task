
<div class="row">
    
    <div class="column column-100">
        <div class="books view content">
            <h3><?= h($book->title) ?></h3>
            <table>
                <tr>
                    <th><?= __('Title') ?></th>
                    <td><?= h($book->title) ?></td>
                </tr>
                <tr>
                    <th><?= __('Price') ?></th>
                    <td><?= h($book->price) ?></td>
                </tr>
                <tr>
                    <th><?= __('Description') ?></th>
                    <td><?= h($book->description) ?></td>
                </tr>
                <tr>
                    <th><?= __('Publisher') ?></th>
                    <td><?= h($book->publisher->name) ?></td>
                </tr>
                <tr>
                    <th><?= __('Author') ?></th>
                    <td><?= h($book->author->first_name) ?></td>
                <tr>
                    <th><?= __('Publication Date') ?></th>
                    <td><?= h($book->publication_date) ?></td>
                </tr>
                
            </table>
            
            <a href="<?= $this->Url->build(['action' => 'addToCart', $book->id]) ?>">Add to Cart</a>
            
        </div>
    </div>

</div>
<?php if (!empty($book->book_comments)): ?>
    <h3>Comments</h3>
    <ul>
        <?php foreach ($book->book_comments as $comment): ?>
            <li><?= h($comment->comment) ?></li>
        <?php endforeach; ?>
    </ul>
<?php else: ?>
    <p>No comments yet.</p>
<?php endif; ?>

<hr>


<?= $this->Form->create(null, ['url' => ['controller' => 'Comments', 'action' => 'add']]) ?>
<?= $this->Form->hidden('book_id', ['value' => $book->id]) ?>
<?= $this->Form->control('comment', ['label' => 'Add a Comment']) ?>
<?= $this->Form->button(__('Submit')) ?>
<?= $this->Form->end() ?>

