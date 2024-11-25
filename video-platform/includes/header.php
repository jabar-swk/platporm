
  <!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Video Platform</title>
    <link rel="stylesheet" href="assets/css/style.css">
    <style>
        /* Tambahkan efek hover pada menu */
        nav ul li a:hover {
            background-color: #4CAF50;
            color: #fff;
            padding: 10px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        /* Tambahkan efek transisi pada menu */
        nav ul li a {
            transition: all 0.3s ease-in-out;
        }

        /* Tambahkan efek animasi pada judul */
        h1.animate {
            animation: animate 1s ease-in-out;
        }

        @keyframes animate {
            0% {
                transform: scale(1);
            }
            50% {
                transform: scale(1.1);
            }
            100% {
                transform: scale(1);
            }
        }

        /* Tambahkan efek gradient pada header */
        header {
            background-image: linear-gradient(to right, #4CAF50, #8BC34A);
            padding: 20px;
            text-align: center;
        }

        /* Tambahkan efek bayangan pada header */
        header h1 {
            text-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        /* Gaya untuk form pencarian */
        .search-container {
            margin-top: 10px;
        }

        .search-container input[type="text"] {
            padding: 10px;
            border: none;
            border-radius: 5px;
            width: 200px;
            transition: width 0.4s ease-in-out;
        }

        .search-container input[type="text"]:focus {
            width: 250px;
            outline: none;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.2);
        }

        .search-container button {
            padding: 10px;
            border: none;
            border-radius: 5px;
            background-color: #4CAF50;
            color: white;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .search-container button:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <header>
        <div class="container">
            <h1>Video Platform</h1>
            <nav>
                <ul>
                    <li><a href="index.php">Home</a></li>
                    <li><a href="upload.php">Upload Video</a></li>
                    <?php if (isset($_SESSION['user_id'])): ?>
                        <li><a href="logout.php">Logout</a></li>
                    <?php else: ?>
                        <li><a href="login.php">Login</a></li>
                        <li><a href="register.php">Register</a></li>
                    <?php endif; ?>
                </ul>
            </nav>
            <div class="search-container">
                <form action="search.php" method="GET">
                    <input type="text" name="query" placeholder="Cari video...">
                    <button type="submit">Cari</button>
                </form>
            </div>
        </div>
    </header>
    <script>
        // Tambahkan efek animasi pada judul
        document.querySelector('h1').addEventListener('click', function() {
            this.classList.toggle('animate');
        });
    </script>
</body>
</html> -->