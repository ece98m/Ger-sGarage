<?php

/* include "connection.php";              ../ */
require '../userpages/connection.php';          


?>

<?php

if(!empty($_SESSION['username'])) { 
    header("Location: main.php"); 
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username= $_POST['username'];
    $password = $_POST['password'];

    $errors = array();
    
    if(empty($username)) {
        $errors[] = "Please enter your username";
    }
    if(empty($password)) {
        $errors[] = "Please enter your password";
    }
    
    if(empty($errors)) { 
      
        $sql = "SELECT * FROM admin WHERE username='$username' AND password='$password'";
        $result = $mysqli->query($sql);

        if ($result->num_rows == 1) {
        
            $_SESSION['username'] = $username;
            header("Location: main.php"); 
        } else {
       
            $errors[] = "Your account has not been found";
        }
    }
    
}

?>

<link rel="stylesheet" type="text/css" href="admincss/styleadminlogin.css">
<section id="">
<div class="container mt-5 mb-5">  
        <div class="row justify-content-center">
            <div class="col-md-6">
            <?php 
                if(!empty($errors)): foreach ($errors as $key => $value) { ?>
                <div class="alert alert-warning" role="alert">
                    <?=$value?>
                </div>
                <?php } endif; ?>
                <h2>Login</h2>
                <form action="" method="post">
                    <div class="form-group">
                        <label for="username">username</label>
                        <input  value="<?=$username?>" name="username" type="username" class="form-control" id="username" placeholder="Enter your username">
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input  value="<?=$password?>" name="password" type="password" class="form-control" id="password" placeholder="Enter your password">
                    </div>
                    <button type="submit" class="btn btn-primary">Login</button>
                </form>
            </div>
        </div>
    </div>
</section>
<?php include "footer.php"; ?>