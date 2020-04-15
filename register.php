<?php 

    include('config/db_connect.php');

    $name = $email =$password = '';
    $error = array('email'=>'','name'=>'','password'=>'');

    if(isset($_POST["submit"])){

        if(empty($_POST["name"])){
            $error['name'] = 'Please Enter a Name';
        } else {
            $name = htmlspecialchars($_POST["name"]);
        }

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
            
        }else{
            $email = mysqli_real_escape_string($conn, $_POST['email']);
            $name = mysqli_real_escape_string($conn, $_POST['name']);
            $password = mysqli_real_escape_string($conn, $_POST['password']);

            $sql = "INSERT INTO users(email,name,password) VALUES('$email','$name','$password')";

            if(mysqli_query($conn,$sql)){
                header('Location:index.php');
                session_start();
                $_SESSION["email"] = $_POST['email'];
            } else {
                echo 'Erorr' . mysqli_error($conn);
            }

            
        }

    }






?>

<!DOCTYPE html>
<html lang="en">

    <?php include('template/header.php'); ?>
    
   <h5 class="center">Register as user</h5>
   <div class="register-form">
   
   
   <form class="white" action="register.php" method="POST">
        
        <label for="email">Email:</label>
        <input type="text" name="email" value="<?php echo htmlspecialchars($email)?>">
        <div class="red-text"><?php echo $error['email']; ?></div>
        <label for="name">Name:</label>
        <input type="text" name="name" value="<?php echo htmlspecialchars($name)?>">
        <div class="red-text"><?php echo $error['name']; ?></div>
        <label for="password">password:</label>
        <input type="password" name="password" value="<?php echo htmlspecialchars($password)?>">
        <div class="red-text"><?php echo $error['password']; ?></div>
        <div class="center">
            <input type="submit" name="submit" value="submit" class="btn brand z-depth-0">
            <div class="center">
                Already have an account? <a href="login.php">Login</a>
            </div>
        </div>
        
    </form>
   
   
   
   </div>
    <?php include('template/footer.php') ?>
    

</html>