
<h2>Register</h2>

<div class="row">
    <form class="col-6 align-self-center" action="<?= URL_ROOT ?>?page=User/register" method="post">
        <div class="form-group">
            <label for="first-last-name">Firstname & Lastname</label>
            <input type="text" class="form-control" name="first-last-name" id="first-last-name" value="<?= isset($data['params']) ? $data['params']['first-last-name'] : '' ?>">
        </div>
        <div class="form-group">
            <label for="username">Username</label>
            <input type="text" class="form-control" name="username" id="username" value="<?= isset($data['params']) ? $data['params']['username'] : '' ?>">
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" class="form-control" name="email" id="email" value="<?= isset($data['params']) ? $data['params']['email'] : '' ?>">
        </div>
        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" class="form-control" name="password" id="password" value="<?= isset($data['params']) ? $data['params']['password'] : '' ?>">
        </div>
        <div class="form-group">
            <label for="rep-password">Repeat password</label>
            <input type="password" class="form-control" name="rep-password" id="rep-password" value="<?= isset($data['params']) ? $data['params']['rep-password'] : '' ?>">
        </div>
        <div class="form-group">
            <button class="btn btn-primary" name="submit-register">Submit</button>
        </div>
    </form>
</div>