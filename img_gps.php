<?php
function get_lat_long($str)
{
    $values = array();
    $values[0] =preg_filter('/.*=(-?[0-9]+).[0-9], (-?[0-9]+).[0-9], (-?[0-9]+).[0-9]+/', '$1', $str); 
    $values[1] =preg_filter('/.*=(-?[0-9]+).[0-9], (-?[0-9]+).[0-9], (-?[0-9]+).[0-9]+/', '$2', $str); 
    $values[3] =preg_filter('/.*=(-?[0-9]+).[0-9], (-?[0-9]+).[0-9], (-?[0-9]+).[0-9]+/', '$3', $str);
    return ((double)$values[0] + (double)$values[1]/60 + (double)$values[3]/(double)1000000/(double)3600);
}

if (file_exists($argv[1]) == 0)
{
    echo "File not found...\n";
    exit();
}

$image = $argv[1];
$result = shell_exec("identify -format '%[EXIF:*]' " . "'". $argv[1] . "'" . " | grep \".*Latitude.*\|.*Longitude.*\"");
if (!$result)
{
    echo "There is no GPS data :/ \n";
    exit();
}
$result = explode("\n", $result);
$latitude = get_lat_long($result[0]);
$longitude = get_lat_long($result[2]);
if (preg_filter('/.*=([A-Z])/', '$1', $result[1]) == "S")
    $latitude = -$latitude;
if (preg_filter('/.*=([A-Z])/', '$1', $result[3]) == "W")
    $longitude = -$longitude;
echo "Latitude = " . $latitude . "\n";
echo "Longitude = " . $longitude . "\n";
echo "https://www.google.fr/maps/search/" . $latitude . "," . $longitude. "\n";

?>
