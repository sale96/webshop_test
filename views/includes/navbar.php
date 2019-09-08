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
            <li class="nav-item">
                <a class="nav-link" href="<?= URL_ROOT; ?>?page=Admin/index">Admin panel</a>
            </li>
        </ul>
        <ul class="navbar-nav float-right">
            <li class="nav-item">
                <button class="btn btn-warning" id="cart-toggle">Cart</button>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?= URL_ROOT; ?>?page=User/login">Log in</a>
            </li>


            <li class="nav-item">
                <a class="nav-link" href="<?= URL_ROOT; ?>?page=User/register">Register</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?= URL_ROOT; ?>?page=User/logout">Log out</a>
            </li>
        </ul>
    </div>
</nav>