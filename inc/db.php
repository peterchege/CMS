<?php
$conn = mysqli_connect('localhost', 'root', '', 'apa');
if (!$conn) {
	echo "Error connceting to database " . errorno();
}
date_default_timezone_set("Africa/Nairobi");
echo '<h1>'.$_SERVER['DOCUMENT_ROOT'].'</h1><br>';
echo '<h1>'.$_SERVER['HTTP_HOST'].'</h1>';