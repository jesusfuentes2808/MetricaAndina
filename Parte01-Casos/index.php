<?php

require_once('./clases/ChangeString.php');
require_once('./clases/CompleteRange.php');
require_once('./clases/ClearPar.php');

$changeString  = new ChangeString();
$completeRange = new CompleteRange();
$clearPar      = new ClearPar();

echo "/***********************************************EJECRCICIO 01***********************************************/";
echo "<br/>";
echo $changeString->build("123 abcd*3");
echo "<br/>";
echo $changeString->build("**Casa 52");
echo "<br/>";
echo $changeString->build("**Casa 52Z");
echo "<br/>";


echo "/***********************************************EJECRCICIO 02***********************************************/";
echo "<br/>";
echo "<pre>";
var_dump($completeRange->build([1, 2, 4, 5]));
echo "</pre>";
echo "<br/>";

echo "<pre>";
var_dump($completeRange->build([2, 4, 9]));
echo "</pre>";
echo "<br/>";

echo "<pre>";
var_dump($completeRange->build([55, 58, 60]));
echo "</pre>";
echo "<br/>";

echo "/***********************************************EJECRCICIO 03***********************************************/";
echo "<br/>";
echo $clearPar->build("()())()");
echo "<br/>";
echo $clearPar->build("()(()");
echo "<br/>";
echo $clearPar->build(")(");
echo "<br/>";
echo $clearPar->build("((()");
echo "<br/>";

