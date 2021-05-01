<?php
// checking for minimum PHP version
if (version_compare(PHP_VERSION, '5.3.7', '<')) {
    exit("Sorry, Simple PHP Login does not run on a PHP version smaller than 5.3.7 !");
} else if (version_compare(PHP_VERSION, '5.5.0', '<')) {
    // if you are using PHP 5.3 or PHP 5.4 you have to include the password_api_compatibility_library.php
    // (this library adds the PHP 5.5 password hashing functions to older versions of PHP)
    require_once("libraries/password_compatibility_library.php");
}

// include the configs / constants for the database connection
require_once("config/db.php");

// load the login class
require_once("classes/Login.php");

// create a login object. when this object is created, it will do all login/logout stuff automatically
// so this single line handles the entire login process. in consequence, you can simply ...
$login = new Login();

// ... ask if we are logged in here:
if ($login->isUserLoggedIn() == true) {
    // the user is logged in. you can do whatever you want here.
    // for demonstration purposes, we simply show the "you are logged in" view.
   header("location: dashboard.php");

} else {
    // the user is not logged in. you can do whatever you want here.
    // for demonstration purposes, we simply show the "you are not logged in" view.
    ?>

<!DOCTYPE html>
<html lang="es">
<head>
  <?php include("head.php");?>
</head>

<body class="bg-gradient-primary">

  <div class="container">

    <!-- Outer Row -->
    <div class="row justify-content-center">

      <div class="col-xl-10 col-lg-12 col-md-9">

        <div class="card o-hidden border-0 shadow-lg my-5">
          <div class="card-body p-0">
              <!-- Nested Row within Card Body -->
            <div class="row">
              <div class="col-lg-6 d-none d-lg-block bg-login-image">
                 <!-- Nested Row within Card Body 
                <img id="profile-img" class="profile-img-card" src="https://scontent-bog1-1.xx.fbcdn.net/v/t1.6435-9/152373363_100999885382534_4115499192360162034_n.jpg?_nc_cat=109&ccb=1-3&_nc_sid=09cbfe&_nc_eui2=AeF9o602aWtFqMERf0cB77exDpCrWX6uU6sOkKtZfq5Tq2sQ_Svhk3sg6TRNon0TYH6VsAGHwK9VBWmCiYOjqyB8&_nc_ohc=d5vlGPoXdaoAX9VNEhV&_nc_ht=scontent-bog1-1.xx&oh=eef6c352b5c28dfc0409f75570a3c321&oe=60B207FA" width="460" />
                -->
              </div>
              <div class="col-lg-6">
                <div class="p-5">
                <div class="text-center">
                  <h1 class="h4 text-gray-900 mb-4">Welcome Back!</h1>
                </div>
                <form method="post" accept-charset="utf-8" action="login.php" name="loginform" autocomplete="off" role="form" class="form-signin">
                  <?php
                    // show potential errors / feedback (from login object)
                    if (isset($login)) {
                      if ($login->errors) {
                        ?>
                        <div class="alert alert-danger alert-dismissible" role="alert">
                            <strong>Error!</strong> 
                        
                        <?php 
                        foreach ($login->errors as $error) {
                          echo $error;
                        }
                        ?>
                        </div>
                        <?php
                      }
                      if ($login->messages) {
                        ?>
                        <div class="alert alert-success alert-dismissible" role="alert">
                            <strong>Aviso!</strong>
                        <?php
                        foreach ($login->messages as $message) {
                          echo $message;
                        }
                        ?>
                        </div> 
                        <?php 
                      }
                    }
                  ?>
                  <div class="form-group">
                      <input type="text" class="form-control form-control-user"
                          id="user_name" name="user_name" aria-describedby="user_name"
                          placeholder="Usuario" required>
                  </div>
                  <div class="form-group">
                      <input type="password" class="form-control form-control-user"
                          id="user_password" name="user_password" placeholder="Password">
                  </div>
                  <button type="submit" class="btn btn-primary btn-user btn-block" name="login" id="submit">Iniciar Sesión</button>
                </form>
                <hr>
                <div class="text-center">
                    <a class="small" href="forgot-password.html">Forgot Password?</a>
                </div>
                <div class="text-center">
                    <a class="small" href="register.html">Create an Account!</a>
                </div>
                <?php
                  include("footer.php");
                ?>
                </div>
              </div>
            </div>
          </div>
        </div>

      </div>

    </div>

  </div>

	<!-- Bootstrap core JavaScript-->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="js/sb-admin-2.min.js"></script>
</body>
</html>

	<?php
}


