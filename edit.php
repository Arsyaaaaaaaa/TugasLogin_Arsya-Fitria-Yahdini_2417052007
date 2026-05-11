<?php
session_start();
include "koneksi.php";

if ($_SESSION['nama'] != "admin") {

    header("Location: dashboard.php");
    exit;
}

if (!isset($_GET['id'])) {

    header("Location: dashboard.php");
    exit;
}

$id = $_GET['id'];

$query = mysqli_query(
    $conn,
    "SELECT * FROM users WHERE id='$id'"
);

$data = mysqli_fetch_assoc($query);

if (isset($_POST['update'])) {

    $nama = $_POST['nama'];

    $password = password_hash(
        $_POST['password'],
        PASSWORD_DEFAULT
    );

    $update = "
    UPDATE users
    SET nama='$nama',
        password='$password'
    WHERE id='$id'
    ";

    mysqli_query($conn, $update);

    header("Location: dashboard.php");
    exit;
}
?>

<div style="
    border:1px solid black;
    padding:20px;
    min-height:300px;
">

<h2>Edit Data Pengguna</h2>

<form method="POST">

<label>Nama Pengguna:</label>
<br>

<input type="text"
       name="nama"
       value="<?php echo $data['nama']; ?>"
       required>

<br><br>

<label>Password Baru:</label>
<br>

<input type="password"
       name="password"
       placeholder="Masukkan password baru"
       required>

<br><br>

<button type="submit" name="update">
    Simpan Perubahan
</button>

</form>

<br>

<a href="dashboard.php">
    <button>Kembali</button>
</a>

</div>
