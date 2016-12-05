<h2>Provide your credentials</h2>
<form class="form" action="login" method="post">
    <div class="form-group">
        <label for="login">Login:</label>
        <input id="login" name="login" type="text" class="form-control" placeholder="input login here"/>
    </div>
    <div class="form-group">
        <label for="password">Password:</label>
        <input id="password" name="password" type="password" class="form-control" placeholder="*****"/>
    </div>
    <input type="hidden" name="redirect" value="<?php echo $redirect; ?>"/>
    <input type="submit" class="btn btn-success" value="Log in"/>
</form>