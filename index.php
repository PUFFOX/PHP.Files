<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="form-container">
        <form action="save.php" method="post">
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" required>

            <label for="login">Login:</label>
            <input type="text" id="login" name="login" required>

            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>

            <div class="btn-container">
                <button type="submit" name="action" value="saveTxt">SaveTxtDocument</button>
                <button type="submit" name="action" value="saveXml">SaveXmlDocument</button>
                <button type="button" onclick="window.location.href='reg.php'">ShowResult</button>
            </div>
        </form>
    </div>
</body>
</html>