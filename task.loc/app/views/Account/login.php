<div class="row">
    <div class="col-md-6">
        <?php MessageShow(); ?>
        <form method="post" action="/account/login">
            <div class="form-group">
                <label for="login">Login</label>
                <input type="text" name="login" class="form-control" id="login" placeholder="Login">
            </div>
            <div class="form-group">
                <label for="password">Login</label>
                <input type="password" name="password" class="form-control" id="password" placeholder="password">
            </div>
            <button type="submit" class="btn btn-default">Вход</button>
        </form>
    </div>
</div>

