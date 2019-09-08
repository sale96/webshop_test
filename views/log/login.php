
<h2>Log in</h2>

<div class="row">
    <form class="col-6 align-self-center" action="<?= URL_ROOT ?>?page=User/login" method="post">
        <div class="form-group">
            <label for="username">Username</label>
            <input type="text" class="form-control" name="username" id="username" value="<?= isset($data['params']) ? $data['params']['username'] : '' ?>">
        </div>
        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" class="form-control" name="password" id="password" value="<?= isset($data['params']) ? $data['params']['password'] : '' ?>">
        </div>
        <div class="form-group">
            <button class="btn btn-primary" name="submit-login">Submit</button>
        </div>
    </form>
</div>