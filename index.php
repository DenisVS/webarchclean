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

include 'include/functions.php';

if (isset($argv[1])) {
  $pos = mb_strpos($argv[1], "/", mb_strlen($argv[1]) - 1); // Есть ли в последней позиции слэш
  if ($pos === false) {
    $inDir = $argv[1];
  }
  else {
    $inDir = substr($argv[1], 0, mb_strlen($argv[1]) - 1);    // отрубаем последний слэш     
  }
  echo 'Директория исходных файлов ' . $inDir . "\n";
}
else {
  echo "Введите директорию с исходными файлами\n";
  exit();
}

if (isset($argv[2])) {
  $pos = mb_strpos($argv[2], "/", mb_strlen($argv[2]) - 1); // Есть ли в последней позиции слэш
  if ($pos === false) {
    $outDir = $argv[2];
  }
  else {
    $outDir = substr($argv[2], 0, mb_strlen($argv[2]) - 1);    // отрубаем последний слэш     
  }
  echo 'Директория с обработанными файлами ' . $outDir . "\n";
}
else {
  echo "Введите директорию с обработанными файлами\n";
  exit();
}

$sourceFiles = (getFileList($inDir, TRUE)); // получаем листинг

//цикл вывода всего массива непустых файлов
for ($i = 0; $i < count($sourceFiles); $i++) {
  if ($sourceFiles[$i]['size'] > 0) {
    echo "Обрабатывается " . $sourceFiles[$i]['name'] . "\n";

    $textFile = fopen($sourceFiles[$i]['name'], "r");  //открываем файл на чтение
    if (!$textFile) {  //если файл не открывается
      echo "\nОшибка открытия файла!\n";
      exit(); //выходим
    }
    //читаем файл
    $count = 0;
    while (!feof($textFile)) {  //пока не дошли до конца файла 
      $aText[$count] = fgets($textFile);
      echo $aText[$count];
      echo "\n";
      $count = $count + 1;
    }




    //$targetFile = fopen($file,'a') or die("can't open file");
    //fwrite($targetFile, "Это строка".";"); //выводим в файл



    fclose($textFile); //закрываем
  }
}

