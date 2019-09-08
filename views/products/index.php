<div class="row">
    <!-- if products exist -->
    <?php if(isset($data['products'])) : ?>
        <!--    Checking if there are more then 0 products    -->
        <?php if(count($data['products']) > 0) : ?>
            <?php foreach($data['products'] as $product) : ?>
                <div class="card" style="width: 18rem; margin-right: 3px;">
                    <img class="card-img" src="<?= $product->image_location != null ? $product->image_location : 'http://placehold.it/250x250' ?>" alt="<?= $product->image_alt ?>">
                    <div class="card-body col-8">
                        <h3><?= $product->product_name ?></h3>
                        <p><?= strlen($product->product_desc) > 35 ? substr($product->product_desc, 0, 35). '...' : $product->product_desc ?></p>
                        <a href="<?= URL_ROOT ?>?page=Products/single/<?= $product->product_id ?>" class="btn btn-outline-primary">See more</a>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else : ?>

        <!--   if there are 0 products prints this message     -->
        <p class="lead">No products found.</p>
        <?php endif; ?>
    <?php else : ?>
    <!--  if products don't exist prints error  -->
    <p class="lead">Error loading products.</p>
    <?php endif; ?>
</div>
