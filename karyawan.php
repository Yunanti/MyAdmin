<?php
include('connection.php');

function getData(){
  $data = array();
  $data[1] = $_POST['IDKaryawan'];
  $data[2] = $_POST['Nama'];
  $data[3] = $_POST['Alamat'];
  $data[4] = $_POST['TglLahir'];
  $data[5] = $_POST['IDDivisiDP'];
  $data[6] = $_POST['IDDivisi'];
  $data[7] = $_POST['IDSupervisor'];
  $data[8] = $_POST['IDKeahlian'];
  return $data;
}

// untuk insert data
if(isset($_POST['insert'])){
  $info = getData();
  $insert = "INSERT INTO [Karyawan] ([IDKaryawan]
  ,[Nama]
  ,[Alamat]
  ,[TglLahir]
  ,[IDDivisiDP]
  ,[IDDivisi]
  ,[IDSupervisor]
  ,[IDKeahlian]) VALUES ('$info[1]','$info[2]','$info[3]','$info[4]','$info[5]','$info[6]','$info[7]','$info[8]')"([datetime]);
  $stmt = sqlsrv_query($conn,$insert);
}

if(isset($_POST['clear'])){
  $info = getData();
  $clear = "TRUNCATE [Pangkat] ([IDProker]
  ,[IDDivisi]
  ,[TglPelaksanaan]) VALUES ('$info[1]','$info[2]','$info[3]')";
  $stmt = sqlsrv_query($conn,$clear);
}

?>
<?php
include('connection.php');

function getDataS(){
  $data = array();
  $data[1] = $_POST['IDKaryawan'];
  $data[2] = $_POST['IDSupervisor'];
  return $data;
}

// untuk insert data
if(isset($_POST['insertS'])){
  $info = getDataS();
  $insert = "UPDATE Karyawan SET IDSupervisor = '$info[2]' WHERE IDKaryawan = '$info[1]'";
  $stmt = sqlsrv_query($conn,$insertS);
}

if(isset($_POST['clearS'])){
    $info = getDataS();
    $clear = "TRUNCATE [Karyawan] ([IDKaryawan]
    ,[IDSupervisor]) VALUES ('$info[1]','$info[2]')";
    $stmt = sqlsrv_query($conn,$clearS);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>MyAdmin</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="style/karyawan.css">
  <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.1/dist/jquery.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
<?php
include('navbar1.php');
?>
  <!-- Karyawan -->
  <div class="bodi">
  <!-- <div class="d-flex justify-content-center">
    <div class="card" style="width: 33rem;"> -->
    <div class="jumbotron">
    <h2>Masukkan Identitas Karyawan</h2>
      <form method = "POST">
        <div class="form-group row">
          <label for="colFormLabelSm" class="col-sm-3 col-form-label col-form-label-sm">ID Karyawan</label>
          <div class="col-sm-9">
            <input type="text" class="form-control form-control-sm" id="IDKaryawan" name="IDKaryawan">
          </div>
        </div>
        <div class="form-group row">
          <label for="colFormLabelSm" class="col-sm-3 col-form-label col-form-label-sm">Nama</label>
          <div class="col-sm-9">
            <input type="text" class="form-control form-control-sm" id="Nama" name="Nama">
          </div>
        </div>
        <div class="form-group row">
          <label for="colFormLabelSm" class="col-sm-3 col-form-label col-form-label-sm">Alamat</label>
          <div class="col-sm-9">
            <input type="text" class="form-control form-control-sm" id="Alamat" name="Alamat">
          </div>
        </div>
        <div class="form-group row">
          <label for="colFormLabelSm" class="col-sm-3 col-form-label col-form-label-sm">Tanggal Lahir</label>
          <div class="col-sm-9">
            <input type="date" class="form-control form-control-sm" id="TglLahir" name="TglLahir">
          </div>
        </div>
        <div class="form-group row">
          <label for="colFormLabelSm" class="col-sm-3 col-form-label col-form-label-sm">ID Dewan Pengawas</label>
          <div class="col-sm-9">
            <input type="text" class="form-control form-control-sm" id="IDDivisiDP" name="IDDivisiDP">
          </div>
        </div>
        <div class="form-group row">
          <label for="colFormLabelSm" class="col-sm-3 col-form-label col-form-label-sm">ID Divisi</label>
          <div class="col-sm-9">
            <input type="text" class="form-control form-control-sm" id="IDDivisi" name="IDDivisi">
          </div>
        </div>
        <div class="form-group row">
          <label for="colFormLabelSm" class="col-sm-3 col-form-label col-form-label-sm">ID Supervisor</label>
          <div class="col-sm-9">
            <input type="text" class="form-control form-control-sm" id="IDSupervisor" name="IDSupervisor">
          </div>
        </div>
        <div class="form-group row">
          <label for="colFormLabelSm" class="col-sm-3 col-form-label col-form-label-sm">ID Keahlian</label>
          <div class="col-sm-9">
            <input type="text" class="form-control form-control-sm" id="IDKeahlian" name="IDKeahlian">
          </div>
        </div>
        <button type="submit" class="btn btn-primary" id="insert" name="insert">Input</button>
        <button type="submit" class="btn btn-primary" id="clear" name="clear">Clear</button>
      </form>
      </div>
      <!-- </div>
  </div> -->

  <!-- Tabel nampilin daftar tabel karyawan -->
  <table class="table table-striped">
    <thead>
      <tr>
      <th scope="col">No</th>
        <th scope="col">ID Karyawan</th>
        <th scope="col">Nama Karyawan</th>
        <th scope="col">Alamat</th>
        <th scope="col">Tanggal Lahir</th>
        <th scope="col">ID Dewan Pengawas</th>
        <th scope="col">ID Divisi</th>
        <th scope="col">ID Supervisor</th>
        <th scope="col">ID Keahlian</th>
      </tr>
    </thead>
    <tbody>
    <?php
    include('connection.php');
    // untuk nampilin data karyawan
    $no=1;
    $getKaryawan = "SELECT * from [Karyawan]";
    $stmt = sqlsrv_query($conn,$getKaryawan);

    while($tampil = sqlsrv_fetch_array($stmt,SQLSRV_FETCH_ASSOC)){
        echo "<tr>
        <td>$no</td>
        <td>$tampil[IDKaryawan]</td>
        <td>$tampil[Nama]</td>
        <td>$tampil[Alamat]</td>
        <td>$tampil[TglLahir]</td>
        <td>$tampil[IDDivisiDP]</td>
        <td>$tampil[IDDivisi]</td>
        <td>$tampil[IDSupervisor]</td>
        <td>$tampil[IDKeahlian]</td>
        </tr>";
        $no++;
    }
    sqlsrv_free_stmt($stmt);
    sqlsrv_close($conn);
    ?>
    </tbody>
  </table>
  


  <!-- Supervisor -->
  <div class="d-flex justify-content-center">
    <div class="card" style="width: 33rem;">
    <div class="jumbotron">
    <h2>Plotting Supervisor</h2>

    <form action=" "method="POST">
      <?php
      include ('connection.php');

      ?>

      <br>
      <br>

      <div class="row">
        <label for="IDKaryawan"> ID Karyawan: </label>

        <select id="IDKaryawan" class="form-control" name="IDKaryawan" style="width: 200px;">
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

      <!-- <form method = "POST">
        <div class="form-group row">
          <label for="colFormLabelSm" class="col-sm-3 col-form-label col-form-label-sm">ID Karyawan</label>
          <div class="col-sm-9">
            <input type="text" class="form-control form-control-sm" id="IDKaryawan" name="IDKaryawan">
          </div>
        </div> -->
        <!-- <div class="form-group row">
          <label for="colFormLabelSm" class="col-sm-3 col-form-label col-form-label-sm">ID Supervisor</label>
          <div class="col-sm-9">
            <input type="text" class="form-control form-control-sm" id="IDSupervisor" name="IDSupervisor">
          </div>
        </div> -->
      <?php
      include ('connection.php');

      ?>

      <br>
      <br>

      <div class="row">
        <label for="IDSupervisor"> ID Supervisor: </label>

        <select id="IDSupervisor" class="form-control" name="IDSupervisor" style="width: 200px;">
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
        <button type="submit" class="btn btn-primary" id="insertS" name="insert">Input</button>
        <button type="submit" class="btn btn-primary" id="clearS" name="clear">Clear</button>
      </form>
      </div>
      </div>
  </div>

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
