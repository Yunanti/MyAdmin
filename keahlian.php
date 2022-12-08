<?php
include('connection.php');

function getData(){
  $data = array();
  $data[1] = $_POST['IDKeahlian'];
  $data[2] = $_POST['NamaKeahlian'];
  $data[3] = $_POST['Keterangan'];
  return $data;
}
if(isset($_POST['insert'])){
  $info = getData();
  $insert = "INSERT INTO [Keahlian] ([IDKeahlian]
  ,[NamaKeahlian]
  ,[Keterangan]) VALUES ('$info[1]','$info[2]','$info[3]')";
  $stmt = sqlsrv_query($conn,$insert);
}

if(isset($_POST['clear'])){
  $info = getData();
  $clear = "TRUNCATE [Keahlian] ([IDKeahlian]
  ,[NamaKeahlian]
  ,[Keterangan]) VALUES ('$info[1]','$info[2]','$info[3]')";
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
  <link rel="stylesheet" href="style/keahlian.css">
  <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.1/dist/jquery.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
<?php
include('navbar1.php');
?>
  <!-- Keahlian -->
  <div class="bodi">
  <!-- <div class="d-flex justify-content-center">
    <div class="card" style="width: 33rem;"> -->
    <div class="jumbotron">
    <h2>Masukkan Keahlian Karyawan</h2>
      <form method = "POST">
        <div class="form-group row">
          <label for="colFormLabelSm" class="col-sm-3 col-form-label col-form-label-sm">ID Keahlian</label>
          <div class="col-sm-9">
            <input type="text" class="form-control form-control-sm" id="IDKeahlian" name="IDKeahlian">
          </div>
        </div>
        <div class="form-group row">
          <label for="colFormLabelSm" class="col-sm-3 col-form-label col-form-label-sm">Nama Keahlian</label>
          <div class="col-sm-9">
            <input type="text" class="form-control form-control-sm" id="NamaKeahlian" name="NamaKeahlian">
          </div>
        </div>
        <div class="form-group">
          <label for="exampleFormControlTextarea1">Keterangan</label>
          <textarea class="form-control" id="Keterangan" name="Keterangan" rows="3"></textarea>
        </div>
        <button type="submit" class="btn btn-primary" id="insert" name="insert">Input</button>
        <button type="submit" class="btn btn-primary" id="clear" name="clear">Clear</button>
      </form>
      </div>
      <!-- </div>
  </div> -->

 <!-- Tabel nampilin daftar proker -->
 <table class="table table-striped">
    <thead>
      <tr>
      <th scope="col">No</th>
        <th scope="col">ID Keahlian</th>
        <th scope="col">Nama Keahlian</th>
        <th scope="col">Keterangan</th>
      </tr>
    </thead>
    <tbody>
    <?php
    include('connection.php');
    // untuk nampilin data
    $no=1;
    $getKH = "SELECT * from [Keahlian]";
    $stmt = sqlsrv_query($conn,$getKH);

    while($tampil = sqlsrv_fetch_array($stmt,SQLSRV_FETCH_ASSOC)){
        echo "<tr>
        <td>$no</td>
        <td>$tampil[IDKeahlian]</td>
        <td>$tampil[NamaKeahlian]</td>
        <td>$tampil[Keterangan]</td>
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
