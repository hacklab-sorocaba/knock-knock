#!/bin/sh
cd /var/www/knock
echo 'Executando NMAP...'
nmap -n -sP 192.168.0.0/24 | egrep -i '(MAC)' > mac_list.dat
echo 'Executando PHP...'
php mac_log.php
