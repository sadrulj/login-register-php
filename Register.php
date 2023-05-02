<?php

$conn = new mysqli('localhost', 'root', '', 'login-register');
if (!$conn) {
    echo "Not Connected";
}

$empmsg_firstName = $empmsg_lastName = $empmsg_email = $empmsg_password = $empmsg_password_again = "";
if (isset($_POST['submit'])) {
    $user_first_name = $_POST['user_first_name'];
    $user_last_name = $_POST['user_last_name'];
    $user_email = $_POST['user_email'];
    $user_password = $_POST['user_password'];
    $user_password_again = $_POST['user_password_again'];

    $md5_user_password = md5($user_password);

    if (empty($user_first_name)) {
        $empmsg_firstName = "Fill up this field";
    }
    if (empty($user_last_name)) {
        $empmsg_lastName = "Fill up this field";
    }
    if (empty($user_email)) {
        $empmsg_email = "Fill up this field";
    }
    if (empty($user_password)) {
        $empmsg_password = "Fill up this field";
    }
    if (empty($user_password_again)) {
        $empmsg_password_again = "Fill up this field";
    }

    if (!empty($user_first_name) && !empty($user_last_name) && !empty($user_email) && !empty($user_password) && !empty($user_password_again)) {
        if ($user_password === $user_password_again) {

            $sql = "INSERT INTO users(user_first_name,user_last_name,user_email,user_password) VALUES('$user_first_name','$user_last_name','$user_email','$md5_user_password')";

            if ($conn->query($sql)) {
                header('location:Login.php?usercreated');
            }

        } else {
            echo "password not matched";
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
    <title>Register</title>
</head>
<body>
    <h2 class="text-center mt-3">Register</h2>
    <div class="container">
        <div class="row">
            <div class="col-4"></div>
            <div class="col-4 mt-3 shadow-lg p-5 mb-5 bg-body-tertiary rounded">
                <form action="Register.php" method="POST">
  <div class="mb-3">
    <label for="exampleInputFirstName" class="form-label">First Name</label>
    <input type="text" class="form-control" name="user_first_name" id="exampleInputFirstName" aria-describedby="emailHelp" value="<?php if (isset($_POST['submit'])) {echo $user_first_name;}?>">
    <div id="emailHelp" class="form-text"><?php if (isset($_POST['submit'])) {echo "<span class='text-danger'>" . $empmsg_firstName . "</span>";}?>
    </div>
  </div>
  <div class="mb-3">
    <label for="exampleInputLastName" class="form-label">Last Name</label>
    <input type="text" class="form-control" name="user_last_name" id="exampleInputLastName" aria-describedby="emailHelp" value="<?php if (isset($_POST['submit'])) {echo $user_last_name;}?>">
    <div id="emailHelp" class="form-text"><?php if (isset($_POST['submit'])) {echo "<span class='text-danger'>" . $empmsg_lastName . "</span>";}?></div>
  </div>
  <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label">Email address</label>
    <input type="email" class="form-control" name="user_email" id="exampleInputEmail1" aria-describedby="emailHelp" value="<?php if (isset($_POST['submit'])) {echo $user_email;}?>">
    <div id="emailHelp" class="form-text"><?php if (isset($_POST['submit'])) {echo "<span class='text-danger'>" . $empmsg_email . "</span>";}?></div>
  </div>
  <div class="mb-3">
    <label for="exampleInputPassword1" class="form-label">Password</label>
    <input type="password" class="form-control" name="user_password" id="exampleInputPassword1" value="<?php if (isset($_POST['submit'])) {echo $user_password;}?>">
    <div id="emailHelp" class="form-text"><?php if (isset($_POST['submit'])) {echo "<span class='text-danger'>" . $empmsg_password . "</span>";}?></div>
  </div>
  <div class="mb-3">
    <label for="exampleInputRePassword" class="form-label">Password Again</label>
    <input type="password" class="form-control" name="user_password_again" id="exampleInputRePassword" value="<?php if (isset($_POST['submit'])) {echo $user_password_again;}?>">
    <div id="emailHelp" class="form-text"><?php if (isset($_POST['submit'])) {echo "<span class='text-danger'>" . $empmsg_password_again . "</span>";}?></div>
  </div>
  <button type="submit" class="btn btn-primary" name="submit">Submit</button>
</form>
<h5 class="mt-5">Already Registered? <a href="Login.php">Login</a></h5>
            </div>
            <div class="col-4"></div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
</body>
</html>
