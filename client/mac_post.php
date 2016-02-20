<?php
/* Somente testes */
print_r($_POST);

$fp = fopen('data_' . date('His') . '.txt', 'w');

foreach ($_POST as $value) {
	fwrite($fp, $value);
}

fclose($fp);
?>