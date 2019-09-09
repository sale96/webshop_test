<?php if(isset($data['product'])) : ?>
    <div class="row">
        <div class="col-4">
            <img class="rounded mw-100" src="<?= $data['product']->image_location; ?>" alt="<?= $data['product']->image_alt; ?>">
        </div>
        <div class="col-8">
            <h3><?= $data['product']->product_name ?></h3>
            <p><?= $data['product']->product_desc ?></p>
            <p>Quantity: <?= $data['product']->product_quantity ?></p>
            <p class="alert alert-success"><?= $data['product']->product_price ?> RSD</p>
            <?php if($data['product']->product_quantity != 0) : ?>
                <input type="hidden" id="hidden_name" value="<?= $data['product']->product_name ?>">
                <input type="hidden" id="hidden_price" value="<?= $data['product']->product_price ?>">
                <input type="hidden" id="hidden_quantity" value="1">
                <button id="cart-button" data-value="<?= $data['product']->product_id ?>" class="btn btn-lg btn-block btn-primary">Add to the cart</button>
            <?php else: ?>
                <p class="lead">Currently we don't have this product at our disposal.</p>
            <?php endif; ?>
        </div>
    </div>

<?php else : ?>
    <p class="alert alert-error">Product does not exist.</p>
<?php endif; ?>
