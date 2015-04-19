<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

if (isset($argv[1])) {
	$workdir = $argv[1];
    echo 'Обрабатываем директорию ' . $workdir ."\n";
}	else
{
	echo "Введите директорию с файлами\n";

}

