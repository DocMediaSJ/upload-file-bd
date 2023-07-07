<!DOCTYPE html>
<html>
<head>
    <title>Cargar archivo</title>
    <script>
        function validateForm() {
            var fileInput = document.getElementById("fileToUpload");
            if (fileInput.files.length === 0) {
                alert("Por favor, selecciona un archivo.");
                return false;
            }
            return true;
        }
</script>
</head>
<body>
    <form action="upload.php" method="POST" enctype="multipart/form-data" onsubmit="return validateForm()">
        <input type="file" name="fileToUpload" id="fileToUpload" accept=".pdf,.doc,.docx">
        <br>
        <input type="submit" value="Cargar archivo" name="submit">
    </form>
</body>
</html>

