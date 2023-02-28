<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Asset Management</title>
  <link rel="stylesheet" href="style.css">
	<script src="https://kit.fontawesome.com/b99e675b6e.js"></script>
  <link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
  <link rel="stylesheet" href="/resources/demos/style.css">
  <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
  <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
  <!-- CSS only -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
</head>

<body>
  <!-- navbar -->
  <div class="wrapper">
    <div class="sidebar">
        <h2>Sidebar</h2>
        <ul>
            <li><a href="#"><i class="fas fa-home"></i>Home</a></li>
            <li><a href="#"><i class="fas fa-user"></i>Profile</a></li>
            <li><a href="#"><i class="fas fa-address-card"></i>About</a></li>
            <li><a href="#"><i class="fas fa-project-diagram"></i>portfolio</a></li>
            <li><a href="#"><i class="fas fa-blog"></i>Blogs</a></li>
            <li><a href="#"><i class="fas fa-address-book"></i>Contact</a></li>
            <li><a href="#"><i class="fas fa-map-pin"></i>Map</a></li>
        </ul> 
        <div class="social_media">
          <a href="#"><i class="fab fa-facebook-f"></i></a>
          <a href="#"><i class="fab fa-twitter"></i></a>
          <a href="#"><i class="fab fa-instagram"></i></a>
      </div>
    </div>
    
</div>



  <!-- content home -->
  <div class="container">
    <div class="card mt-3">
      <div class="card-header bg-dark text-white">
        Dashboard
      </div>


      <!-- Menampilkan hasil pencarian -->
      <?php
      // function tanggal
      include('function_tanggal.php');

      //koneksi ke database
      $koneksi = mysqli_connect('localhost', 'root', '', 'asset_db');

      //proses pencarian data
      if (isset($_POST['search'])) {
        $brand = isset($_POST['brand']) ? $_POST['brand'] : '';
        $pengirim = isset($_POST['pengirim']) ? $_POST['pengirim'] : '';
        $tgl_beli = isset($_POST['tgl_beli']) ? $_POST['tgl_beli'] : '';

        $query = "SELECT * FROM tbl_home WHERE brand LIKE '%$brand%' AND pengirim LIKE '%$pengirim%' AND tgl_beli LIKE '%$tgl_beli%'  ";
      } else {
        $query = "SELECT * FROM tbl_home";
      }

      //menampilkan data
      $no = 1;
      $hasil = mysqli_query($koneksi, $query);
      ?>
      <div class="container table-responsive card-body">
        <form action="" method="POST">
          <div class="mb-3">
            <label for="">Brand</label>
            <input type="text" name="brand" class="" autocomplete="off">
          </div>
          <div class="mb-3">
            <label for="">Pengirim</label>
            <input type="text" name="pengirim" class="" autocomplete="off">
          </div>
          <div class="mb-3">
            <label for="">Tanggal Pembelian</label>
            <input type="date" name="tgl_beli" class="">
          </div>
          <button type="submit" name="search" class="btn btn-dark">Cari</button>
        </form>
        <script>
          $(function () {
            $("#tgl_beli").datepicker({
              dateFormat: "dd/mm/yy",
              dateMonth: true,
              dateYear: true
            });
          });
        </script>


        <br>
        <div class="table-responsive card-body">
          <table class="table table-striped table-bordered">
            <thead class="table-dark">
              <tr>
                <th>No.</th>
                <th>Nama Tipe</th>
                <th>Brand</th>
                <th>Detail Tipe</th>
                <th>Nomor Serial</th>
                <th>Pengirim</th>
                <th>Penerima</th>
                <th>Posisi Perkerjaan</th>
                <th>Tanggal Pembelian</th>
                <th>Lokasi</th>
                <th>Kondisi</th>
                <th>Deskripsi</th>
                <th>Action</th>
            </thead>

            <tbody>
              <?php
              while ($data = mysqli_fetch_array($hasil)) {
                $tanggal = Tanggalindo($data['tgl_beli']);
                ?>
                <tr>
                  <td>
                    <?= $no; ?>
                  </td>
                  <td>
                    <?php echo $data['nama_tipe']; ?>
                  </td>
                  <td>
                    <?php echo $data['brand']; ?>
                  </td>
                  <td>
                    <?php echo $data['detail_tipe']; ?>
                  </td>
                  <td>
                    <?php echo $data['nomor_serial']; ?>
                  </td>
                  <td>
                    <?php echo $data['pengirim']; ?>
                  </td>
                  <td>
                    <?php echo $data['penerima']; ?>
                  </td>
                  <td>
                    <?php echo $data['posisi']; ?>
                  </td>
                  <td>
                    <?php echo $tanggal; ?>
                  </td>
                  <td>
                    <?php echo $data['lokasi']; ?>
                  </td>
                  <td>
                    <?php echo $data['kondisi']; ?>
                  </td>
                  <td>
                    <?php echo $data['deskripsi']; ?>
                  </td>
                  <td>
                    <a href="form_update.php?id=<?= $data['id'] ?>" class="btn btn-success btn-sm">Edit</a>
                    <a href="act_delete.php?id=<?= $data['id'] ?>" class="btn btn-danger btn-sm">Hapus</a>
                  </td>
                </tr>
                <?php
                $no++;
              }
              ?>
            </tbody>
          </table>
        </div>
      </div>


      <!-- Tambah -->
      <div class="container">
        <br>
        <a class="btn btn-primary bg-dark" href="create_blog.php" role="button">Tambah</a>
      </div>


      <!-- JavaScript Bundle with Popper -->
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3"
        crossorigin="anonymous"></script>
</body>

</html>