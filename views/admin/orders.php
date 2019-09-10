
<?php include 'views/includes/admin.nav.php'; ?>
<h3>Orders</h3>

<?php if(isset($data['order'])) : ?>

    <?php foreach($data['order'] as $order) : ?>

        <div class="card mb-1">
            <div class="row">
                <div class="col-6">
                    <ul>
                        <li>Name: <?= $order->first_last_name; ?></li>
                        <li>Address: <?= $order->address; ?></li>
                        <li>Email: <?= $order->email; ?></li>
                        <li>Total price: <strong><?= $order->total_price; ?></strong></li>
                    </ul>
                </div>
                <div class="col-6">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Product name:</th>
                                <th>Product price:</th>
                                <th>Product quantity:</th>
                                <th>Total price:</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><?= $order->product_name; ?></td>
                                <td><?= $order->product_price; ?></td>
                                <td><?= $order->item_quantity; ?></td>
                                <td><?= $order->item_quantity * $order->product_price; ?></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    <?php endforeach; ?>

<?php else: ?>

<p class="lead">No orders found.</p>

<?php endif; ?>
