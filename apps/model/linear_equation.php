<?php
function getAverageY($Ys) {
    return array_sum($Ys)/count($Ys);
}
function getAverageX($Xs) {
    // assuming the first date is the starting date   
    return array_sum($Xs)/count($Xs);
}
function getSlope($Xs, $Ys) {
    $averageX = getAverageX($Xs);
    $averageY = getAverageY($Ys);

    $sum_a = 0;
    $sun_b = 0;
    for ($i =  0; $i < count($Xs); $i++) {
        $sum_a += ($Xs[$i] - $averageX) * ($Ys[$i] - $averageY);
        $sum_b += ($Xs[$i] - $averageX) * ($Xs[$i] - $averageX);
    }

    $slope = $sum_a/$sum_b;
    return $slope;
}

function getYIntercept($Xs, $Ys) {
    $intercept = getAverageY($Ys) - getSlope($Xs, $Ys) * getAverageX($Xs);
    return $intercept;
}




?>