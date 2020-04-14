<?php 
    include('config/db_connect.php');
    session_start();

    
    $email = $_SESSION['email'];
    $id = $_SESSION['id'] ?? 'New User';
    
    if(isset($_SESSION['email'])){
        $_SESSION['msg'] = "you must log in first to view this page";

       
    } else {
        header('location:register.php');    
    }

    if(isset($_GET['logout'])){
        header("location:login.php");
        session_destroy();
    }

    $postquery = "SELECT title, post FROM blogpost WHERE email='$email'";

    $result = mysqli_query($conn,$postquery);

    $posts = mysqli_fetch_all($result, MYSQLI_ASSOC);
    mysqli_free_result($result);
    mysqli_close($conn); 
?>




<!DOCTYPE html>
<html lang="en">

    <?php include('template/header.php'); ?>
    
    <div class="center">

        <p>you are logged in as <?php echo $email ?></p>
        <div><?php echo $id ?></div>

        <?php 
        foreach($posts as $post) : ?>

            <h5><?php echo $post['title'] ?></h5>
            <p><?php echo $post['post'] ?></p>
        <?php endforeach ?>
        <div>
            <button type="submit" name="logout"><a href="index.php?logout='1">Logout</a></button>
        </div> 
    </div>

    <?php include('template/footer.php') ?>
    

</html>