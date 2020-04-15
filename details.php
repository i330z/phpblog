<?php 

    include('config/db_connect.php');

    if(isset($_GET['id'])){

        $id = mysqli_real_escape_string($conn,$_GET['id']);
        $sql = "SELECT * FROM blogpost WHERE id = $id";

        $result = mysqli_query($conn,$sql);

        $detail = mysqli_fetch_assoc($result);

        mysqli_free_result($result);
        mysqli_close($conn);
    }

    if(isset($_POST['delete'])){

        $id_to_delete = mysqli_real_escape_string($conn,$_POST['id_to_delete']);

        $sql = "DELETE FROM blogpost WHERE id=$id_to_delete";

        if(mysqli_query($conn,$sql)){
            header("location:index.php");
        } else {
            echo 'query error' . mysqli_error($conn);
        }
    }

?>

<!DOCTYPE html>
<html lang="en">
    <?php include('template/header.php'); ?>
    <div class="container" style="padding-top: 50px;">
        <div class="row">
            <div class="col md12" style="width:100%">
                    <div class="card horizontal z-depth-0">
                        <div class="card-stacked">
                            <div class="card-content">
                            <span class="card-title" style="font-weight:600;"><?php echo $detail['title'] ?></span>
                            <p><?php echo $detail['post'] ?></p>
                            </div>
                            <div class="card-action">
                            <form action="details.php" method="POST" style="padding:0px;margin:0px;">
                                <input type="hidden" name="id_to_delete" value="<?php echo $detail['id'] ?>">
                                <input type="submit" name="delete" value="Delete" class="btn brand z-depth-0">
                            </form>
                            </div>
                        </div>
                    </div>
            </div>
        </div>
    </div>
    

    <?php include('template/footer.php'); ?>
</html>