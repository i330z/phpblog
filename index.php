<?php 
    include('config/db_connect.php');
    session_start();

    
    $email = $_SESSION['email'];
    $id = $_SESSION['id'] ?? 'New User';
    
    if(isset($_SESSION['email'])){
        $_SESSION['msg'] = "you must log in first to view this page";

       
    } else {
        header('location:login.php');    
    }

    if(isset($_GET['logout'])){
        header("location:login.php");
        session_destroy();
    }

    $postquery = "SELECT title, post, id FROM blogpost WHERE email='$email'";

    // $postjoint = "SELECT users.email, users.name, blogpost.title, blogpost.post FROM users INNER JOIN blogpost ON users.email=blogpost.email AND users.email='$email'";
    // $postjoint = "SELECT * FROM users";

    // $jointresult = mysqli_query($conn,$postjoint);

    // $jointpost = mysqli_fetch_all($jointresult, MYSQLI_ASSOC);
    $result = mysqli_query($conn,$postquery);   

    $posts = mysqli_fetch_all($result, MYSQLI_ASSOC);    
    mysqli_free_result($result);
    mysqli_close($conn); 
    // print_r($jointpost);
?>




<!DOCTYPE html>
<html lang="en">

    <?php include('template/header.php'); ?>
    
    <div >
        <div class="container" style="padding-top: 50px;">
        <div class="row">
                <?php 
                foreach($posts as $post) : ?>
                 <div class="col s12 m6">
                    <div class="card horizontal z-depth-0">
                        
                        <div class="card-stacked">
                            <div class="card-content">
                            <span class="card-title" style="font-weight:600;"><?php echo $post['title'] ?></span>
                            <p><?php echo $post['post'] ?></p>
                            </div>
                            <div class="card-action">
                            <a href="details.php?id=<?php echo $post['id']?>">Read More</a>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endforeach ?>
            </div>
        </div>
        <div class="center">
            <button type="submit" class="btn brand" name="logout"><a href="index.php?logout">Logout</a></button>
        </div> 
    </div>

    <?php include('template/footer.php') ?>
    

</html>