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
    <title>KERA - Company Registration</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <?php
        if (isset($_POST["submit"])) {
           $compname = $_POST["compname"];
           $compemail = $_POST["compemail"];
           $compcr = $_POST["compcr"];
           $password = $_POST["password"];
           $passwordRepeat = $_POST["repeat_password"];
           
           $passwordHash = password_hash($password, PASSWORD_DEFAULT);

           $errors = array();
           
           if (empty($compname) OR empty($compcr) OR empty($password) OR empty($passwordRepeat)) {
            array_push($errors,"All fields are required");
           }
           if (!filter_var($compemail, FILTER_VALIDATE_EMAIL)) {
            array_push($errors, "Email is not valid");
           }
           if (strlen($password)<8) {
            array_push($errors,"Password must be at least 8 charactes long");
           }
           if (strlen($compcr)<5) {
            array_push($errors,"Company CR must be at least 6 charactes long");
           }
           if ($password!==$passwordRepeat) {
            array_push($errors,"Password does not match");
           }
           require_once "database.php";
           $sql = "SELECT * FROM cust WHERE Cust_Email = '$compemail'";
           $result = mysqli_query($conn, $sql);
           $rowCount = mysqli_num_rows($result);
           if ($rowCount>0) {
            array_push($errors,"Email already exists!");
           }
           if (count($errors)>0) {
            foreach ($errors as  $error) {
                echo "<div class='alert alert-danger'>$error</div>";
            }
           }else{
            
            $sql = "INSERT INTO company (comp_name, comp_email, comp_cr, password) VALUES ( ?, ?,?, ? )";
            $stmt = mysqli_stmt_init($conn);
            $prepareStmt = mysqli_stmt_prepare($stmt,$sql);
            if ($prepareStmt) {
                mysqli_stmt_bind_param($stmt,"ssss",$compname, $compemail, $compcr, $passwordHash);
                mysqli_stmt_execute($stmt);
                echo "<div class='alert alert-success'>You are registered successfully.</div>";
            }else{
                die("Something went wrong");
            }
           }
        }
        ?>
        <section id="login-details">
        <form action="registration_comp.php" method="post">
            <div class="fill">
                <input type="text" class="form-control" name="compname" placeholder="Registered Company Name">
            </div>
            <div class="form-group">
                <input type="email" class="form-control" name="compemail" placeholder="Company Contact Email">
            </div>
            <div class="form-group">
                <input type="text" class="form-control" name="compcr" placeholder="Company CR Code">
            </div>
            <div class="form-group">
                <input type="password" class="form-control" name="password" placeholder="Password">
            </div>
            <div class="form-group">
                <input type="password" class="form-control" name="repeat_password" placeholder="Repeat Password">
            </div>
            <div class="bt">
                <input type="submit" class="normal" value="Register" name="submit">
            </div>
    </form>
        <div>
        <div><p>Already a registered Kera company? <a href="login_comp.php">Login Here</a></p></div>
      </div>
    </section>
    </div>
</body>
</html>