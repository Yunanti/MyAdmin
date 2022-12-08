<?php
include('connection.php');

function getData(){
  $data = array();
  $data[1] = $_POST['IDPangkat'];
  $data[2] = $_POST['NamaKepangkatan'];
  $data[3] = $_POST['Keterangan'];
  return $data;
}

// untuk insert data
if(isset($_POST['insert'])){
  $info = getData();
  $insert = "INSERT INTO [Pangkat] ([IDPangkat]
  ,[NamaKepangkatan]
  ,[Keterangan]) VALUES ('$info[1]','$info[2]','$info[3]')";
  $stmt = sqlsrv_query($conn,$insert);
}

if(isset($_POST['clear'])){
  $info = getData();
  $clear = "TRUNCATE [Pangkat] ([IDProker]
  ,[IDDivisi]
  ,[TglPelaksanaan]) VALUES ('$info[1]','$info[2]','$info[3]')";
  $stmt = sqlsrv_query($conn,$clear);
}


function getDataBerpangkat(){
  $dataBerpangkat = array();
  $dataBerpangkat[1] = $_POST['IDKaryawan'];
  $dataBerpangkat[2] = $_POST['IDPangkat'];
  $dataBerpangkat[3] = $_POST['TglDiangkat'];
  return $dataBerpangkat;
}

// untuk insert data
if(isset($_POST['insertBerpangkat'])){
  $infoBerpangkat = getDataBerpangkat();
  $insertBerpangkat = "INSERT INTO [Berpangkat] ([IDKaryawan]
  ,[IDPangkat]
  ,[TglDiangkat]) VALUES ('$infoBerpangkat[1]','$infoBerpangkat[2]','$infoBerpangkat[3]')";
  $stmt = sqlsrv_query($conn,$insertBerpangkat);
}

if(isset($_POST['clearBerpangkat'])){
    $infoBerpangkat = getData();
    $clearBerpangkat = "TRUNCATE [Berpangkat] ([IDKaryawan]
    ,[IDPangkat]
    ,[TglDiangkat]) VALUES ('$infoBerpangkat[1]','$infoBerpangkat[2]','$infoBerpangkat[3]')";
    $stmt = sqlsrv_query($conn,$clearBerpangkat);
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>MyAdmin</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="style/pangkat.css">
  <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.1/dist/jquery.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
<?php
include('navbar1.php');
?>
  <!-- Pangkat -->
  <div class="bodi">
  <!-- <div class="d-flex justify-content-center">
    <div class="card" style="width: 33rem;"> -->
    <div class="jumbotron">
    <h2>Masukkan Deskripsi Jabatan</h2>
      <form method = "POST">
        <div class="form-group row">
          <label for="colFormLabelSm" class="col-sm-3 col-form-label col-form-label-sm">ID Jabatan</label>
          <div class="col-sm-9">
            <input type="text" class="form-control form-control-sm" id="IDPangkat" name="IDPangkat">
          </div>
        </div>
        <div class="form-group row">
          <label for="colFormLabelSm" class="col-sm-3 col-form-label col-form-label-sm">Nama Jabatan</label>
          <div class="col-sm-9">
            <input type="text" class="form-control form-control-sm" id="NamaKepangkatan" name="NamaKepangkatan">
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

  <!-- Tabel nampilin daftar pangkat -->
  <table class="table table-striped">
    <thead>
      <tr>
      <th scope="col">No</th>
        <th scope="col">ID Jabatan</th>
        <th scope="col">Nama Jabatan</th>
        <th scope="col">Keterangan</th>
      </tr>
    </thead>
    <tbody>
    <?php
    include('connection.php');
    // untuk nampilin data
    $no=1;
    $getProker = "SELECT * from [Pangkat]";
    $stmt = sqlsrv_query($conn,$getProker);

    while($tampil = sqlsrv_fetch_array($stmt,SQLSRV_FETCH_ASSOC)){
        echo "<tr>
        <td>$no</td>
        <td>$tampil[IDPangkat]</td>
        <td>$tampil[NamaKepangkatan]</td>
        <td>$tampil[Keterangan]</td>
        </tr>";
        $no++;
    }
    sqlsrv_free_stmt($stmt);
    sqlsrv_close($conn);
    ?>
    </tbody>
  </table>


<!-- Berpangkat -->
<div class="jumbotron">
    <h2>Masukkan Keterangan Naik Jabatan</h2>
    <form action=" "method="POST">
      <?php
      include ('connection.php');

      ?>

      <div class="form-group row">
        <label for="colFormLabelSm" class="col-sm-3 col-form-label col-form-label-sm"> ID Karyawan </label>
        <div class="col-sm-9">
        <select id="IDKaryawan" class="form-control form-control-sm" name="IDKaryawan">
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
        <label for="colFormLabelSm" class="col-sm-3 col-form-label col-form-label-sm"> ID Jabatan </label>
        <div class="col-sm-9">
        <select id="IDPangkat" class="form-control form-control-sm" name="IDPangkat">
        autocomplete="off">
        <option selected=" "disabled="">Select ID Jabatan</option>

        <?php
        $sql = "SELECT distinct IDPangkat, NamaKepangkatan
        FROM Pangkat ORDER BY IDPangkat asc ";

        $params = array();
        $options = array("Scrollable" => SQLSRV_CURSOR_KEYSET );

        $stmt = sqlsrv_query( $conn, $sql, $params, $options );

        if(sqlsrv_num_rows($stmt) > 0) {
          while($row=sqlsrv_fetch_array($stmt)) {
            echo "<option value= '", $row['IDPangkat'],"'>",$row['IDPangkat']," | ",$row['NamaKepangkatan'],"</option>";
          }
        }
        ?>
      </select>
      </div>
      </div>
        <div class="form-group row">
          <label for="colFormLabelSm" class="col-sm-3 col-form-label col-form-label-sm">Tanggal Diangkat</label>
          <div class="col-sm-9">
            <input type="date" class="form-control form-control-sm" id="TglDiangkat" name="TglDiangkat">
          </div>
        </div>
        <button type="submit" class="btn btn-primary" id="insert" name="insertBerpangkat">Input</button>
        <button type="submit" class="btn btn-primary" id="clear" name="clearBerpangkat">Clear</button>
      </form>
      </div>

<!-- Tabel nampilin daftar berpangkat -->
  <table class="table table-striped">
    <thead>
      <tr>
      <th scope="col">No</th>
        <th scope="col">ID Karyawan</th>
        <th scope="col">ID Jabatan</th>
        <th scope="col">Tanggal Diangkat</th>
      </tr>
    </thead>
    <tbody>
    <?php
    include('connection.php');
    // untuk nampilin data
    $no=1;
    $getProker = "SELECT * from [Berpangkat]";
    $stmt = sqlsrv_query($conn,$getProker);

    while($tampil = sqlsrv_fetch_array($stmt,SQLSRV_FETCH_ASSOC)){
        echo "<tr>
        <td>$no</td>
        <td>$tampil[IDKaryawan]</td>
        <td>$tampil[IDPangkat]</td>
        <td>$tampil[TglDiangkat]</td>
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
