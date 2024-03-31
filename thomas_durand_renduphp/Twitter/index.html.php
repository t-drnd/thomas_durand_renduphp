<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Mini Twitter</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="container">
        <nav>
            <ul>
                <li><a href="#">Accueil</a></li>
                <li><a href="#">Explorer</a></li>
                <li><a href="#">Notifications</a></li>
                <li><a href="#">Messages</a></li>
                <li><a href="#">Profil</a></li>
            </ul>
        </nav>
        <section class="feed">
            <?php if(!empty($user)): ?>
                <h3>Je suis <?= $user ?></h3>
            <?php endif; ?>
            <form id="tweetForm" action="action.php" method="POST">
                <?php if(!empty($user)): ?>
                    <input type="hidden" name="user" value="<?= $user ?>">
                <?php endif; ?>
                <textarea placeholder="Quoi de neuf ?" name="message"></textarea>
                <button type="submit">Tweeter</button>
            </form>
            <div class="tweets">
            <?php
            $twittertweet = [
                ['tweet' => 'Premier tweet'],
                ['tweet' => 'Deuxième tweet'],
                ['tweet' => 'Troisième tweet'],
            ];
            $twitterUsername = "user";
            $twitterUsername = $_GET['user']; ?>
            <?php echo '@' . $twitterUsername; ?>
            <h2>Le nombres de tweets de <?php echo '@' . $twitterUsername; ?> est de <?php echo count($twittertweet); ?></h2>
            </div>
            <?php 
            if(isset($tweets) && is_array($tweets)){
                foreach($tweets as $tweet) { ?>
                <div class="feed-content-card">
                    <p class="tweet"><?= $tweet['tweet'] ?></p>
                    <form action="delete.php" method="POST">
                        <input type="hidden" name="supp" value="<?= $tweet['tweet_id'] ?>">
                        <button type="submit">Supprimer</button>
                    </form>
                </div>
            <?php 
                }
            }else {
                echo "Aucun tweet à afficher.";
            }
         ?>
        </section>
    </div>
</body>
</html>
