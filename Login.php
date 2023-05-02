<?php

session_start();

$conn = new mysqli('localhost', 'root', '', 'login-register');
if (!$conn) {
    echo "Not Connected";
}

$empty_email = $empty_password = '';

if (isset($_POST['submit'])) {
    $user_email = $_POST['user_email'];
    $user_password = $_POST['user_password'];

    $md5_user_password = md5($user_password);

    if (empty($user_email)) {
        $empty_email = "Fill up this field";
    }
    if (empty($user_password)) {
        $empty_password = "Fill up this field";
    }

    if (!empty($user_email) && !empty($user_password)) {
        $sql = "SELECT * FROM users WHERE user_email = '$user_email' AND user_password = '$md5_user_password'";
        $query = $conn->query($sql);
        if ($query->num_rows > 0) {
            $_SESSION['login'] = '';
            header("location:Home.php");
        } else {
            echo "not found";
        }
    }

}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <title>Login</title>
</head>
<body>
    <h2 class="text-center mt-5">Login</h2>
    <div class="container">
        <div class="row">
            <div class="col-4"></div>
            <div class="col-4 mt-3 shadow-lg p-5 mb-5 bg-body-tertiary rounded">
                <div class="position-absolute top-50 start-50 translate-middle" role="alert">
                        <?php
if (isset($_GET['usercreated'])) {
    echo "<div class='alert alert-success'>" . "User Create Successfully" . "</div>";
}
?>
                </div>
<form action='Login.php' method='POST'>

  <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label">Email address</label>
    <input type="email" class="form-control" name="user_email" id="exampleInputEmail1" aria-describedby="emailHelp" value="<?php if (isset($_POST['submit'])) {echo $user_email;}?>">
    <div id="emailHelp" class="form-text"><?php if (isset($_POST['submit'])) {echo "<span class='text-danger'>" . $empty_email . "</span>";}?></div>
  </div>
  <div class="mb-3">
    <label for="exampleInputPassword1" class="form-label">Password</label>
    <input type="password" class="form-control" name="user_password" id="exampleInputPassword1" value="<?php if (isset($_POST['submit'])) {echo $user_password;}?>">
    <div id="emailHelp" class="form-text"><?php if (isset($_POST['submit'])) {echo "<span class='text-danger'>" . $empty_password . "</span>";}?></div>
  </div>

  <button type="submit" class="btn btn-primary" name="submit">Submit</button>
</form>
<h5 class="mt-5">Not have Account? <a href="Register.php">Registered</a></h5>
            </div>
            <div class="col-4"></div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
</body>
</html>
