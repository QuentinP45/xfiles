<?php
if (isset($_GET['f'])) {
    $checkFileExtension = pathinfo($_GET['f'], PATHINFO_EXTENSION);
    if (!in_array($checkFileExtension, ['jpg'])) {
        $filePath = $_GET['f'];
        $contentCurrentFile = file_get_contents($filePath);
    } else {
        $error = 'Le fichier sélectionné ne peut pas être édité';
    }
} else {
    $error = 'Sélectionnez un fichier .txt ou .html pour éditer son contenu';
}