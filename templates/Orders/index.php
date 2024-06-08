<h1>Order History</h1>
<?php if (!empty($orders)): ?>
    <?php foreach ($orders as $order): ?>
        <h3>Order #<?= h($order->id) ?> - <?= h($order->created) ?></h3>
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
           <!-- <?php print_r($orders)?> -->
                <?php foreach ($order->order_items as $item): ?>
                    <tr>
                        <td><?= h($item->book->title) ?></td>
                        <td><?= h($item->quantity) ?></td>
                        <td><?= h($item->price) ?></td>
                        <td><?= h($item->quantity * $item->price) ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <p>Total Price: <?= h($order->total_price) ?></p>
    <?php endforeach; ?>
<?php else: ?>
    <p>No orders found.</p>
<?php endif; ?>
