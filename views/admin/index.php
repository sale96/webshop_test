<?php include 'views/includes/admin.nav.php'; ?>

<h2>Add product</h2>
<div class="row">
    <form class="col-6" action="<?= URL_ROOT ?>?page=Admin/index" method="post" enctype="multipart/form-data">
        <div class="form-group">
            <label for="product-name">Product name</label>
            <input type="text" class="form-control" name="product-name" id="product-name" value="<?= isset($data['request']) ? $data['request']['product-name'] : '' ?>">
        </div>
        <div class="form-group">
            <label for="product-price">Product price</label>
            <input type="number" class="form-control" name="product-price" id="product-price" value="<?= isset($data['request']) ? $data['request']['product-price'] : '' ?>">
        </div>
        <div class="form-group">
            <label for="product-quantity">Product quantity</label>
            <input type="number" class="form-control" name="product-quantity" id="product-quantity"  value="<?= isset($data['request']) ? $data['request']['product-quantity'] : '' ?>">
        </div>
        <div class="form-group">
            <label for="product-desc">Description</label>
            <textarea class="form-control" style="resize: none;" rows="10" name="product-desc" id="product-desc"><?= isset($data['request']) ? $data['request']['product-desc'] : '' ?></textarea>
        </div>
        <div class="form-group custom-file">
            <input type="file" class="custom-file-input" id="product-image" name="product-image">
            <label class="custom-file-label" for="customFile">Choose file</label>
        </div>
        <div class="form-group mt-5">
            <button name="product-submit" class="btn btn-primary">Submit</button>
        </div>
    </form>

</div>