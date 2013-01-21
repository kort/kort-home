<?php
$redirectUrl = 'http://' . $_SERVER['HTTP_HOST'];
if($_SERVER['HTTP_HOST'] == 'localhost') {
    $redirectUrl .= '/kort-home';
}
$redirectUrl .= '/presentation/idw.html';

header('Location: ' . $redirectUrl);
