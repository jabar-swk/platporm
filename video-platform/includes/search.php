<?php
// // Koneksi ke database
// $servername = "localhost"; // Ganti dengan server Anda
// $username = "root"; // Ganti dengan username database Anda
// $password = ""; // Ganti dengan password database Anda
// $dbname = "video_platform"; // Ganti dengan nama database Anda

include('includes/db.php');

// // Buat koneksi
// $conn = new mysqli($servername, $username, $password, $dbname);

// Cek koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Ambil query pencarian dari URL
$query = isset($_GET['query']) ? $_GET['query'] : '';

// Siapkan dan jalankan query pencarian
$results = [];
if ($query) {
    // Menggunakan prepared statement untuk mencegah SQL injection
    $stmt = $conn->prepare("SELECT title, url FROM videos WHERE title LIKE ?");
    $searchTerm = "%" . $conn->real_escape_string($query) . "%"; // Menambahkan wildcard untuk pencarian
    $stmt->bind_param("s", $searchTerm);
    $stmt->execute();
    $result = $stmt->get_result();

    // Ambil hasil pencarian
    while ($row = $result->fetch_assoc()) {
        $results[] = $row;
    }

    $stmt->close();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hasil Pencarian</title>
    <link rel="stylesheet" href="assets/css/style.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            background-color: #f4f4f4;
        }

        h1 {
            color: #333;
        }

        .video-list {
            list-style: none;
            padding: 0;
        }

        .video-list li {
            background: white;
            margin: 10px 0;
            padding: 15px;
            border-radius: 5px;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
        }

        .video-list a {
            text-decoration: none;
            color: #4CAF50;
            font-weight: bold;
        }

        .video-list a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <h1>Hasil Pencarian untuk: "<?php echo htmlspecialchars($query); ?>"</h1>

    <?php if (count($results) > 0): ?>
        <ul class="video-list">
            <?php foreach ($results as $video): ?>
                <li>
                    <a href="<?php echo htmlspecialchars($video['url']); ?>"><?php echo htmlspecialchars($video['title']); ?></a>
                </li>
            <?php endforeach; ?>
        </ul>
    <?php else: ?>
        <p>Tidak ada video yang ditemukan.</p>
    <?php endif; ?>
</body>
</html>