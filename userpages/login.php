<?php 
include "header.php";?>
<?php 

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if(isset($_SESSION['email'])) { 
    header("Location: profile.php");
    exit;
} 

$errors = array();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);
    
    if(empty($email)) {
        $errors[] = "Please enter your email";
    }
    if(empty($password)) {
        $errors[] = "Please enter your password";
    }
    
    if(empty($errors)) {
        $sql = "SELECT * FROM customers WHERE email = ? AND password = ?";
        $stmt = $mysqli->prepare($sql);
        
        $stmt->bind_param("ss", $email, $password);
        $stmt->execute();

        $result = $stmt->get_result();

        if ($result->num_rows == 1) {
            $_SESSION['email'] = $email;
            header("Location: ".URL."profile.php");
            exit;
        } else {
            $errors[] = "Your account has not been found";
        }

        $stmt->close();
    }
}
?>

<section id="">
<div class="login-area ptb-100">  
    <div class="container">
        <div class="login-item">
            <?php 
            if(!empty($errors)): foreach ($errors as $error): ?>
                <div class="alert alert-warning" role="alert">
                    <?php echo $error; ?>
                </div>
            <?php endforeach; endif; ?>
            
            <h2>Login</h2>
            <form action="" method="POST">
                <div class="form-group">
                    <label for="email">Email</label>
                    <input name="email" type="email" class="form-control" id="email" placeholder="Enter your email">
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input name="password" type="password" class="form-control" id="password" placeholder="Enter your password">
                </div>
                <div class="text-center">
                    <button type="submit" class="btn btn-primary">Login</button>
                </div>
            </form>
            <span>New member? <a href="register.php">Register Now</a></span>
        </div>
    </div>
</div>
</section>

<?php include "footer.php"; ?>




   