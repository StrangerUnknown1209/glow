<?php
session_start();
//killing session
session_unset();
session_destroy();
header('Location: index.html');
exit();
?>