<?php
if (isset($_POST['contenu'])){
$fichier = "../index.php";
$file = fopen($fichier, "w");
fwrite($file, $_POST['contenu']);
fclose($file);
}
?>
<?php include('../inc/head.php'); ?>

    <div id="contenu">

        <?php
        $fichier = "../index.php";
        $contenu = file_get_contents($fichier);
        ?>

        <form method="POST" action="">
            <div class="form-group">
                <textarea name="contenu" class="form-control" style="width: 100%; height: 200px;">
                    <?= $contenu; ?>
                </textarea>
                <button type="submit" class="btn btn-default"class="form-control">Sauvegarder</button>
            </div>
        </form>
    </div>

<?php include('../inc/foot.php'); ?>