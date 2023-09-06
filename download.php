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


// employeesの生成

// restaurantLocationの生成


// RestaurantChainsの生成
// $restaurantChains = RandomGenerator::createObjects(2,5,'Helpers\RandomGenerator::restaurantChain');





// ユーザーを生成
$users = RandomGenerator::users($count, $count);

// 検証
if (is_null($count) || is_null($format)) {
    exit('Missing parameters.');
}

if (!is_numeric($count) || $count < 1 || $count > 100) {
    exit('Invalid count. Must be a number between 1 and 100.');
}

$allowedTypes = ['json', 'txt', 'html', 'md'];
if (!in_array($format, $allowedTypes)) {
    exit('Invalid type. Must be one of: ' . implode(', ', $allowedTypes));
}

if ($format === 'markdown') {
    header('Content-Type: text/markdown');
    header('Content-Disposition: attachment; filename="users.md"');
    foreach ($users as $user) {
        echo $user->toMarkdown() . "\n";
    }
} elseif ($format === 'json') {
    header('Content-Type: application/json');
    header('Content-Disposition: attachment; filename="users.json"');
    $usersArray = array_map(fn($user) => $user->toArray(), $users);
    echo json_encode($usersArray);
} elseif ($format === 'txt') {
    header('Content-Type: text/plain');
    header('Content-Disposition: attachment; filename="users.txt"');
    foreach ($users as $user) {
        echo $user->toString();
    }
} else {
    // HTMLをデフォルトに
    header('Content-Type: text/html');
    foreach ($users as $user) {
        echo $user->toHTML();
    }
}