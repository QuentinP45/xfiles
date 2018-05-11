<?php include('inc/head.php');

///// SI JE VEUX SUPPRIMER UN FICHIER /////
if (isset($_POST['unlink']) !== 0) {
    if (unlink($_POST['unlink'])) {
        $success = "Le fichier a été correctement supprimé";
        $_POST['unlink'] = 0;
    } else {
        $error = 'Le fichier n\'a pas été supprimé';
    }
}

///// SI JE VEUX SUPPRIMER UN DOSSIER /////
if (isset($_POST['unlinkDirectory'])) {
    $dir = $_POST['unlinkDirectory'];
    function delete($dir)
    {
        if (is_dir($dir)) {
            $objects = scandir($dir);
            foreach ($objects as $object) {
                if ($object != "." && $object != "..") {
                    if (is_dir($dir . '/' . $object)) {
                        delete($dir . '/' . $object);
                    } else {
                        unlink($dir . '/' . $object);
                    }
                }
            }
            (rmdir($dir));
        }
    }
}

///// SI JE VEUX EDITER UN FICHIER/////
if (isset($_POST['content'])) {
    $getFileToModify = $_POST['filePath'];
    $fileToModify = fopen($getFileToModify, "w");
    fwrite($fileToModify, $_POST['content']);
    fclose($fileToModify);
    $success = 'Votre fichier a bien été édité';
}
?>
<div>
    <p>Voici le contenu de mes répertoires et fichiers :</p>
    <form action="index.php" method="POST">
        <?php
        ///// MON BACK OFFICE /////
        $rootDirectory = 'files';
        $files = array_diff(scandir($rootDirectory), ['..', '.']);
        $files_n = count(scandir($rootDirectory));

        $i = 2;
        while ($i < $files_n) {
            if (is_dir($rootDirectory . '/' . $files[$i])) {
                ?>
                <p>Dossier : <?= $files[$i] . '<br/>'; ?></p>
                <button type="submit" class="btn btn-default">Supprimer tout le dossier</button>
                <input type="hidden" name="unlinkDirectory" value="<?= $rootDirectory . '/' . $files[$i]; ?>"/>
                <?php
                $subRootDirectory = $rootDirectory . '/' . $files[$i];
                $subFiles = array_diff(scandir($subRootDirectory), ['..', '.']);
                $subFiles_n = count(scandir($subRootDirectory));

                $si = 2;
                while ($si < $subFiles_n) {
                    if (is_dir($subRootDirectory . '/' . $subFiles[$si])) {
                        ?>
                        <p>- Dossier : <?= $subFiles[$si] . '<br/>'; ?></p>
                        <button type="submit" class="btn btn-default">Supprimer tout le dossier</button>
                        <input type="hidden" name="unlinkDirectory"
                               value="<?= $subRootDirectory . '/' . $subFiles[$si]; ?>"/>
                        <?php
                        $lastRootDirectory = $subRootDirectory . '/' . $subFiles[$si];
                        $lastFiles = array_diff(scandir($lastRootDirectory), ['.', '..']);
                        $lastFiles_n = count(scandir($lastRootDirectory));

                        $li = 2;
                        while ($li < $lastFiles_n) {
                            if (is_dir($lastRootDirectory . '/' . $lastFiles[$li])) {
                                ?>
                                <p>--- Dossier : <?= $lastFiles[$li] . '<br/>'; ?></p>
                                <button type="submit" class="btn btn-default">Supprimer tout le dossier</button>
                                <input type="hidden" name="unlinkDirectory"
                                       value="<?= $lastRootDirectory . '/' . $lastFiles[$li]; ?>"/>
                                <?php
                            } else {
                                ?>
                                <p>
                                    <a href="?f=<?= $lastRootDirectory . '/' . $lastFiles[$li]; ?>"><?= "--- fichier : $lastFiles[$li]"; ?></a>
                                    <button type="submit" class="btn btn-default">Supprimer</button>
                                    <input type="hidden" name="unlink"
                                           value="<?= $lastRootDirectory . '/' . $lastFiles[$li]; ?>"/>
                                </p>
                                <?php
                            }
                            $li++;
                        }
                    } else {
                        ?>
                        <p>
                            <a href="?f=<?= $subRootDirectory . '/' . $subFiles[$si]; ?>"><?= "- fichier : $subFiles[$si]"; ?></a>
                            <button type="submit" class="btn btn-default">Supprimer</button>
                            <input type="hidden" name="unlink"
                                   value="<?= $subRootDirectory . '/' . $subFiles[$si]; ?>"/>
                        </p>
                        <?php
                    }
                    $si++;
                }
            } else {
                ?>
                <p><a href="?f=<?= $rootDirectory . '/' . $files[$i]; ?>"><?= "fichier : $files[$i]"; ?></a></p>
                <input type="hidden" name="unlink" value="<?= $rootDirectory . '/' . $files[$i]; ?>"/>
                <?php
            }
            $i++;
        }
        ?>
    </form>
</div>
<div>
    <?php
    ///// CONTRÔLE DE L'EXTENSION AVANT D'EDITER /////
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
    ?>
    <form action="index.php" method="post">
        <textarea name="content">
            <?php if (isset($success)) {
                echo $success;
            } else if (isset($error)) {
                echo $error;
            }; ?>
            <?php if (isset($contentCurrentFile)) {
                echo ltrim($contentCurrentFile);
            };
            ?>
        </textarea>
        <input type="submit" name="submit" value="Enregistrer"/>
        <input type="hidden" name="filePath" value="<?php if (isset($filePath)) echo $filePath; ?>"/>
    </form>
</div>
<?php include('inc/foot.php'); ?>                                                                                                