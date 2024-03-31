<?php 
    $data = [
        'suppForm' => $_POST['supp']
    ];

    $supp = $request->prepare('DELETE FROM tweets WHERE tweet_id = :suppForm');
    $supp->execute($data)