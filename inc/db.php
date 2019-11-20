<?php
$conn = mysqli_connect('localhost', 'root', '', 'apa');
if (!$conn) {
	echo "Error connceting to database " . errorno();
}
date_default_timezone_set("Africa/Nairobi");