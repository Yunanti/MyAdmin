<?php
include('connection.php');

function getData(){
  $data = array();
  $data[1] = $_POST['IDProker'];
  $data[2] = $_POST['IDDivisi'];
  $data[3] = $_POST['TglPelaksanaan'];
  return $data;
}

// untuk insert data
if(isset($_POST['insert'])){
  $info = getData();
  $insert = "INSERT INTO [Rencana] ([IDProker]
  ,[IDDivisi]
  ,[TglPelaksanaan]) VALUES ('$info[1]','$info[2]','$info[3]')";
  $stmt = sqlsrv_query($conn,$insert);
}

if(isset($_POST['clear'])){
    $info = getData();
    $clear = "TRUNCATE [Rencana] ([IDProker]
    ,[IDDivisi]
    ,[TglPelaksanaan]) VALUES ('$info[1]','$info[2]','$info[3]')";
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
  <link rel="stylesheet" href="style/plan.css">
  <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.1/dist/jquery.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
<?php
include('navbar1.php');
?>
  <!-- Plan -->
  
  <div class="bodi">
  <!-- <div class="d-flex justify-content-center">
    <div class="card" style="width: 33rem;"> -->
    <div class="jumbotron">
    <h2>Masukkan Rencana Proker</h2>
    <form action=" "method="POST">
      <?php
      include ('connection.php');

      ?>

      <br>
      <br>

      <div class="form-group row">
        <label for="IDProker" class="col-sm-3 col-form-label col-form-label-sm"> ID Proker </label>
        <div class="col-sm-9">
        <select id="IDProker" class="form-control form-control-sm" name="IDProker">
        autocomplete="off">
        <option selected=" "disabled="">Select ID Proker</option>

        <?php
        $sql = "SELECT distinct IDProker, NamaProker
        FROM ProgramKerja ORDER BY IDProker asc ";

        $params = array();
        $options = array("Scrollable" => SQLSRV_CURSOR_KEYSET );

        $stmt = sqlsrv_query( $conn, $sql, $params, $options );

        if(sqlsrv_num_rows($stmt) > 0) {
          while($row=sqlsrv_fetch_array($stmt)) {
            echo "<option value= '", $row['IDProker'],"'>",$row['IDProker']," | ",$row['NamaProker'],"</option>";
          }
        }
        ?>
      </select>
      </div>
      </div>
      <!-- <form method = "POST">
        <div class="form-group row">
          <label for="colFormLabelSm" class="col-sm-3 col-form-label col-form-label-sm">ID Proker</label>
          <div class="col-sm-9">
            <input type="text" class="form-control form-control-sm" id="IDProker" name="IDProker">
          </div>
        </div> -->
        <!-- <div class="form-group row">
          <label for="colFormLabelSm" class="col-sm-3 col-form-label col-form-label-sm">ID Divisi</label>
          <div class="col-sm-9">
            <input type="text" class="form-control form-control-sm" id="IDDivisi" name="IDDivisi">
          </div>
        </div> -->
        

      <div class="form-group row">
        <label for="IDDivisi" class="col-sm-3 col-form-label col-form-label-sm"> ID Divisi </label>
        <div class="col-sm-9">
        <select id="IDDivisi" class="form-control form-control-sm" name="IDDivisi">
        autocomplete="off">
        <option selected=" "disabled="">Select ID Divisi</option>

        <?php
        $sql = "SELECT distinct IDDivisi, NamaDivisi
        FROM Divisi ORDER BY IDDivisi asc ";

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
        <div class="form-group row">
          <label for="colFormLabelSm" class="col-sm-3 col-form-label col-form-label-sm">Tanggal Pelaksanaan</label>
          <div class="col-sm-9">
            <input type="date" class="form-control form-control-sm" id="TglPelaksanaan" name="TglPelaksanaan">
          </div>
        </div>
        <button type="submit" class="btn btn-primary" id="insert" name="insert">Input</button>
        <button type="submit" class="btn btn-primary" id="clear" name="clear">Clear</button>
      </form>
      </div>
      <!-- </div>
  </div> -->

  <!-- Tabel nampilin daftar plan -->
  <table class="table table-striped">
    <thead>
      <tr>
      <th scope="col">No</th>
        <th scope="col">ID Proker</th>
        <th scope="col">ID Divisi</th>
        <th scope="col">Tanggal Pelaksanaan</th>
      </tr>
    </thead>
    <tbody>
    <?php
    include('connection.php');
    // untuk nampilin data
    $no=1;
    $getProker = "SELECT * from [Rencana]";
    $stmt = sqlsrv_query($conn,$getProker);

    while($tampil = sqlsrv_fetch_array($stmt,SQLSRV_FETCH_ASSOC)){
        echo "<tr>
        <td>$no</td>
        <td>$tampil[IDProker]</td>
        <td>$tampil[IDDivisi]</td>
        <td>$tampil[TglPelaksanaan]</td>
        </tr>";
        $no++;
    }
    sqlsrv_free_stmt($stmt);
    sqlsrv_close($conn);
    ?>

<?php
    // include('connection.php');
    // $no=1;
    // $getProker = "SELECT a.([NamaProker]), c.([IDProker]), c.([IDDivisi]), c.([TglPelaksanaan])
    // from [ProgramKerja] a INNER JOIN [Rencana] c on a.([IDProker]) = c.([IDProker])";
    // $stmt = sqlsrv_query($conn,$getProker);

    // while($tampil = sqlsrv_fetch_array($stmt,SQLSRV_FETCH_ASSOC)){
    //     echo "<tr>
    //     <td>$no</td>
    //     <td>$tampil[IDProker]</td>
    //     <td>$tampil[NamaProker]</td>
    //     <td>$tampil[IDDivisi]</td>
    //     <td>$tampil[TglPelaksanaan]</td>
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
