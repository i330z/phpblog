<?php 

    include('config/db_connect.php');

    $email = $password = '';
    $error = array('email'=>'','password'=>'');

    if(isset($_POST['login'])){

        if(empty($_POST["email"])){
            $error['email'] = 'Please Enter a email';
        } else {
            $email = htmlspecialchars($_POST["email"]);
        }
 
        if(empty($_POST["password"])){
            $error['password'] = 'Please Enter a password';
        } else {
            $password = htmlspecialchars($_POST["password"]);
        }

        if(array_filter($error)){

        } else {
            $email = mysqli_real_escape_string($conn,$_POST['email']);
            $password = mysqli_real_escape_string($conn,$_POST['password']);


            $sqlquery = "SELECT * FROM users WHERE email='$email' AND password='$password'";
            $result = mysqli_query($conn,$sqlquery);
            $arr = mysqli_fetch_assoc($result);

            echo $arr['id'];

            if(mysqli_query($conn,$sqlquery)){
                header("Location:index.php?id={$arr['id']}");
                session_start();
                $_SESSION["email"] = $_POST['email'];
                $_SESSION['id'] =  $arr['id'];
            
            } else {
                echo 'Erorr' . mysqli_error($conn);
            }
        }





    }

?>


<!DOCTYPE html>
<html lang="en">

    <?php include('template/header.php'); ?>
    <h5 class="center">LOGIN PANEL</h5>
    <form class="white" action="login.php" method="POST">
        
        <label for="email">Email:</label>
        <input type="text" name="email" value="<?php echo htmlspecialchars($email)?>">
        <div class="red-text"><?php echo $error['email']; ?></div>
        <label for="password">password:</label>
        <input type="password" name="password" value="<?php echo htmlspecialchars($password)?>">
        <div class="red-text"><?php echo $error['password']; ?></div>
        <div class="center">
            <input type="submit" name="login" value="login" class="btn brand z-depth-0">
        </div>
        <div class="center">
            <a href="register.php">Create an Account</a>
        </div>
    </form>

    <?php include('template/footer.php') ?>
    

</html>

