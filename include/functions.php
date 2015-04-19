<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

function getFileList($dir, $recurse = false, $depth = false) {
  // массив, хранящий возвращаемое значение
  $retval = array();

  // добавить конечный слеш, если его нет
  if (substr($dir, -1) != "/")
    $dir .= "/";

  // указание директории и считывание списка файлов
  $d = @dir($dir) or die("getFileList: Не удалось открыть каталог $dir для чтения");
  while (false !== ($entry = $d->read())) {

    // пропустить скрытые файлы
    if ($entry[0] == ".")
      continue;
    if (is_dir("$dir$entry")) {
      $retval[] = array(
        "name" => "$dir$entry/",
        "size" => 0,
        "lastmod" => filemtime("$dir$entry")
      );
      if ($recurse && is_readable("$dir$entry/")) {
        if ($depth === false) {
          $retval = array_merge($retval, getFileList("$dir$entry/", true));
        }
        elseif ($depth > 0) {
          $retval = array_merge($retval, getFileList("$dir$entry/", true, $depth - 1));
        }
      }
    }
    elseif (is_readable("$dir$entry")) {
      $retval[] = array(
        "name" => "$dir$entry",
        "size" => filesize("$dir$entry"),
        "lastmod" => filemtime("$dir$entry")
      );
    }
  }
  $d->close();

  return $retval;
}
