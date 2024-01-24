<?php
session_start();
if (isset($_SESSION["user"])) {
   header("Location: company_dashboard.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Form</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link rel="stylesheet" href="login.css">
</head>
<body>
    <div class="login-container">
        <?php
        if (isset($_POST["login"])) {
           $compemail = $_POST["compemail"];
           $password = $_POST["password"];
            require_once "database.php";
            $sql = "SELECT * FROM company WHERE comp_email = '$compemail'";
            $result = mysqli_query($conn, $sql);
            $user = mysqli_fetch_array($result, MYSQLI_ASSOC);
            if ($user) {
                if (password_verify($password, $user["password"])) {
                    session_start();
                    $_SESSION["user"] = "yes";
                    header("Location: company_dashboard.php");
                    die();
                }else{
                    echo "<div class='alert alert-danger'>Password does not match</div>";
                }
            }else{
                echo "<div class='alert alert-danger'>Email does not match</div>";
            }
        }
        ?>
      <form action="login_comp.php" method="post">
        <div class="form-field">
            <input type="email" placeholder="Enter Company Email" name="compemail" class="form-control">
        </div>
        <div class="form-field">
            <input type="password" placeholder="Enter Password" name="password" class="form-control">
        </div>
        <div class="form-btn">
            <input type="submit" value="Login" name="login" class="btn btn-primary">
        </div>
      </form>
     <div><p>Not a KERA company yet?  <a href="registration_comp.php">Register Here</a></p></div>
    </div>
</body>
</html>