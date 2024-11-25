 <?php
session_start();
include('includes/db.php'); // Pastikan file ini berisi koneksi PDO
include('includes/header.php');

 $error = ' '; // Inisialisasi variabel error

 if ($_SERVER['REQUEST_METHOD'] == 'POST') {
     $username = trim($_POST['username']);
     $password = $_POST['password'];

     // Siapkan dan eksekusi query untuk mengambil data pengguna
     $stmt = $pdo->prepare("SELECT * FROM users WHERE username = :username");
     $stmt->bindParam(':username', $username);
     $stmt->execute();
     $user = $stmt->fetch(PDO::FETCH_ASSOC); // Ambil hasil sebagai array asosiatif

     // Verifikasi password
     if ($user && password_verify($password, $user['password'])) {
         // Jika berhasil, simpan data pengguna dalam session
         $_SESSION['user_id'] = $user['id'];
         $_SESSION['username'] = $user['username'];
         header('Location: index.php');
         exit();
     } else {
         // Jika gagal, set pesan error
         $error = "Username atau password salah!";
     }
 }
?>

<link rel="stylesheet" href="style.css">
<div class="login-container">
    <h2>Masuk</h2>
    <?php if (!empty($error)) { echo "<p class='error'>$error</p>"; } ?>
    <form method="POST">
        <div class="form-group">
            <label for="username">Nama Pengguna</label>
            <input type="text" id="username" name="username" placeholder="Nama Pengguna" required>
        </div>
        <div class="form-group">
            <label for="password">Kata Sandi</label>
            <input type="password" id="password" name="password" placeholder="Kata Sandi" required>
        </div>
        <button type="submit">Masuk</button>
        <p>Lupa kata sandi? <a href="#">Reset kata sandi</a></p>
    </form>
    <div class="social-login">
        <!-- Tambahkan opsi login sosial jika diperlukan -->
    </div>
</div>