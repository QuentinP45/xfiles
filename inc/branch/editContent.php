<?php
if (isset($_POST['content'])) {
    $getFileToModify = $_POST['filePath'];
    $fileToModify = fopen($getFileToModify, "w");
    fwrite($fileToModify, $_POST['content']);
    fclose($fileToModify);
    $success = 'Votre fichier a bien été édité';
}