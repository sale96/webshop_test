<?php include 'views/includes/admin.nav.php'; ?>

<table class="table stripped">
    <thead class="thead-dark">
    <tr>
        <th>Product ID</th>
        <th>Product name</th>
        <th>Product price</th>
        <th>Product quantity</th>
        <th>Product description</th>
        <th>Product link</th>
        <th></th>
        <th></th>
    </tr>
    </thead>
    <tbody>
    <?php if(count($data['products']) > 0) : ?>

        <?php foreach($data['products'] as $product) : ?>

            <tr>
                <td><?= $product->product_id ?></td>
                <td><?= $product->product_name ?></td>
                <td><?= $product->product_price ?></td>
                <td><?= $product->product_quantity ?></td>
                <td><?= $product->product_desc ?></td>
                <td><a href="<?= URL_ROOT ?>?page=Products/single/<?= $product->product_id ?>">Link</a></td>
                <td><a class="btn btn-info" href="<?= URL_ROOT ?>?page=Admin/update/<?= $product->product_id ?>">Update</a></td>
                <td>
                    <form action="<?= URL_ROOT ?>?page=Admin/remove/<?= $product->product_id ?>" method="post">
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </td>
            </tr>

        <?php endforeach; ?>

    <?php endif; ?>
    </tbody>
</table>
