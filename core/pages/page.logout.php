<?php

$_SESSION = array();

session_destroy();

header( "refresh:2.5;url=index.php?page=login" );

?>

<div class="msg success">You have logged out. You will now be redirected to the login page. </div>

