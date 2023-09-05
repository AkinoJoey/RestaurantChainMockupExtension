<?php
// コードベースのファイルのオートロード
spl_autoload_extensions(".php"); 
spl_autoload_register();

// composerの依存関係のオートロード
require_once 'vendor/autoload.php';

use Helpers\RandomGenerator;

// RestaurantChainsの生成
$restaurantChains = RandomGenerator::createObjects(2,5,'Helpers\RandomGenerator::restaurantChain');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@picocss/pico@1/css/pico.min.css">
    <title>Restaurant Chain Mockup</title>
</head>
<body>
    <main class="container">
        <?php foreach($restaurantChains as $restaurantChain): ?>
            <?php echo $restaurantChain->toHTML() ?>
        <?php endforeach ?>
    </main>
</body>
</html>