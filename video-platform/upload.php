<?php
session_start();
include('includes/db.php');

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['video'])) {
    $title = trim($_POST['title']);
    $description = trim($_POST['description']);
    $video = $_FILES['video'];

    // Validasi file upload
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($video["name"]);
    $fileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    $allowed_types = ['mp4', 'avi', 'mov'];

    if (!in_array($fileType, $allowed_types)) {
        $error = "Hanya file video dengan ekstensi .mp4, .avi, atau .mov yang diperbolehkan.";
    } elseif ($video["size"] > 100000000) {  // max 100MB
        $error = "Ukuran file terlalu besar!";
    } else {
        if (move_uploaded_file($video["tmp_name"], $target_file)) {
            $stmt = $pdo->prepare("INSERT INTO videos (title, description, video_url, user_id) VALUES (:title, :description, :video_url, :user_id)");
            $stmt->bindParam(':title', $title);
            $stmt->bindParam(':description', $description);
            $stmt->bindParam(':video_url', $target_file);
            $stmt->bindParam(':user_id', $_SESSION['user_id']);
            $stmt->execute();
            $success = "Video berhasil diunggah!";
        } else {
            $error = "Terjadi kesalahan saat mengunggah video.";
        }
    }
}
?>

<?php include('includes/header.php'); ?>

<div class="container">
    <h2>Unggah Video</h2>
    <?php if (isset($error)) { echo "<p class='error'>$error</p>"; } ?>
    <?php if (isset($success)) { echo "<p class='success'>$success</p>"; } ?>
    <form method="POST" enctype="multipart/form-data">
        <input type="text" name="title" placeholder="Judul Video" required>
        <textarea name="description" placeholder="Deskripsi Video" required></textarea>
        <input type="file" name="video" accept="video/*" required>
        <button type="submit">Unggah Video</button>
    </form>
</div>

 <?php include('includes/footer.php'); ?> 
