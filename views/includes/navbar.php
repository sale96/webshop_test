<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="#"><?= SITENAME; ?></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item">
                <a class="nav-link" href="<?= URL_ROOT; ?>">Home</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?= URL_ROOT; ?>?page=Products/index">Products</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?= URL_ROOT; ?>?page=Pages/about">About</a>
            </li>
            <?php if(Sessions::isLogged()) : ?>
            <?php
                $logged = Sessions::getLogged('role_id');
                if($logged == 1) :
            ?>
            <li class="nav-item">
                <a class="nav-link" href="<?= URL_ROOT; ?>?page=Admin/index">Admin panel</a>
            </li>
                <?php endif; ?>
            <?php endif; ?>
        </ul>
        <ul class="navbar-nav float-right">
            <?php if(!Sessions::isLogged()) : ?>
            <li class="nav-item">
                <a class="nav-link" href="<?= URL_ROOT; ?>?page=User/login">Log in</a>
            </li>


            <li class="nav-item">
                <a class="nav-link" href="<?= URL_ROOT; ?>?page=User/register">Register</a>
            </li>
            <?php else : ?>
            <li class="nav-item">
                <a class="nav-link" href="<?= URL_ROOT; ?>?page=User/logout">Log out</a>
            </li>
            <?php endif; ?>
        </ul>
    </div>
</nav>