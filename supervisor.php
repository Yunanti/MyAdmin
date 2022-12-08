<?php
include('connection.php');

function getData(){
  $data = array();
  $data[1] = $_POST['IDKaryawan'];
  $data[2] = $_POST['IDSupervisor'];
  return $data;
}

// untuk insert data
if(isset($_POST['insert'])){
  $info = getData();
  $insert = "UPDATE Karyawan SET IDSupervisor = '$info[2]' WHERE IDKaryawan = '$info[1]'";
  $stmt = sqlsrv_query($conn,$insert);
}

if(isset($_POST['clear'])){
    $info = getData();
    $clear = "TRUNCATE [Karyawan] ([IDKaryawan]
    ,[IDSupervisor]) VALUES ('$info[1]','$info[2]')";
    $stmt = sqlsrv_query($conn,$clear);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>MyAdmin</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="style/supervisor.css">
  <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.1/dist/jquery.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
<?php
include('navbar1.php');
?>
<div class="bodi">
  <!-- Supervisor -->
  <!-- <div class="d-flex justify-content-center">
    <div class="card" style="width: 33rem;"> -->
    <div class="jumbotron">
    <h2>Plotting Supervisor</h2>

    <form action=" "method="POST">
      <?php
      include ('connection.php');

      ?>

      <div class="form-group row">
        <label for="IDKaryawan" class="col-sm-3 col-form-label col-form-label-sm"> ID Karyawan: </label>
        <div class="col-sm-9">
        <select id="IDKaryawan" class="form-control form-control-sm" name="IDKaryawan" >
          autocomplete="off">
          <option selected=" "disabled="">Select ID Karyawan</option>

          <?php
          $sql = "SELECT distinct IDKaryawan, Nama
          FROM Karyawan ORDER BY IDKaryawan asc ";

          $params = array();
          $options = array("Scrollable" => SQLSRV_CURSOR_KEYSET );

          $stmt = sqlsrv_query( $conn, $sql, $params, $options );

          if(sqlsrv_num_rows($stmt) > 0) {
            while($row=sqlsrv_fetch_array($stmt)) {
              echo "<option value= '", $row['IDKaryawan'],"'>",$row['IDKaryawan']," | ",$row['Nama'],"</option>";
            }
          }
          ?>
        </select>
        </div>
      </div>
      <?php
      include ('connection.php');

      ?>

      <div class="form-group row">
        <label for="IDSupervisor" class="col-sm-3 col-form-label col-form-label-sm"> ID Supervisor: </label>
        <div class="col-sm-9">
        <select id="IDSupervisor" class="form-control form-control-sm" name="IDSupervisor">
          autocomplete="off">
          <option selected=" "disabled="">Select ID Supervisor</option>

          <?php
          $sql = "SELECT distinct IDKaryawan, Nama
          FROM Karyawan ORDER BY IDKaryawan asc ";

          $params = array();
          $options = array("Scrollable" => SQLSRV_CURSOR_KEYSET );

          $stmt = sqlsrv_query( $conn, $sql, $params, $options );

          if(sqlsrv_num_rows($stmt) > 0) {
            while($row=sqlsrv_fetch_array($stmt)) {
              echo "<option value= '", $row['IDKaryawan'],"'>",$row['IDKaryawan']," | ",$row['Nama'],"</option>";
            }
          }
          ?>
        </select>
        </div>
      </div>
        <button type="submit" class="btn btn-primary" id="insert" name="insert">Input</button>
        <button type="submit" class="btn btn-primary" id="clear" name="clear">Clear</button>
      </form>
      </div>
      <!-- </div>
  </div> -->

  <!-- Tabel nampilin daftar supervisor -->
  <table class="table table-striped">
    <thead>
      <tr>
      <th scope="col">No</th>
        <th scope="col">ID Karyawan</th>
        <th scope="col">Nama Karyawan</th>
        <th scope="col">ID Supervisor</th>
      </tr>
    </thead>
    <tbody>
    <?php
    include('connection.php');
    // untuk nampilin data
    $no=1;
    $getSupervisor = "SELECT * from [Karyawan]";
    $stmt = sqlsrv_query($conn,$getSupervisor);

    while($tampil = sqlsrv_fetch_array($stmt,SQLSRV_FETCH_ASSOC)){
        echo "<tr>
        <td>$no</td>
        <td>$tampil[IDKaryawan]</td>
        <td>$tampil[Nama]</td>
        <td>$tampil[IDSupervisor]</td>
        </tr>";
        $no++;
    }
    sqlsrv_free_stmt($stmt);
    sqlsrv_close($conn);
    ?>
    </tbody>
  </table>
  </div>
</body>
</html>
