<?php include 'views/includes/admin.nav.php'; ?>
<h2>Update product</h2>
<form action="<?= URL_ROOT ?>?page=Admin/update/<?= $data['id'] ?>" method="post">
    <div class="form-group">
        <label for="product-name">Product name</label>
        <input type="text" class="form-control" name="product-name" id="product-name" value="<?= isset($data['product']) ? $data['product']->product_name : '' ?>">
    </div>
    <div class="form-group">
        <label for="product-price">Product price</label>
        <input type="number" class="form-control" name="product-price" id="product-price" value="<?= isset($data['product']) ? $data['product']->product_price : '' ?>">
    </div>
    <div class="form-group">
        <label for="product-quantity">Product quantity</label>
        <input type="number" class="form-control" name="product-quantity" id="product-quantity"  value="<?= isset($data['product']) ? $data['product']->product_quantity : '' ?>">
    </div>
    <div class="form-group">
        <label for="product-desc">Description</label>
        <textarea class="form-control" style="resize: none;" rows="10" name="product-desc" id="product-desc"><?= isset($data['product']) ? $data['product']->product_desc : '' ?></textarea>
    </div>
    <div class="form-group mt-5">
        <button type="submit" name="product-submit" class="btn btn-primary">Submit</button>
    </div>
</form>