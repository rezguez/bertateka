<?php
$session_options = array();
session_start($session_options);
session_destroy();
header("Location: index.php");