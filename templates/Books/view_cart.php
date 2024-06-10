<div class="navbar">
        <span class="navbar-brand">View Cart</span>
        <button class="logout-button"><?= $this->Html->link('Logout', ['controller' => 'Users', 'action' => 'logout']) ?></button>
</div>
<div  class="book-details">
<h1>Your Shopping Cart</h1>
<?= $this->Flash->render() ?>
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
<a href="<?= $this->Url->build(['controller' => 'Orders', 'action' => 'checkout']) ?>">Checkout</a>

<div class="back-button"><?= $this->Html->link('Back', ['controller' => 'Users', 'action' => 'dashboard']) ?></div>


</div>
