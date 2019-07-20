<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="website sistem pakar">
    <meta name="author" content="mr k">
    <link rel="icon" href="image/icon.png">

    <title>Sistem Pakar</title>

    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="https://getbootstrap.com/docs/4.1/dist/css/bootstrap.min.css" crossorigin="anonymous">

    <!-- Custom styles for this template -->
    <link href="css/style.css" rel="stylesheet">
</head>
<body>
    <?php include ('navbar.php'); ?>
    
    <main class="batas-atas">
        <div class="card text-white bg-info mb-3">
          <h5 class="card-header">Solusi</h5>
          <div class="card-body text-left ukuran-20">

            <form method="post" action="solusi.php" enctype="multipart/form-data" role="form">

                <?php
                include ('koneksi.php');
                //$kode='m01';
                session_start();
                echo "<p>Nama : ".$_SESSION['nama']."</p>";
                echo "<p>Umur : ".$_SESSION['umur']."</p>";
                    
                    if(isset($_GET['kode'])){
                        $kode=$_GET['kode'];
                    }   
                ?>
                <hr>
                <p>Kamu merasa :</p>
                <?php
                 include "fungsi.php";
                 solusi($kode);  
                ?>
                

                <hr>
                <?php
                $sql = "SELECT * from tb_solusi WHERE kode_solusi='$kode'";
                $data = mysqli_query($connect,$sql);
                $row = mysqli_fetch_assoc($data);

                if ($row['kode_solusi']=="x-1" || $row['isi_solusi']=="x-2" || $row['isi_solusi']=="x-3" || $row['isi_solusi']=="x-4" || $row['isi_solusi']=="x-5") {
                     echo "<center><p><strong style='color:red'>SISTEM TIDAK MENEMUKAN JAWABAN !</strong></p></center><hr>";
                     ?>

                     <!------------------------MASUKAN KEPADA SISTEM -------------------------------->
                        <div class="card bg-dark">
                             <h5 class="card-header">Pengguna menambah fakta baru</h5>
                            <div class="card-body">
                             <form action="solusi.php" method="post">
                              <div class="form-group">
                                <label for="exampleFormControlSelect1">Pilih Jurusan :</label>
                                <select name="solusi" class="form-control" id="exampleFormControlSelect2">
                                <?php 
                                include "koneksi.php";
                                $sql = "SELECT * from tb_solusi";
                                $data = mysqli_query($connect,$sql);
                                while ($row = mysqli_fetch_assoc($data)) {
                                   if ($row['isi_solusi']!="x-1" && $row['isi_solusi']!="x-2" && $row['isi_solusi']!="x-3" && $row['isi_solusi']!="x-4" && $row['isi_solusi']!="x-5") {
                                    echo '<option value="'.$row["isi_solusi"].'">'.$row["isi_solusi"].'</option>';
                                 }
                                }
                                ?>
                                </select>
                              </div>
                              <div class="form-group">
                                <label for="exampleFormControlInput2">Masukan fakta:</label>
                                <input type="text" name="fakta" class="form-control" id="exampleFormControlInput1" placeholder="contoh : Suka memperbaiki komputer">
                              </div>
                              <input type="submit" class="btn btn-info" name="masukan">
                            </form>    
                            </div> 
                        </div>  
                        <!------------------------MASUKAN KEPADA SISTEM -------------------------------->                      
                     <?php 
                }
                
                else{
                    echo "<p>Maka kamu harus mengambil prodi : <strong style='color:green'>".$row['isi_solusi']."</strong></p>";
                }
                
                ?>
            </form>
            <br>
            <div class="text-center">
                <a style="margin-bottom: 10px;" href="hapus-session.php" class="btn btn-outline-light col-sm-2">Akhiri</a>
            </div>
          </div>
          
        </div>
    



    </main>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://getbootstrap.com/docs/4.1/dist/js/bootstrap.min.js"></script>
</body>
</html>

<?php
include "koneksi.php";
if (!empty($_POST['masukan'])){
$fakta= $_POST['fakta'];
$solusi=$_POST['solusi'];
$oleh=$_SESSION['nama'];
$status="menunggu";

$sql1 = "INSERT INTO tb_kesimpulan (solusi, fakta, oleh, status) VALUES ('$solusi', '$fakta', '$oleh', '$status')";
if (mysqli_query($connect,$sql1)){
    echo "<script>alert('Saran berhasil dimasukan, harus menunggu moderasi!'); window.location=('hapus-session.php');</script>";
//echo "<script type='text/javascript'>window.location.replace('pakar-mode.php');</script>";
  }
  else  echo "<script>alert('gagal');</script>";
}

?>