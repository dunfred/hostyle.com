<?php
include 'linearRegession.php';


#define datasets
$steps    = [500,1000,1500,2000,2500,3000,3500,4000,4500,5000];
$distance = [0.40,0.80,1.21,2.61,2.01,2.41,2.82,3.22,3.62,4.02];

$x = $distance;
$y = $steps;


echo Predict_liner_Regression(4.02,$x,$y).'<br>';

echo accuaracy($x,$y);





