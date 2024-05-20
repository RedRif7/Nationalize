<?php
//TODO https://api.agify.io/?name=michael&country_id=US
$name = readline("Enter a name: \n");
$country = readline("Enter country: \n");
echo "------------------------------------------";
$urlAge = "https://api.agify.io/?name=$name&country_id=$country";
$urlGender = "https://api.genderize.io/?name=$name&country_id=$country";
$urlNation = "https://api.nationalize.io/?name=$name";
if($country === ""){
    $urlAge = "https://api.agify.io/?name=$name";
    $urlGender = "https://api.genderize.io/?name=$name";
    $urlNation = "https://api.nationalize.io/?name=$name";
}
$jsonAge    = file_get_contents( $urlAge );
$jsonGender = file_get_contents($urlGender);
$jsonNation = file_get_contents($urlNation);
$dataGender = json_decode($jsonGender);
$dataAge    = json_decode($jsonAge);
$dataNation = json_decode($jsonNation);

if(!$dataAge->age){
    echo "Name or Country not found, try again...\n";
    exit;
}
echo "\nName: $name\n";
echo "Age: $dataAge->age\n";
echo "Gender: ". ucfirst($dataGender->gender) .", probability of ". ($dataGender->probability)*100 . "%\n";
echo "Nationality: \n";
foreach ($dataNation->country as $chances){
    echo "Chance of being ". $chances->country_id . " is " . round($chances->probability*100,2)."\n";
}
if(!$country){
    echo "Chosen country: Global\n";
    return;
}
    echo "Chosen country: $dataAge->country_id\n";

