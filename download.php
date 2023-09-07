<?php
// コードベースのファイルのオートロード
spl_autoload_extensions(".php"); 
spl_autoload_register();

// composerの依存関係のオートロード
require_once 'vendor/autoload.php';

use Helpers\RandomGenerator;

// POSTリクエストからパラメータを取得
$numberOfEmployees = $_POST['numberOfEmployees'];
$minSalary = $_POST['minSalary'];
$maxSalary = $_POST['maxSalary'];
$startZipCode = $_POST['startZipCode'];
$endZipCode = $_POST['endZipCode'];
$format = $_POST['format'];

// パラメータが正しい形式であることを確認
$numberOfEmployees = (int)$numberOfEmployees;
$minSalary = (int)$minSalary;
$maxSalary = (int)$maxSalary;
$startZipCode = (int)$startZipCode;
$endZipCode = (int)$endZipCode;

validateNumberOfEmployees($numberOfEmployees);
validateSalary($minSalary, $maxSalary);
validateZipCode($startZipCode, $endZipCode);
validateFormat($format);

// 検証
function validateNumberOfEmployees(int $numberOfEmployees): bool{
    if(is_null($numberOfEmployees)){
        exit('Missing parameters.');
    }if(!is_numeric($numberOfEmployees) || $numberOfEmployees < 1 || $numberOfEmployees > 100){
        exit('Invalid count. Must be a number between 1 and 100.');
    }

    return true;
}

function validateSalary(int $minSalary, int $maxSalary) : bool {
    if(is_null($minSalary) || is_null($maxSalary)){
        exit('Missing parameters.');
    }if(!is_numeric($minSalary) || $minSalary < 1 || $minSalary > 100000){
        exit('Invalid salary. Must be a number between 1 and 100000.');
    }if(!is_numeric($maxSalary) || $maxSalary < 1 || $maxSalary > 100000){
        exit('Invalid salary. Must be a number between 1 and 100000.');
    }if($minSalary > $maxSalary){
        exit('Invalid salary. Must be the max value larger than a min value.');
    }
    return true;
}

function validateZipCode(int $startZipCode, int $endZipCode) : bool {
    if(is_null($startZipCode) || is_null($endZipCode)){
        exit('Missing parameters.');
    }if(!is_numeric($startZipCode) || $startZipCode < 0 || $startZipCode > 99999){
        exit('Invalid zip code. Must be a number between 0 and 99999.');
    }if(!is_numeric($endZipCode) || $endZipCode < 0 || $endZipCode > 99999){
        exit('Invalid zip code. Must be a number between 0 and 99999.');
    }if($startZipCode > $endZipCode){
        exit('Invalid zip code.Must be a start value larger than a end value.');
    }
    return true;
}

function validateFormat(string $format) : bool {
    $allowedTypes = ['html', 'markdown', 'json', 'txt'];
    if (!in_array($format, $allowedTypes)) {
        exit('Invalid type. Must be one of: ' . implode(', ', $allowedTypes));
    }

    return true;
}


$min = 2;
$max = 7;

// RestaurantChainsの生成
$restaurantChains = RandomGenerator::makeRestaurantChains($min, $max, $numberOfEmployees, $minSalary, $maxSalary, $startZipCode, $endZipCode);

if ($format === 'markdown') {
    header('Content-Type: text/markdown');
    header('Content-Disposition: attachment; filename="restaurantChains.md"');
    foreach ($restaurantChains as $restaurantChain) {
        echo $restaurantChain->toMarkdown() . "\n";
    }
} elseif ($format === 'json') {
    header('Content-Type: application/json');
    header('Content-Disposition: attachment; filename="restaurantChains.json"');
    $restaurantChainsArray = array_map(fn($restaurantChain) => $restaurantChain->toArray(), $restaurantChains);
    echo json_encode($restaurantChainsArray);
} elseif ($format === 'txt') {
    header('Content-Type: text/plain');
    header('Content-Disposition: attachment; filename="restaurantChains.txt"');
    foreach ($restaurantChains as $restaurantChain) {
        echo $restaurantChain->toString();
    }
} else {
    // HTMLをデフォルトに
    header('Content-Type: text/html');
    foreach ($restaurantChains as $restaurantChain) {
        echo $restaurantChain->toHTML();
    }
}
?>