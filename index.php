<?php
// コードベースのファイルのオートロード
spl_autoload_extensions(".php"); 
spl_autoload_register();

// composerの依存関係のオートロード
require_once 'vendor/autoload.php';

use Helpers\RandomGenerator;

// RestaurantChainの生成
$restaurantChain = RandomGenerator::createObjects(2,5,'Helpers\RandomGenerator::restaurantChain');
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
        <article>
            <header>Restaurant Chain Name</header>
            <details>
                <summary role="button" class="secondary">Local Name1</summary>
                <p>Company information</p>
                <div>
                    <h4>Employees:</h4>
                    <ul>
                        <li>user1</li>
                        <li>user2</li>
                    </ul>
                </div>
            </details>
            <details>
                <summary role="button" class="secondary">Local Name2</summary>
                <p>Company information</p>
            </details>
        </article>
    </main>
</body>
</html>