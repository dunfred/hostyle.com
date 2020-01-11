<?php

# linear Regression PHP version 
#---------------------------------------
# author : | Richard Obiri             |
# date   : | 29th December             |
# Title  : | Linear Regression (ML)    |
#---------------------------------------


function mean($x)
{
    $total = count($x);

    $numerator = array_sum($x);

    $results = $numerator/$total;

    return $results;

}


# the gradient  (m = sum(x-x^)*(y-y^)/sum(x-x^)^2)
function m($x,$y)
{
    
    $tot = count($x);
    $x_mean = mean($x);
    $y_mean = mean($y);
    $numera = 0 ;
    $denum  = 0 ;
    for ($i=0; $i < $tot; $i++) {
        
           $numera += ($x[$i]-$x_mean)*($y[$i] - $y_mean);
           $denum  += ($x[$i] - $x_mean)**2;
           $m = $numera/$denum;
    }

   
    return $m;
}


# c intercept
function c($x,$y)
{
    
    $x_mean = mean($x);
    $y_mean = mean($y);
    $m = m($x,$y);
    $c = $y_mean - ($m * $x_mean);
    return $c;
}

# check Accuracy
function accuaracy($x,$y)
{
    $ss_t = 0;
    $ss_r = 0;
    $x_mean = mean($x);
    $y_mean = mean($y);
    $c = c($x,$y);
    $m = m($x,$y);
    $tot = count($x);

    for ($i=0; $i < $tot ; $i++) { 
          $y_predict = $c + $m*$x[$i];
          $ss_t +=($y[$i] - $y_mean)**2;
          $ss_r +=($y[$i] - $y_predict)**2;
    }
         $r2 = 1 - ($ss_r/$ss_t);
         return round($r2*100).'%';
}



# Predict the outcome
function Predict_liner_Regression($val,$x,$y){

     

    $m = m($x,$y);

    $c = c($x,$y);
    
    $predicty = $m*($val)+$c;

    return $predicty;
}


?>