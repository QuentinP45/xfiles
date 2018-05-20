<?php
include('inc/head.php');
include('inc/branch/deleteFile.php');
include('inc/branch/editContent.php');
include('inc/branch/deleteDirectory.php');
?>
<div>
    <p>Voici le contenu de mes répertoires et fichiers :</p>
    <form action="index.php" method="POST">
        <?php include('inc/branch/backOffice.php'); ?>
    </form>
</div>
<div>
    <?php include('inc/branch/getContent.php'); ?>
    <form action="index.php" method="post">
        <textarea name="content">
            <?php include('inc/branch/showContent.php'); ?>
        </textarea>
        <input type="submit" name="submit" value="Enregistrer"/>
        <input type="hidden" name="filePath" value="<?php if (isset($filePath)) echo $filePath; ?>"/>
    </form>
</div>
<?php include('inc/foot.php'); ?>                                                                                                