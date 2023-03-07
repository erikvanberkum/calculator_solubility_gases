<?php
/**
 *  version 1 20230703
 * # Solubility of Oxygen in Water
 * This algorithm gives the solubility of Oxygen in water at a given salinity,
 * at a specific temperature and at any given pressure. Salinity of 0 and atmospheric pressure
 * are set as the default.
 *
 *  source https://www.colby.edu/chemistry/CH331/O2%20Solubility.html
 *
 * # currently just run in the terminal
 * */


// $temp = 1; // degrees celsius
$salt = 0; // salinity 0 is normal water 35 is seawater
$pressure_array = array  ("100kpa" => 750.06, "140kpa" => 1050.08, "200kpa" => 1500.12, "300kpa" => 2550.19,
                    "400kpa" => 3000.25, "500kpa" => 3750.31, "600kpa" => 4500.37);

//$solubility= calsolu($temp,$salt,$pressure);
//$solubilityMessage = "The Solubility is: /n";
//$solubilityMessage .=    "\n" . $solubility . " uM";
//$solubilityMessage .=    "\n" . $solug . " mg/l";
//$solubilityMessage .=    "\n" . $solum . " ml/l";


function calsolu ($temp,$salt,$pressure) {

    $tempr = floatval($temp) + 273.15;
    $first  = -173.9894 + (255.5907*100/$tempr);
    $second = $first + (146.4813 * log(($tempr)/100)) - (22.204*(floatval($tempr)/100));
    $sal = floatval($salt);
    $third = $second +  $sal*(-0.037362 + 0.016504*$tempr/100-0.0020564*pow($tempr/100,2));
    $fourth = exp($third);
    $pre = floatval($pressure);
    $sol = $fourth*$pre/760;
    return $sol;

}
echo "\n";
foreach ($pressure_array as $kpa => $pressure) {
    echo $kpa . "\n";
    for ($temp = 0; $temp <= 30;) {

    $solubility= calsolu($temp,$salt,$pressure);
    $tempr = floatval($temp) + 273.15;
    $solug = $solubility*32/1000;
    $solum = $solubility*0.000001*0.08206*$tempr*1000;
    echo $temp . " °C | ". $solug ." mg/l \n";
    $temp++;
} }

