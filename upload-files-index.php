<!DOCTYPE html>
<html>
<head>
    <title>Cargar archivo</title>
</head>
<body>
    <form action="upload.php" method="POST" enctype="multipart/form-data">
        <input type="file" name="fileToUpload" id="fileToUpload" accept=".pdf,.doc,.docx">
        <br>
        <input type="submit" value="Cargar archivo" name="submit">
    </form>
</body>
</html>