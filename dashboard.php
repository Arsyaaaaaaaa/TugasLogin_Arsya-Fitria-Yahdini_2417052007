<?php
session_start();
include "koneksi.php";

if (!isset($_SESSION['nama'])) {

    header("Location: auth.php");
    exit;
}

if (isset($_GET['hapus'])) {

    if ($_SESSION['nama'] == "admin") {

        $id = $_GET['hapus'];

        mysqli_query(
            $conn,
            "DELETE FROM users WHERE id='$id'"
        );

        header("Location: dashboard.php");
        exit;
    }
}
?>


<div style="
    border:1px solid black;
    padding:20px;
    min-height:400px;
">

<h2>
    Selamat Datang,
    <?php echo $_SESSION['nama']; ?>!
</h2>

<a href="logout.php">
    <button>Logout</button>
</a>

<hr>

<?php

if ($_SESSION['nama'] == "admin") {
?>

<h3>Menu Admin: Kelola Pengguna</h3>

<table border="1" cellpadding="10">

<tr>
    <th>ID</th>
    <th>Nama</th>
    <th>Aksi</th>
</tr>

<?php

$query = mysqli_query(
    $conn,
    "SELECT * FROM users ORDER BY id DESC"
);

while ($data = mysqli_fetch_assoc($query)) {
?>

<tr>

<td>
    <?php echo $data['id']; ?>
</td>

<td>
    <?php echo $data['nama']; ?>
</td>

<td>

<a href="
edit.php?id=<?php echo $data['id']; ?>
">
    Edit
</a>

|

<a href="
dashboard.php?hapus=<?php echo $data['id']; ?>
">
    Hapus
</a>

</td>

</tr>

<?php } ?>

</table>

<?php
}
?>

</div>

<?php

if ($_SESSION['nama'] != "admin") {
?>

<?php
} else {
?>

<?php } ?>
