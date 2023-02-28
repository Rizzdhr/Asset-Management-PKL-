<?php 
// menghubungkan koneksi ke database
$koneksi = mysqli_connect('localhost','root','','asset_db');

$id = $_GET ['id'];

// query delete
$query = "DELETE FROM tbl_home WHERE id='$id'";
$hasil = mysqli_query($koneksi, $query);

if ($hasil) {
    echo "<script>
        alert('Hapus data berhasil!');
        window.location='index.php';
    </script>";
} else {
    echo "<script>
        alert('Hapus data gagal');
        window.location='index.php';
    </script>";
}