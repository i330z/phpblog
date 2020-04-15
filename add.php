<?php 

    session_start();
    include('config/db_connect.php');

    $email = $_SESSION['email'];
    $id = $_SESSION['id'];

    $title = $post = '';
    $error = array('title'=>'','post'=>'');

    if(isset($_POST['cancel'])){
        header("location:index.php");
    }

    if(isset($_POST['submit'])){

        if(empty($_POST['title'])){
            $error['title'] = 'Please Enter a title';
        } else {
            $title = htmlspecialchars($_POST["title"]);
        }

        if(empty($_POST['post'])){
            $error['post'] = 'Please Enter a post';
        } else {
            $post = htmlspecialchars($_POST["post"]);
        }

        if(array_filter($error)){
            

        } else {
            $email = $_SESSION['email'];
            $title = htmlspecialchars($_POST['title']);
            $post = htmlspecialchars($_POST['post']);

            echo $email . $title . $post;

            $sql = "INSERT INTO blogpost(email,title,post) VALUES('$email','$title','$post')";

            if(mysqli_query($conn,$sql)){
                header('Location:index.php');
                
            } else {
                echo 'Erorr' . mysqli_error($conn);
            }
        }


    }

?>


<!DOCTYPE html>
<html lang="en">

    <?php include('template/header.php'); ?>
    
    <div class="center" style="padding-top: 50px;">
        <div>
        <form class="white" action="add.php" method="POST">
        
        
        <label for="email">Post Title:</label>
        <input type="text" name="title" value="<?php echo htmlspecialchars($title)?>">
        <div class="red-text"><?php echo $error['title']; ?></div>
        <label for="email">Post:</label>
        <textarea id="textarea1" name="post" class="materialize-textarea" value="<?php echo htmlspecialchars($post)?>"></textarea>
        <div class="red-text"><?php echo $error['post']; ?></div>
        <div class="center">
            <input type="submit" name="submit" value="submit" class="btn brand z-depth-0">
            <input type="submit" name="cancel" value="cancel" class="btn brand z-depth-0">
        </div>
        
        </form>
        
        </div>

    </div>
    <!-- <div class="center">
        <button type="submit" class="btn brand" name="logout"><a href="index.php?logout='1">Logout</a></button>
    </div>  -->

    <?php include('template/footer.php') ?>
    

</html>