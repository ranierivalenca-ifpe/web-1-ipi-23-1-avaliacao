<?php
define('DB_HOST', '127.0.0.1');
define('DB_PORT', '3306');
define('DB_NAME', 'web_1_ipi_23_1_api');
define('DB_USER', 'root');
define('DB_PASS', 'root');

$dsn = 'mysql:dbname=' . DB_NAME . ';host=' . DB_HOST . ';port=' . DB_PORT;

$pdo = new PDO($dsn, DB_USER, DB_PASS);
