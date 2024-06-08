
<h1>Checkout</h1>
<form method="post" action="<?= $this->Url->build() ?>">
    <?= $this->Form->create() ?>
    <table>
        <thead>
            <tr>
                <th>Book</th>
                <th>Quantity</th>
                <th>Price</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
        <!-- <?php print_r($cart)?> -->
            <?php foreach ($cart as $item): ?>
                <tr>
                    <td><?= h($item['title']) ?></td>
                    <td><?= h($item['quantity']) ?></td>
                    <td><?= h($item['price']) ?></td>
                    <td><?= h($item['quantity'] * $item['price']) ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <p>Total: <?= array_sum(array_map(function($item) { return $item['quantity'] * $item['price']; }, $cart)) ?></p>
    <?= $this->Form->button('Place Order') ?>
    <?= $this->Form->end() ?>
</form>
