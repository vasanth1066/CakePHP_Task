<div class="navbar">
        <span class="navbar-brand">Checkout</span>
        <button class="logout-button"><?= $this->Html->link('Logout', ['controller' => 'Users', 'action' => 'logout']) ?></button>
</div>
<div class="checkout-container">
<h1>Checkout</h1>
<div class="back-button"><?= $this->Html->link('Back', ['controller' => 'Books', 'action' => 'viewCart']) ?></div>

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
    <?= $this->Form->control('', [
                    'type' => 'radio', 
                    'options' => ['onlinepayment' => 'Online Payment', 'Cash' => 'Cash on Delivery'], 
                    
                ]) ?>
    <?= $this->Form->button('Place Order') ?>
    <?= $this->Form->end() ?>


</form>
</div>