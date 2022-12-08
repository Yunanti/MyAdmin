<?php
// include('connection.php');

// function getData(){
//   $data = array();
//   $data[1] = $_POST['IDDivisi'];
//   $data[2] = $_POST['NamaDivisi'];
//   $data[3] = $_POST['Bidang'];
//   $data[4] = $_POST['IDKaryawanKepala'];
//   return $data;
// }
// if(isset($_POST['insert'])){
//   $info = getData();
//   $insert = "INSERT INTO [Divisi] ([IDDivisi]
//   ,[NamaDivisi]
//   ,[Bidang],[IDKaryawanKepala]) VALUES ('$info[1]','$info[2]','$info[3]','$info[4]')";
//   $stmt = sqlsrv_query($conn,$insert);
// }

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>MyAdmin</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="style/home.css">
</head>
<body>
<?php
include('navbar1.php');
?>
  <!-- Divisi -->
  <div class="bodi">
  <div class="row push">
                <div class="d-md-none mx-auto">
                    <div class="col-md py-10">
                        <div class="pic-container pic-medium pic-circle profile-pic mx-auto">
                          <img src="img/user.png" alt="User Profile" class="img-avatar img-avatar96" id="imgProfilePic">
                        </div>
                    </div>
                    <h2 class="text-white mb-0 text-center">
                        <span class="font-w300 d-md-inline-block" style="color: #013880;">Selamat Datang<br><strong>Tim Admin</strong> </span>
                    </h2>
                </div>
                <div class="d-none d-md-block pad">
                    <div class="col-md py-10 d-md-flex align-items-md-center">
                        <div class="pic-container pic-medium pic-circle profile-pic mr-picture">
                          <img src="img/user.png" alt="User Profile" class="img-avatar img-avatar96" id="imgProfilePic">
                        </div>
                        <h2 class="text-white mb-0 text-center">
                            <span class="font-w300 d-md-inline-block" style="color: #013880;">Selamat Datang<br><strong>Tim Admin</strong> </span>
                        </h2>
                    </div>
                </div>
                <div class="row">
                        <div class="col-md-12">
                            <div class="block mb-0 pad">
                                <div class="block-content pb-20" style="color: #013880">
                                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse odio turpis, volutpat ac ullamcorper ut, auctor eu erat. Etiam hendrerit vestibulum nulla, eu porta magna tristique ut. In nec dolor ut sem volutpat fermentum. Sed aliquet tellus lacinia diam congue, quis gravida magna ultrices. Pellentesque lectus arcu, aliquam quis commodo ac, ullamcorper at eros. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Phasellus efficitur, eros sit amet scelerisque dapibus, erat ex aliquam ligula, finibus egestas dolor nisl condimentum leo. Aliquam maximus dolor id nulla lobortis ullamcorper. Donec quis purus gravida, ultricies dui ut, faucibus lorem. In viverra facilisis consectetur. Donec rutrum, arcu id ultrices mattis, ipsum purus commodo nibh, id dictum sem ex vitae ante. Nunc congue blandit ornare. Sed ipsum nisl, vestibulum in imperdiet et, pretium in tellus. Phasellus rutrum ex lorem, lacinia maximus justo blandit ac.
                                </div>
                            </div>
                        </div>
                    </div>
            </div>
  </div>
</body>
</html>
