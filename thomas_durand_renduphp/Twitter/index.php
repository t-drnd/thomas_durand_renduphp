<?php 

require_once 'config.php';

try {
    $user = isset($_GET['user']) ? $_GET['user'] : 'Utilisateur inconnu';
    $nombreTweets = isset($_GET['tweets']) ? (int)$_GET['tweets'] : 1;

    $request = $database->prepare(
        'SELECT tweet.message, user.pseudo FROM tweets
        LEFT JOIN user ON users.id = tweets.author_id
        ORDER BY tweets.id DESC'
    );

    $request->execute();
    $tweets = $request->fetchAll(
        PDO::FETCH_ASSOC
    );

    require_once 'index.html.php';
}catch(PDOException $e) {
    die('Erreur: ' . $e->getMessage());
}