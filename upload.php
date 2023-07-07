<?php
$targetDirectory = "archivos/"; // Reemplaza con la ruta a la carpeta deseada
$databaseHost = "localhost"; // Cambia según tu configuración de base de datos
$databaseName = "test"; // Cambia según tu configuración de base de datos
$databaseUser = "root"; // Cambia según tu configuración de base de datos
$databasePassword = ""; // Cambia según tu configuración de base de datos

// Crear una conexión a la base de datos
$conn = new mysqli($databaseHost, $databaseUser, $databasePassword, $databaseName);

if ($conn->connect_error) {
    die("Error de conexión a la base de datos: " . $conn->connect_error);
}

if (isset($_POST["submit"])) {
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
    if ($imageFileType != "pdf" && $imageFileType != "doc" && $imageFileType != "docx") {
        echo "Solo se permiten archivos PDF, DOC y DOCX.";
        echo "<br>";
        $uploadOk = 0;
    }

    if ($uploadOk == 0) {
        echo "Error al cargar el archivo.";
        echo "<br>";
    } else {
        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $targetFile)) {
            // Insertar información del archivo en la base de datos
            $nombreArchivo = $_FILES["fileToUpload"]["name"];
            $rutaArchivo = $targetFile;
            $sql = "INSERT INTO bdarchivos (nombre, ruta) VALUES ('$nombreArchivo', '$rutaArchivo')";
            if ($conn->query($sql) === TRUE) {
                echo "El archivo " . basename($_FILES["fileToUpload"]["name"]) . " se ha cargado correctamente.";
                echo "<br>";
            } else {
                echo "Error al cargar el archivo en la base de datos: " . $conn->error;
                echo "<br>";
            }
        } else {
            echo "Error al cargar el archivo.";
            echo "<br>";
        }
    }
}

// Obtener los archivos almacenados en la base de datos
$sql = "SELECT * FROM bdarchivos";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<h2>Archivos cargados:</h2>";
    echo "<ul>";
    while ($row = $result->fetch_assoc()) {
        echo "<li><a href='" . $row["ruta"] . "' target='_blank'>" . $row["nombre"] . "</a></li>";
    }
    echo "</ul>";
} else {
    echo "<p>No se han cargado archivos.</p>";
    echo "<br>";
}

$conn->close();
?>