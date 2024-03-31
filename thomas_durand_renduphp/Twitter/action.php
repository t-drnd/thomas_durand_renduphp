<?php
    
try{
    $database = new PDO ( 'mysql:host=localhost;dbname=twitter', 'root', 'root');
} catch (PDOException $e) {
    die( 'Site indisponible');

    if ($_SERVER['REQUEST_METHOD' ] ==='POST'){
        $redirect = 'Location: /index.php';
    }
        if(isset($_POST['message'])&& !empty($_POST['message'])) {
            $message = $_POST['message'];
            $userId = null;
        }else {
            exit("le message est vide.");
        }

        if(isset($_POST['user'])&& !empty($_POST['user'])) {
            $user = $_POST['user'];

            $request = $database->prepare(
                'SELECT id FROM users WHERE pseudo = :pseudo'
            );
            $request->execute([
                'pseudo' => $user
            ]);
            $userId = $request->fetchColumn();
        }   else{
            $userId = null;
        }

        if($userId) {
            $request = $database->prepare(
                'INSERT INTO tweets (message, author_id) VALUES (:message, :author_id)'
            );
            $request->execute([
                'message' => $message,
                'author_id' => $userId
            ]);
        }else {
            $request = $database->prepare(
                'INSERT INTO tweet (message) VALUES (:message)'
            );
            $request->execute([
                'message' => $message
            ]);
        }

        header('Location: index.html.php');
        exit();

}