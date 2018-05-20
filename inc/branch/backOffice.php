<?php
$rootDirectory = 'files';
$files = array_diff(scandir($rootDirectory), ['..', '.']);
$files_n = count(scandir($rootDirectory));
$i = 2;
while ($i < $files_n) {
    if (is_dir($rootDirectory . '/' . $files[$i])) {
        ?>
        <p>Dossier : <?= $files[$i]; ?><a href="?dd=<?= $rootDirectory . '/' . $files[$i]; ?>"
                                          style="text-decoration: none; color: red">-x-</a></p>
        <?php
        $subRootDirectory = $rootDirectory . '/' . $files[$i];
        $subFiles = array_diff(scandir($subRootDirectory), ['..', '.']);
        $subFiles_n = count(scandir($subRootDirectory));
        $si = 2;
        while ($si < $subFiles_n) {
            if (is_dir($subRootDirectory . '/' . $subFiles[$si])) {
                ?>
                <p>- Dossier : <?= $subFiles[$si] ?><a href="?dd=<?= $subRootDirectory . '/' . $subFiles[$si]; ?>"
                                                       style="text-decoration: none; color: red">-x-</a></p>
                <?php
                $lastRootDirectory = $subRootDirectory . '/' . $subFiles[$si];
                $lastFiles = array_diff(scandir($lastRootDirectory), ['.', '..']);
                $lastFiles_n = count(scandir($lastRootDirectory));
                $li = 2;
                while ($li < $lastFiles_n) {
                    if (is_dir($lastRootDirectory . '/' . $lastFiles[$li])) {
                        ?>
                        <p>--- Dossier : <?= $lastFiles[$li] ?><a
                                    href="?dd=<?= $lastRootDirectory . '/' . $lastFiles[$li]; ?>"
                                    style="text-decoration: none; color: red">-x-</a></p>
                        <?php
                    } else {
                        ?>
                        <p><a href="?f=<?= $lastRootDirectory . '/' . $lastFiles[$li]; ?>"
                              style="text-decoration: none; color: yellow;"><?= "--- fichier : $lastFiles[$li]"; ?></a><a
                                    href="?uf=<?= $lastRootDirectory . '/' . $lastFiles[$li]; ?>"
                                    style="text-decoration: none; color: red">-x-</a></p>
                        <?php
                    }
                    $li++;
                }
            } else {
                ?>
                <p><a href="?f=<?= $subRootDirectory . '/' . $subFiles[$si]; ?>"
                      style="text-decoration: none; color: yellow;"><?= "- fichier : $subFiles[$si]"; ?></a><a
                            href="?uf=<?= $subRootDirectory . '/' . $subFiles[$si]; ?>"
                            style="text-decoration: none; color: red">-x-</a></p>
                <?php
            }
            $si++;
        }
    } else {
        ?>
        <p><a href="?f=<?= $rootDirectory . '/' . $files[$i]; ?>"
              style="text-decoration: none; color: yellow;"><?= "fichier : $files[$i]"; ?></a><a
                    href="?uf=<?= $rootDirectory . '/' . $files[$i]; ?>" style="text-decoration: none">-x-</a></p>
        <?php
    }
    $i++;
}