<?php
include('includes/db.php');

$stmt = $pdo->prepare("SELECT * FROM videos ORDER BY uploaded_at DESC");
$stmt->execute();
$videos = $stmt->fetchAll();
?>

<?php include('includes/header.php');?>

<div class="container">
    <h2>Tonton Video</h2>
    <div class="video-list">
        <?php foreach ($videos as $video): ?>
            <div class="video-item">
                <h3><?php echo htmlspecialchars($video['title']); ?></h3>
                <video width="320" height="240" controls>
                    <source src="<?php echo htmlspecialchars($video['video_url']); ?>" type="video/mp4">
                    Browser Anda tidak mendukung elemen video.
                </video>
            </div>
        <?php endforeach; ?>
    </div>
</div>

<?php include('includes/footer.php');?>

