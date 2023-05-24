<?php

// Require all the files
require_once 'config.php';

$config = new config();

$config->handleFormSubmission($_POST);

exit();