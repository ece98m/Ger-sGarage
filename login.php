<?php include "header.php"; ?>



<?php

if(!empty($_SESSION['email'])) { //eğer $_SESSION['email'] değişkeni
    header("Location: profie.php"); // boş değilse (yani kullanıcı oturumu açmışsa), tarayıcıyı "profile.php" sayfasına yönlendirir.
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email= $_POST['email'];
    $password = $_POST['password'];

    $errors = array();
    
    if(empty($email)) {
        $errors[] = "Please enter your email";
    }
    if(empty($password)) {
        $errors[] = "Please enter your password";
    }
    
    if(empty($errors)) { 
        // $errors dizisinin boş olup olmadığını kontrol eder. Eğer hata yoksa, kullanıcıyı kontrol etmek ve giriş işlemini gerçekleştirmek için bu bloğa girilir.
        $sql = "SELECT * FROM customers WHERE email='$email' AND password='$password'";
        $result = $mysqli->query($sql);

        if ($result->num_rows == 1) {
            // Giriş başarılı, oturumu başlat
            $_SESSION['email'] = $email;
            header("Location: profile.php"); // Giriş başarılıysa yönlendirilecek sayfa
        } else {
            // Giriş başarısız
            $errors[] = "Your account has not been found";
        }
    }
    
}

?>


<section id="">
<div class="container mt-5 mb-5">   // margintop marginbuttom
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
                        <label for="email">Email</label>
                        <input  value="<?=$email?>" name="email" type="email" class="form-control" id="email" placeholder="Enter your email">
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