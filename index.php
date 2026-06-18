<?php
$servername = "localhost";
$username = "siteuser";
$password = "StrongPass123!";
$dbname = "margosite";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $conn->real_escape_string($_POST['name']);
    $conn->query("INSERT INTO visitors (name) VALUES ('$name')");
}

$result = $conn->query("SELECT name, created_at FROM visitors ORDER BY created_at DESC");
?>
<!DOCTYPE html>
<html>
<head>
    <title>Margo's Server</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: linear-gradient(135deg, #667eea, #764ba2);
            color: white;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0;
            text-align: center;
            padding: 20px;
        }
        h1 { font-size: 2.5em; margin-bottom: 5px; }
        form { margin: 20px 0; }
        input[type=text] {
            padding: 10px;
            border-radius: 5px;
            border: none;
            font-size: 1em;
        }
        button {
            padding: 10px 20px;
            border-radius: 5px;
            border: none;
            background: #ffd700;
            font-weight: bold;
            cursor: pointer;
            margin-left: 5px;
        }
        ul { list-style: none; padding: 0; }
        li { background: rgba(255,255,255,0.15); margin: 5px 0; padding: 8px 15px; border-radius: 5px; }
    </style>
</head>
<body>
    <h1>Hello, I'm Michael! 👋</h1>
    <p>Future DevOps Engineer 🚀</p>
    <p>Deployed via EC2 + MySQL + PHP</p>
    <p style="margin-top:20px;">
        <a href="https://avatars.mds.yandex.net/i?id=8921ad6fc3c40162bbd1cc848610adf81e5b3be0-10259428-images-thumbs&n=13" target="_blank" style="color:#ffd700; font-weight:bold; text-decoration:underline;">
            Нажми чтобы присоединиться
        </a>
    </p>
    <form method="POST">
        <input type="text" name="name" placeholder="Введи своё имя" required>
        <button type="submit">Оставить след</button>
    </form>
    <h3>Гости сайта:</h3>
    <ul>
        <?php while($row = $result->fetch_assoc()): ?>
            <li><?php echo htmlspecialchars($row['name']); ?> — <?php echo $row['created_at']; ?></li>
        <?php endwhile; ?>
    </ul>
</body>
</html>
