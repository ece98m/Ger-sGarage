<?php include "header.php"; ?>
<?php 
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $email = $_POST['email'];
    $password = $_POST['password'];
    $password2 = $_POST['password2'];
    $firstname = $_POST['firstname'];
    $surname = $_POST['surname'];
    $mobile_phone = $_POST['mobile_phone'];
    
    $errors = array();
    
    if(empty($email)) {
        $errors[] = "Please enter your email";
    }
    
    if(empty($firstname)) {
        $errors[] = "Please enter your firstname";
    }

    if(empty($surname)) {
        $errors[] = "Please enter your surname";
    }

    if(empty($mobile_phone)) {
        $errors[] = "Please enter your mobile phone";
    }

    if(empty($password) || empty($password2)) {
        $errors[] = "Please enter your password";
    }

    if($password!=$password2) {
        $errors[] = "Passwords dont match. Please enter same password";
    }
   

    if(empty($errors)) {
        $sql = "SELECT * FROM customers WHERE email='$email'";
        $result = $mysqli->query($sql);
        if ($result->num_rows == 1) {
            $errors[] = "This email already exist";
        } else {
            $sql = "INSERT INTO customers (firstname, surname, mobile_phone, email, password) VALUES ('$firstname', '$surname', '$mobile_phone', '$email', '$password')";
        
            if ($mysqli->query($sql) === TRUE) {
                echo "Kayıt başarıyla oluşturuldu.";
            } else {
                $errors[] = $mysqli->error;
            }
        }
    }
    
}


?> 
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

                <h2>Register</h2>
                <form action="" method="post">
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input value="<?=$email?>" name="email" type="email" class="form-control" id="email" placeholder="Enter your email">
                    </div>
                    <div class="form-group">
                        <label for="firstname">First name</label>
                        <input value="<?=$firstname?>" name="firstname" type="text" class="form-control" id="firstname" placeholder="Enter your first name">
                    </div>
                    <div class="form-group">
                        <label for="surname">Surname</label>
                        <input value="<?=$surname?>" name="surname" type="text" class="form-control" id="surname" placeholder="Enter your surname">
                    </div>
                    <div class="form-group">
                        <label for="mobile_phone">Mobile</label>
                        <input value="<?=$mobile_phone?>" name="mobile_phone" type="text" class="form-control" id="mobile_phone" placeholder="Enter your mobile number">
                    </div>
                    
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input value="<?=$password?>" name="password" type="password" class="form-control" id="password" placeholder="Enter your password">
                    </div>
                    <div class="form-group">
                        <label for="password2">Password Again</label>
                        <input value="<?=$password2?>" name="password2" type="password" class="form-control" id="password2" placeholder="Enter your password again">
                    </div>
                    <button type="submit" class="btn btn-primary btn-block">Register</button>
                </form>
            </div>
        </div>
    </div>
</section>
<?php include "footer.php"; ?>