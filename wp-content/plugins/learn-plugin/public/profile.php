<?php
if(!defined('ABSPATH')){
    header('location: /');
    die();
}
// update code 
if(isset($_POST['update'])){
    $user_id = esc_sql($_POST['user_id']);
    $first_name = esc_sql($_POST['first_name']);
    $last_name = esc_sql($_POST['last_name']);

    $userdata = array(
        'ID' => $user_id,
        'first_name' => $first_name,
        'last_name' => $last_name,
    );
    $user = wp_update_user($userdata);

    if(is_wp_error($user)){
        echo 'can not update the record: '. $user->get_error_message();
    }
}

$user_id = get_current_user_id();
$user = get_userdata($user_id);
if($user != false):
    echo wp_logout_url();
// echo '<pre>';
// print_r($user);
$user_type = get_usermeta($user_id, 'type');
$first_name = get_usermeta($user_id, 'first_name');
$last_name = get_usermeta($user_id, 'last_name');
echo '</pre>';
?>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">

<h1>Hi  <?php echo "$first_name $last_name <small>($user_type)</small>"; ?></h1>
<p>Not <?php echo "$first_name $last_name "?><a href="<?php echo wp_logout_url(); ?>">Logout</a></p>
<form action="<?php get_the_permalink(); ?>" method="post">
    First Name: <input type="text" name="first_name" id="first_name" value="<?php echo $first_name ?>">
    Email : <input type="text" name="last_name" id="last_name" value="<?php echo $last_name ?>">
    <input type="hidden" name="user_id" value="<?php echo $user_id ?>">
    <input type="submit" class="mt-3" name="update" id="update" value="Update">
</form>
<?php
endif;
?>