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
  $data[7] = $_POST['IDKeahlian'];
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
  ,[IDKeahlian]) VALUES ('$info[1]','$info[2]','$info[3]','$info[4]','$info[5]','$info[6]','$info[7]')";
  $stmt = sqlsrv_query($conn,$insert);
}
// untuk clear data
if(isset($_POST['clear'])){
  $info = getData();
  $clear = "TRUNCATE [Karyawan] ([IDKaryawan]
  ,[Nama]
  ,[Alamat]
  ,[TglLahir]
  ,[IDDivisiDP]
  ,[IDDivisi]
  ,[IDKeahlian]) VALUES ('$info[1]','$info[2]','$info[3]','$info[4]','$info[5]','$info[6]','$info[7]')";
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
        <?php
      include ('connection.php');

      ?>

      <div class="form-group row">
        <label for="IDDivisiDP" class="col-sm-3 col-form-label col-form-label-sm"> ID Dewan Pengawas</label>
        <div class="col-sm-9">
        <select id="IDDivisiDP" class="form-control form-control-sm" name="IDDivisiDP">
        autocomplete="off">
        <option selected=" "disabled="">Select ID Dewan Pengawas</option>

        <?php
        $sql = "SELECT distinct IDDivisi, NamaDivisi
        FROM Divisi WHERE Deleted=0 ORDER BY IDDivisi asc";

        $params = array();
        $options = array("Scrollable" => SQLSRV_CURSOR_KEYSET );

        $stmt = sqlsrv_query( $conn, $sql, $params, $options );

        if(sqlsrv_num_rows($stmt) > 0) {
          while($row=sqlsrv_fetch_array($stmt)) {
            echo "<option value= '", $row['IDDivisi'],"'>",$row['IDDivisi']," | ",$row['NamaDivisi'],"</option>";
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
        <label for="IDDivisi" class="col-sm-3 col-form-label col-form-label-sm"> ID Divisi </label>
        <div class="col-sm-9">
        <select id="IDDivisi" class="form-control form-control-sm" name="IDDivisi">
        autocomplete="off">
        <option selected=" "disabled="">Select ID Divisi</option>

        <?php
        $sql = "SELECT distinct IDDivisi, NamaDivisi
        FROM Divisi WHERE Deleted=0 ORDER BY IDDivisi asc ";

        $params = array();
        $options = array("Scrollable" => SQLSRV_CURSOR_KEYSET );

        $stmt = sqlsrv_query( $conn, $sql, $params, $options );

        if(sqlsrv_num_rows($stmt) > 0) {
          while($row=sqlsrv_fetch_array($stmt)) {
            echo "<option value= '", $row['IDDivisi'],"'>",$row['IDDivisi']," | ",$row['NamaDivisi'],"</option>";
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
        <label for="IDKeahlian" class="col-sm-3 col-form-label col-form-label-sm"> ID Keahlian </label>
        <div class="col-sm-9">
        <select id="IDKeahlian" class="form-control form-control-sm" name="IDKeahlian">
        autocomplete="off">
        <option selected=" "disabled="">Select ID Keahlian</option>

        <?php
        $sql = "SELECT distinct IDKeahlian, NamaKeahlian
        FROM Keahlian WHERE Deleted=0 ORDER BY IDKeahlian asc ";

        $params = array();
        $options = array("Scrollable" => SQLSRV_CURSOR_KEYSET );

        $stmt = sqlsrv_query( $conn, $sql, $params, $options );

        if(sqlsrv_num_rows($stmt) > 0) {
          while($row=sqlsrv_fetch_array($stmt)) {
            echo "<option value= '", $row['IDKeahlian'],"'>",$row['IDKeahlian']," | ",$row['NamaKeahlian'],"</option>";
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
      </div>
      </div>
  


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
        <th scope="col">ID Keahlian</th>
        <th scope="col">Aksi</th>
      </tr>
    </thead>
    <tbody>
    <?php
    include('connection.php');
    // untuk delete(update) data
    if(isset($_GET['IDKaryawan'])){
      $IDKaryawan=$_GET['IDKaryawan'];
      $del = "UPDATE Karyawan SET Deleted=1 WHERE IDKaryawan='$IDKaryawan'";
      $stmt = sqlsrv_query($conn,$del);
    }

    // untuk nampilin data karyawan
    $no=1;
    $params = array();
    $options = array("Scrollable" => SQLSRV_CURSOR_KEYSET);
    $stmt = sqlsrv_query($conn,"SELECT * from Karyawan WHERE Deleted=0", $params, $options);

    $num = sqlsrv_num_rows($stmt);
    if($num>0){
      while($tampil=sqlsrv_fetch_array($stmt,SQLSRV_FETCH_ASSOC)){

        echo "<tr>
          <td>".$no."</td>
          <td>".$tampil['IDKaryawan']."</td>
          <td>".$tampil['Nama']."</td>
          <td>".$tampil['Alamat']."</td>
          <td>".$tampil['TglLahir']."</td>
          <td>".$tampil['IDDivisiDP']."</td>
          <td>".$tampil['IDDivisi']."</td>
          <td>".$tampil['IDKeahlian']."</td>
          <td>
            <a href='karyawan1.php?IDKaryawan=".$tampil['IDKaryawan']."' class='btn btn-primary'>Delete</a>
          </td>
          </tr>";
          $no++;
  
      }
    }

    sqlsrv_free_stmt($stmt);
    sqlsrv_close($conn);
    ?>
    </tbody>
  </table>
  </div>
</body>
</html>
