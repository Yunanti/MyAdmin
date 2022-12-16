<?php
include('connection.php');

function getData(){
  $data = array();
  $data[1] = $_POST['IDProker'];
  $data[2] = $_POST['NamaProker'];
  $data[3] = $_POST['Keterangan'];
  return $data;
}

// untuk insert data
if(isset($_POST['insert'])){
  $info = getData();
  $insert = "INSERT INTO [ProgramKerja] ([IDProker]
  ,[NamaProker]
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
  <link rel="stylesheet" href="style/proker.css">
  <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.1/dist/jquery.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
<?php
include('navbar1.php');
?>
<div class="bodi">
  <!-- Proker -->
  <!-- <div class="d-flex justify-content-center">
    <div class="card" style="width: 33rem;"> -->
    <div class="jumbotron">
    <h2>Masukkan Program Kerja</h2>
      <form method = "POST">
        <div class="form-group row">
          <label for="colFormLabelSm" class="col-sm-3 col-form-label col-form-label-sm">ID Proker</label>
          <div class="col-sm-9">
            <input type="text" class="form-control form-control-sm" id="IDProker" name="IDProker">
          </div>
        </div>
        <div class="form-group row">
          <label for="colFormLabelSm" class="col-sm-3 col-form-label col-form-label-sm">Nama Proker</label>
          <div class="col-sm-9">
            <input type="text" class="form-control form-control-sm" id="NamaProker" name="NamaProker">
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
        <th scope="col">ID Program Kerja</th>
        <th scope="col">Nama Program Kerja</th>
        <th scope="col">Keterangan</th>
        <th scope="col">Aksi</th>
      </tr>
    </thead>
    <tbody>
    <?php
    include('connection.php');

    // untuk delete(update) data
    if(isset($_GET['IDProker'])){
      $IDProker=$_GET['IDProker'];
      $del = "UPDATE ProgramKerja SET Deleted=1 WHERE IDProker='$IDProker'";
      $stmt = sqlsrv_query($conn,$del);
    }

    // untuk nampilin data karyawan
    $no=1;
    $params = array();
    $options = array("Scrollable" => SQLSRV_CURSOR_KEYSET);
    $stmt = sqlsrv_query($conn,"SELECT * from ProgramKerja WHERE Deleted=0", $params, $options);

    $num = sqlsrv_num_rows($stmt);
    if($num>0){
      while($tampil=sqlsrv_fetch_array($stmt,SQLSRV_FETCH_ASSOC)){

        echo "<tr>
          <td>".$no."</td>
          <td>".$tampil['IDProker']."</td>
          <td>".$tampil['NamaProker']."</td>
          <td>".$tampil['Keterangan']."</td>
          <td>
            <a href='proker.php?IDProker=".$tampil['IDProker']."' class='btn btn-primary'>Delete</a>
          </td>
          </tr>";
          $no++;
  
      }
    }

    sqlsrv_free_stmt($stmt);
    sqlsrv_close($conn);

    // untuk nampilin data
    // $no=1;
    // $getProker = "SELECT * from [ProgramKerja]";
    // $stmt = sqlsrv_query($conn,$getProker);

    // while($tampil = sqlsrv_fetch_array($stmt,SQLSRV_FETCH_ASSOC)){
    //     echo "<tr>
    //     <td>$no</td>
    //     <td>$tampil[IDProker]</td>
    //     <td>$tampil[NamaProker]</td>
    //     <td>$tampil[Keterangan]</td>
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
