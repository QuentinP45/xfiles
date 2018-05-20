<?php
if (isset($success)) {
    echo $success;
} else if (isset($error)) {
    echo $error;
}

if (isset($contentCurrentFile)) {
    echo ltrim($contentCurrentFile);
}