<?php
function get_lat_long($str)
{
    $values = array();
    $values[0] =preg_filter('/.*=(-?[0-9]+).[0-9], (-?[0-9]+).[0-9], (-?[0-9]+).[0-9]+/', '$1', $str); 
    $values[1] =preg_filter('/.*=(-?[0-9]+).[0-9], (-?[0-9]+).[0-9], (-?[0-9]+).[0-9]+/', '$2', $str); 
    $values[3] =preg_filter('/.*=(-?[0-9]+).[0-9], (-?[0-9]+).[0-9], (-?[0-9]+).[0-9]+/', '$3', $str);
    return ((float)$values[0] + (float)$values[1]/60 + (float)$values[2]/1000000/3600);
}

$image = $argv[1];
$result = shell_exec("identify -format '%[EXIF:*]' " . $argv[1] . " | grep \".*Latitude.*\|.*Longitude.*\"");
$result = explode("\n", $result);
$latitude = get_lat_long($result[0]);
$longitude = get_lat_long($result[2]);
if (preg_filter('/.*=([A-Z])/', '$1', $result[1]) == "S")
    $latitude = -$latitude;
if (preg_filter('/.*=([A-Z])/', '$1', $result[3]) == "W")
    $longitude = -$longitude;
echo "Latitude = " . $latitude . "\n";
echo "Longitude = " . $longitude . "\n";
echo "https://www.google.fr/maps/search/" . $latitude . "," . $longitude

?>