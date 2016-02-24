<?php
$URL = 'http://knock.dev/server/welcome/setmac';

/* Leitura do arquivo de MACs */
$filename = "mac_list.dat";
$handle = fopen($filename, "r");
if ($handle) {
    while (($line = fgets($handle)) !== false) {
        $line = substr($line, 13, 17);
        $novo[] = $line;
    }

    fclose($handle);
}

$ch = curl_init();
curl_setopt($ch, CURLOPT_HEADER, true);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_URL, $URL);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query(
	array(
    	'mac_list' => $novo,
  		)
	)
); 
$response = curl_exec($ch);

echo $response;
?>