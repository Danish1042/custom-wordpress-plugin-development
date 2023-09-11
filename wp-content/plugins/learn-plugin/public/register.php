<?php
if (isset($_POST['register'])) {
    global $wpdb;

    $name = $wpdb->escape($_POST['full_name']);
    $email = $wpdb->escape($_POST['email']);
    $username = $wpdb->escape($_POST['username']);
    $password = $wpdb->escape($_POST['password']);
    $c_password = $wpdb->escape($_POST['c_password']);

    if ($password == $c_password) {
        // wp_insert_user()
        // wp_create_user()
        $result = wp_create_user($username, $password, $email);
        if (!is_wp_error($result)) {
            echo "User Created" . $result;
            add_user_meta($result, 'type', 'faculty');
            update_user_meta($result, 'show_admin_bar_front', false);
        } else {
            echo $result->get_error_message();
        }
    } else {
        echo "Password must match!";
    }
}

?>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
<div class="form-wrapper">
   
    <hr>
    <div class="registration col-md-6">
        <form action="<?php echo get_the_permalink(); ?>" method="POST">
            Name <input type="text" name="full_name" id="full_name">
            UserName <input type="text" name="username" id="username">
            Email <input type="text" name="email" id="email">
            Password <input type="password" name="password" id="password">
            Confirm Password <input type="password" name="c_password" id="c_password">
            <input type="submit" class="button mt-3" name="register" value="Register">
        </form>
    </div>
</div>