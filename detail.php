<?php
include('./config/db_connect.php');
//check get request id param
if(isset($_GET['id'])){
    //escape sql chars
    $id=mysqli_real_escape_string($conn, $_GET['id']);
    //make sql
    $sql="SELECT * FROM pizzas WHERE id=$id";
    //get the query result
    $result=mysqli_query($conn, $sql);
    //fetch result in array format
    $pizza=mysqli_fetch_assoc($result);
    mysqli_free_result($result);
    mysqli_close($conn);
}
?>
<!DOCTYPE html>
<html lang="en">
<?php include('templates/header.php')?>
<div class="container center">
    <?php if($pizza):?>
        <h4><?php echo $pizza['name']; ?></h4>
        <p>Created by <?php echo $pizza['email']?></p>
        <p><?php echo date($pizza['created_at'])?></p>
        <h5>ingredients</h5>
        <p><?php echo $pizza['ingredients']?></p>
    <?php else:?>
        <h5>No such pizza exists</h5>
    <?php endif?>
</div>
<?php?>
</html>