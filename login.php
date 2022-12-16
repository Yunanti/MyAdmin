<?php
include('connection.php');

function getData(){
  $data = array();
  $data[1] = $_POST['name'];
  $data[2] = $_POST['pass'];
  return $data;
}

if(isset($_POST['login'])){
  $info = getData();
  $params = array();
  $options = array("Scrollable" => SQLSRV_CURSOR_KEYSET);
  $login = sqlsrv_query($conn,"SELECT * FROM [Karyawan] WHERE ([IDKaryawan])='$info[2]'", $params, $options);
  $ketemu = sqlsrv_num_rows($login);
  // echo "<script>console.log($login, 'login');</script>";
  // echo "<script>console.log($ketemu, 'ketemu');</script>";
  if($ketemu === 0){
    echo "<script>alert('Username atau Password salah!');</script>";
  }
  else if ($ketemu === 1) {
    header('Location: http://localhost/MyAdmin/home.php');
    exit;
  }

} 


?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>MyAdmin</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="style/login.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
  <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.1/dist/jquery.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
<!-- <div class="bodilogin "> -->
  <!-- Login -->
  <div class="bodilogin wrapper d-flex justify-content-center">
    <div class="box">
    <img src="https://my.its.ac.id/assets/media/img/logo.png" alt="Logo ITS" class="logo">
    <img src="img/logo.png" alt="Logo myAdmin" class="logo myAdmin">
      <!-- <div class="text-center"> -->
        <!-- <h1>Welcome to myAdmin</h1> -->
        <form method = "POST" class="sign-in">
          <div class="inputbox">
            <label for>Username</label>
            <input type="text" class="filled" id="name" name="name" aria-describedby="nameHelp">
            </div>
          <div class="inputbox">
            <label for="exampleInputPassword1">Password</label>
            <input type="password" class="filled" id="pass" name="pass">
          </div>
          <button type="submit" class="klik" id="login" name="login">Sign in</button>
        </form>
      </div>
    </div>
  </div>
<!-- </div> -->
</body>
</html>
