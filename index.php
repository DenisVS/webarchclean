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
  $lenghtOfPath = mb_strlen($argv[1]);
  $pos = mb_strpos($argv[1], "/", $lenghtOfPath); // Есть ли в последней позиции слэш
  if ($pos === false) {
    echo "Символ / не найден\n";
  }
  else {
    echo "Символ / найден\n";
    echo " в позиции $pos";
  }
  $indir = $argv[1];
  echo 'Директория исходных файлов ' . $indir . "\n";
}
else {
  echo "Введите директорию с исходными файлами\n";
  exit();
}

if (isset($argv[2])) {
  $outdir = $argv[2];
  echo 'Директория с обработанными файлами ' . $outdir . "\n";
}
else {
  echo "Введите директорию с обработанными файлами\n";
  exit();
}


include 'include/functions.php';

$sourceFiles = (getFileList($indir, TRUE));

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

