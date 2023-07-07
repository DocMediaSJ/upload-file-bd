<?php
$targetDirectory = "archivos/"; // Reemplaza con la ruta a la carpeta deseada

if(isset($_POST["submit"])) {
    $targetFile = $targetDirectory . basename($_FILES["fileToUpload"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

    // Verificar si el archivo ya existe
    if (file_exists($targetFile)) {
        echo "El archivo ya existe.";
        echo "<br>";
        $uploadOk = 0;
    }

    // Verificar el tamaño máximo del archivo (opcional)
    if ($_FILES["fileToUpload"]["size"] > 5000000) {
        echo "El archivo es demasiado grande.";
        echo "<br>";
        $uploadOk = 0;
    }

    // Permitir solo ciertos formatos de archivo (opcional)
    if($imageFileType != "pdf" && $imageFileType != "doc" && $imageFileType != "docx"
        && $imageFileType != "odt" ) {
        echo "Solo se permiten archivos .pdf, .doc, docx. y .odt.";
        echo "<br>";
        $uploadOk = 0;
    }

    if ($uploadOk == 0) {
        echo "Error al cargar el archivo.";
        echo "<br>";
    } else {
        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $targetFile)) {
            echo "El archivo ". basename( $_FILES["fileToUpload"]["name"]). " se ha cargado correctamente.";
        } else {
            echo "Error al cargar el archivo.";
            echo "<br>";
        }
    }
}
?>
