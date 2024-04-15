<?php
//exec("/home/al/.venv/bin/python3.10 /var/www/html/py/get_text.py");

//$command = escapeshellcmd('/var/www/html/coinzilla-1/test/get_text.py');
$command = escapeshellcmd('/home/al/.venv/bin/python3.10 /var/www/html/py/get_text.py');
//$command = escapeshellcmd('/var/www/html/py/get_text.py');
//$command = escapeshellcmd('whoami');
//$command = escapeshellcmd('python3.10 pwd');
$output = shell_exec($command);
echo $output;
//if(function_exists(disable_functions
//}
$huy = null;

//function exec_enabled() {
//    $disabled = explode(',', ini_get('disable_functions'));
//    return !in_array('exec', $disabled);
//}
//
//$kk = exec_enabled();
//$huy = null;
