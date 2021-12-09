
<?php 
include('./config/db_connect.php');
$email=$title=$ingredients='';
$error=array('email'=>'','title'=>'','ingredients'=>'');
if(isset($_POST['submit'])){
    if(empty($_POST['email'])){
        $error['email']='email is required <br>';
    }else{
        $email=$_POST['email'];
        if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
            $error['email']= 'email must be valid email address';
        }
    }
    if(empty($_POST['title'])){
        $error['title']='title is required <br>';
    }else{
        $title=$_POST['title'];
        if(!preg_match('/^[a-zA-Z\s]+$/', $title)){
            $error['title']='tilte only accept letter and space';
        }
    }
    if(empty($_POST['ingredients'])){
        $error['ingredients']= 'at least one ingredients is required <br>';
    }else{
        $ingredients = $_POST['ingredients'];
			if(!preg_match('/^([a-zA-Z\s]+)(,\s*[a-zA-Z\s]*)*$/', $ingredients)){
				$error['ingredients']='Ingredients must be a comma separated list';
    }}
    if(array_filter($error)){

    }else{
        //escape sql chars
        $email=mysqli_real_escape_string($conn, $_POST['email']);
        $title=mysqli_real_escape_string($conn, $_POST['title']);
        $ingredients=mysqli_real_escape_string($conn, $_POST['ingredients']);
       //create sql
       $sql="INSERT INTO pizzas(name, email,ingredients ) VALUES('$title','$email','$ingredients')";
       //save to db and check
       if(mysqli_query($conn, $sql)){
           //success
           header('Location:index.php');
       }else{
           echo 'query error'.mysqli_error($conn);
       }

        
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<?php 
include ('./templates/header.php');?>
<section class="container grey-text">
		<h4 class="center">Add a Pizza</h4>
		<form class="white" action="add.php" method="POST">
			<label>Your Email</label>
			<input type="text" name="email" value="<?php echo htmlspecialchars($email) ?>">
            <div class="red-text"><?php echo $error['email']?></div>
			<label>Pizza Title</label>
			<input type="text" name="title" value="<?php echo htmlspecialchars($title) ?>">
            <div class="red-text"><?php echo $error['title']?></div>
			<label>Ingredients (comma separated)</label>
			<input type="text" name="ingredients" value="<?php echo htmlspecialchars($ingredients) ?>">
            <div class="red-text"><?php echo $error['ingredients']?></div>
			<div class="center">
				<input type="submit" name="submit" value="Submit" class="btn brand z-depth-0">
			</div>
		</form>
	</section>
<?php include('./templates/footer.php');
?>
</html>