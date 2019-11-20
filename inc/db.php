<?php
if ($_SERVER['DOCUMENT_ROOT'] == '/var/www/html') {
	$conn = mysqli_connect('localhost', 'root', 'VDW-pNs-Mk6-gLQ', 'apa_website');
} elseif ($_SERVER['DOCUMENT_ROOT'] == 'C:/xampp/htdocs') {
	$conn = mysqli_connect('localhost', 'root', '', 'apa');
} else {
	$conn = mysqli_connect('localhost', 'root', '', 'apa');
}
if (!$conn) {
	echo "Error connceting to database: " .  mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
}
date_default_timezone_set("Africa/Nairobi");
