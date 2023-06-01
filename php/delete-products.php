<?php
session_start();

// Include the config file
require_once 'config.php';

$config = new config();

$config->handleFormSubmission($_POST, 'delete');

exit();
?>