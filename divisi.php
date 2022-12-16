<?php
include('connection.php');

function getData(){
  $data = array();
  $data[1] = $_POST['IDDivisi'];
  $data[2] = $_POST['NamaDivisi'];
  $data[3] = $_POST['Bidang'];
  $data[4] = $_POST['IDKaryawanKepala'];
  return $data;
}
if(isset($_POST['insert'])){
  $info = getData();
  $insert = "INSERT INTO [Divisi] ([IDDivisi]
  ,[NamaDivisi]
  ,[Bidang],[IDKaryawanKepala]) VALUES ('$info[1]','$info[2]','$info[3]','$info[4]')";
  $stmt = sqlsrv_query($conn,$insert);
}

if(isset($_POST['clear'])){
  $info = getData();
  $clear = "TRUNCATE [Divisi] ([IDDivisi]
  ,[NamaDivisi]
  ,[Bidang],[IDKaryawanKepala]) VALUES ('$info[1]','$info[2]','$info[3]','$info[4]')";
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
  <link rel="stylesheet" href="style/divisi.css">
  <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.1/dist/jquery.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
<?php
include('navbar1.php');
?>
  <!-- Divisi -->
  <div class="bodi">
  <!-- <div class="d-flex justify-content-center">
    <div class="card" style="width: 33rem;"> -->
    <div class="jumbotron">
    <h2>Tambahkan Divisi</h2>
      <form method = "POST">
        <div class="form-group row">
          <label for="colFormLabelSm" class="col-sm-3 col-form-label col-form-label-sm">ID Divisi</label>
          <div class="col-sm-9">
            <input type="text" class="form-control form-control-sm" id="IDDivisi" name="IDDivisi">
          </div>
        </div>
        <div class="form-group row">
          <label for="colFormLabelSm" class="col-sm-3 col-form-label col-form-label-sm">Nama Divisi</label>
          <div class="col-sm-9">
            <input type="text" class="form-control form-control-sm" id="NamaDivisi" name="NamaDivisi">
          </div>
        </div>
        <div class="form-group row">
          <label for="colFormLabelSm" class="col-sm-3 col-form-label col-form-label-sm">Bidang</label>
          <div class="col-sm-9">
            <input type="text" class="form-control form-control-sm" id="Bidang" name="Bidang">
          </div>
        </div>

      <div class="form-group row">
        <label for="IDKaryawanKepala" class="col-sm-3 col-form-label col-form-label-sm"> ID Kepala Divisi: </label>
        <div class="col-sm-9">
        <select id="IDKaryawanKepala" class="form-control form-control-sm" name="IDKaryawanKepala">
        autocomplete="off">
        <option selected=" "disabled="">Select ID Kadiv</option>

        <?php
        $sql = "SELECT distinct IDKaryawan, Nama
        FROM Karyawan WHERE Deleted=0 ORDER BY IDKaryawan asc ";

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
        <!-- <div class="form-group row">
          <label for="colFormLabelSm" class="col-sm-3 col-form-label col-form-label-sm">ID Kepala Karyawan</label>
          <div class="col-sm-9">
            <input type="text" class="form-control form-control-sm" id="IDKaryawanKepala" name="IDKaryawanKepala">
          </div>
        </div> -->
        <button type="submit" class="btn btn-primary" id="insert" name="insert">Input</button>
        <button type="submit" class="btn btn-primary" id="clear" name="clear">Clear</button>
      </form>
      </div>
      <!-- </div>
  </div> -->

 <!-- Tabel nampilin daftar divisi -->
 <table class="table table-striped">
    <thead>
      <tr>
      <th scope="col">No</th>
        <th scope="col">ID Divisi</th>
        <th scope="col">Nama Divisi</th>
        <th scope="col">Bidang</th>
        <th scope="col">ID Kepala Divisi</th>
        <th scope="col">Aksi</th>
      </tr>
    </thead>
    <tbody>
    <?php
    include('connection.php');

// untuk delete(update) data
if(isset($_GET['IDDivisi'])){
  $IDDivisi=$_GET['IDDivisi'];
  $del = "UPDATE Divisi SET Deleted=1 WHERE IDDivisi='$IDDivisi'";
  $stmt = sqlsrv_query($conn,$del);
}

// untuk nampilin data karyawan
$no=1;
$params = array();
$options = array("Scrollable" => SQLSRV_CURSOR_KEYSET);
$stmt = sqlsrv_query($conn,"SELECT * from Divisi WHERE Deleted=0", $params, $options);

$num = sqlsrv_num_rows($stmt);
if($num>0){
  while($tampil=sqlsrv_fetch_array($stmt,SQLSRV_FETCH_ASSOC)){

    echo "<tr>
      <td>".$no."</td>
      <td>".$tampil['IDDivisi']."</td>
      <td>".$tampil['NamaDivisi']."</td>
      <td>".$tampil['Bidang']."</td>
      <td>".$tampil['IDKaryawanKepala']."</td>
      <td>
        <a href='divisi.php?IDDivisi=".$tampil['IDDivisi']."' class='btn btn-primary'>Delete</a>
      </td>
      </tr>";
      $no++;

  }
}

sqlsrv_free_stmt($stmt);
sqlsrv_close($conn);

    // untuk nampilin data
    // $no=1;
    // $getDivisi = "SELECT * from [Divisi]";
    // $stmt = sqlsrv_query($conn,$getDivisi);

    // while($tampil = sqlsrv_fetch_array($stmt,SQLSRV_FETCH_ASSOC)){
    //     echo "<tr>
    //     <td>$no</td>
    //     <td>$tampil[IDDivisi]</td>
    //     <td>$tampil[NamaDivisi]</td>
    //     <td>$tampil[Bidang]</td>
    //     <td>$tampil[IDKaryawanKepala]</td>
    //     </tr>";
    //     $no++;
    // }
    // sqlsrv_free_stmt($stmt);
    // sqlsrv_close($conn);
    ?>
    </tbody>
  </table>
  </div>
</body>
</html>
