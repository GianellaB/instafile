<?php
// Nombre de la carpeta a crear (obtenido del parámetro)
$carpetaNombre = $_GET['carpeta'];

// Ruta donde deseas crear la carpeta (por ejemplo, en la carpeta 'descarga')
$carpetaRuta = "./descarga/" . $carpetaNombre;

// Verifica si la carpeta ya existe antes de crearla
if (!file_exists($carpetaRuta)) {
    // Crea la carpeta con permisos adecuados (por ejemplo, 0755)
    mkdir($carpetaRuta, 0755, true);
    $mensaje = "Carpeta '$carpetaNombre' creada con éxito.";
} else {
    $mensaje = "La carpeta '$carpetaNombre' ya existe.";
}

// Luego, cuando se procese un archivo, guárdalo en la carpeta creada
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $archivos = $_FILES['archivos'];

    foreach ($archivos['name'] as $index => $nombreArchivo) {
        $nombreArchivo = str_replace(' ', '_', $nombreArchivo);
        if (move_uploaded_file($archivos['tmp_name'][$index], $carpetaRuta . '/' . $nombreArchivo)) {
            echo "Archivo '$nombreArchivo' subido con éxito.<br>";
        } else {
            echo "Error al subir el archivo '$nombreArchivo'.<br>";
        }
    }
}
?>