<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/* на будущее, блок подключение файлов в директории
$includeDir = "include/functions";
$dh = opendir($includeDir);
while ($filename = readdir($dh)) {
  $filename = $includeDir . "/" . $filename;
  include_once($filename);
}
*/


if (isset($argv[1])) {
	$workdir = $argv[1];
    echo 'Обрабатываем директорию ' . $workdir ."\n";
}	else
{
	echo "Введите директорию с файлами\n";

}

include 'include/functions.php';

print_r (getFileList ($workdir, TRUE));

  