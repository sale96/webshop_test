<div class="row">
    <?php if(isset($data['products'])) : ?>
        <?php if(count($data['products']) > 0) : ?>
            <?php foreach($data['products'] as $product) : ?>
                <div class="card" style="width: 18rem;">
                    <img class="card-img" src="<?= $product->image_location != null ? $product->image_location : 'http://placehold.it/250x250' ?>" alt="<?= $product->image_alt ?>">
                    <div class="card-body col-8">
                        <h3><?= $product->product_name ?></h3>
                        <p><?= $product->product_desc ?></p>
                        <a href="<?= URL_ROOT ?>?page=Products/single/<?= $product->product_id ?>" class="btn btn-outline-primary">See more</a>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else : ?>
        <p class="lead">No products found.</p>
        <?php endif; ?>
    <?php else : ?>
    <p class="lead">Error loading products.</p>
    <?php endif; ?>
</div>
