<?php
if (isset($_GET['uf'])) {
    if (file_exists($_GET['uf'])) {
        if (unlink($_GET['uf'])) {
            $success = "Le fichier a été correctement supprimé";
        } else {
            $error = 'Le fichier n\'a pas été supprimé';
        }
    }
}
