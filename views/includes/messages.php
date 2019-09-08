<?php if(Sessions::isError()) : ?>
    <?php if(is_array(Sessions::getError())) : ?>
        <?php foreach(Sessions::getError() as $error) : ?>
            <p class="alert alert-danger"><?= $error ?></p>
        <?php endforeach; ?>
    <?php else : ?>
        <p class="alert alert-danger"><?= Sessions::getError() ?></p>
    <?php endif; ?>
    <?php Sessions::destroyError(); ?>
<?php elseif(Sessions::isSuccess()) : ?>

    <p class="alert alert-success"><?= Sessions::getSuccess(); ?></p>
    <?php Sessions::destroySuccess(); ?>
<?php endif; ?>
