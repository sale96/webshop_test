<div class="row">
    <form class="col-7" action="<?= URL_ROOT ?>?page=Cart_show/index" method="post">
        <h3>Enter your credentials:</h3>
        <div class="form-group">
            <label for="name">Name and last name:</label>
            <input type="text" name="name" id="name" class="form-control">
        </div>
        <div class="form-group">
            <label for="email">Email adress:</label>
            <input type="email" name="email" id="email" class="form-control">
        </div>
        <div class="form-group">
            <label for="address">Address:</label>
            <input type="text" name="address" id="address" class="form-control">
        </div>
        <div class="form-group">
            <button class="btn btn-success">Send your order</button>
        </div>
    </form>
    <div class="col-5">
        <h3>Products ordered:</h3>
        <table class="table">
            <thead>
                <tr>
                    <th>Product name:</th>
                    <th>Product quantity:</th>
                    <th>Product price:</th>
                    <th>Sum price:</th>
                </tr>
            </thead>

            <tbody>
            <?php $total = 0; ?>
                <?php if(Sessions::isCart()) : ?>
                    <?php foreach(Sessions::getCart() as $item) : ?>
                    <?php $total = $total + $item['quantity'] * $item['price']; ?>
                        <tr>
                            <td><?= $item['name']; ?></td>
                            <td><?= $item['quantity']; ?></td>
                            <td><?= $item['price']; ?></td>
                            <td><?= $item['quantity'] * $item['price']; ?></td>
                        </tr>
                    <?php endforeach; ?>

                <?php endif; ?>
            </tbody>
            <tfoot>
                <?php if(Sessions::isCart()) : ?>
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td>Total: <?= $total ?></td>
                    </tr>
                <?php endif; ?>
            </tfoot>
        </table>
    </div>
</div>