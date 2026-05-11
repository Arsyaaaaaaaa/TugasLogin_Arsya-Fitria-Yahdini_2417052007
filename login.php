<?php
session_start();
include "koneksi.php";

if (isset($_POST['register'])) {

    $nama = $_POST['nama'];

    $password = password_hash(
        $_POST['password'],
        PASSWORD_DEFAULT
    );

    $query = "INSERT INTO users (nama, password)
              VALUES ('$nama', '$password')";

    mysqli_query($conn, $query);

    echo "Registrasi berhasil!";
}

if (isset($_POST['login'])) {

    $nama = $_POST['nama'];
    $password = $_POST['password'];

    $query = mysqli_query(
        $conn,
        "SELECT * FROM users WHERE nama='$nama'"
    );

    if (mysqli_num_rows($query) > 0) {

        $data = mysqli_fetch_assoc($query);

        if (password_verify($password, $data['password'])) {

            $_SESSION['nama'] = $data['nama'];

            header("Location: dashboard.php");
            exit;

        } else {
            echo "Password salah!";
        }

    } else {
        echo "User tidak ditemukan!";
    }
}
?>

<h2>Register</h2>

<form method="POST">

    <input type="text"
           name="nama"
           placeholder="Nama"
           required>

    <br><br>

    <input type="password"
           name="password"
           placeholder="Password"
           required>

    <br><br>

    <button type="submit" name="register">
        Register
    </button>

</form>

<hr>

<h2>Login</h2>

<form method="POST">

    <input type="text"
           name="nama"
           placeholder="Nama"
           required>

    <br><br>

    <input type="password"
           name="password"
           placeholder="Password"
           required>

    <br><br>

    <button type="submit" name="login">
        Login
    </button>

</form>
