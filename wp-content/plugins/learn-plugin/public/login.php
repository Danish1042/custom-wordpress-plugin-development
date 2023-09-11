<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">

<div class="login col-md-6">
    <form action="<?php echo get_the_permalink() ?>" method="POST">
        UserName <input type="text" name="username" id="username">
        Password <input type="password" name="password" id="password">
        <input type="submit" class="button mt-3" name="user_login" value="Login">
    </form>
</div>