<?php
    // Ecrivez le code PHP ici
    if(isset($_FILES['image']) && $_FILES['image']['error'] === 0){
        // Est-ce que l'image est trop lourde?
        if($_FILES['image']['size'] <= 3000000){
            // verifier si l'extension est ok
            $informationsImage = pathinfo($_FILES['image']['name']);
            $extensionImage = $informationsImage['extension'];
            $extensionArray = ['png','gif','jpg','jpeg'];
            // on verifie si l'extension est bien dans notre tableau
            if(in_array($extensionImage, $extensionArray)){
                $newImgName = time().rand().rand().'.'.$extensionImage;
                move_uploaded_file($_FILES['image']['tmp_name'], 'uploads/'.$newImgName);
                $send = true;
            }
        }
    }
?>

<html>
    <head>
        <meta charset="utf-8" />
        <link rel="stylesheet" href="css/default.css">
        <link rel="icon" type="image/png" href="images/favicon.png">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
        <title>ShareFiles - Hébergez gratuitement vos images et en illimité</title>
    </head>
    <body>

        <header>
            <a href="../">
                <span>ShareFiles</span>
            </a>
        </header>

        <section>
            <h1> <?php
                 if(isset($send) && $send){
                     echo '<img src="uploads/'.$newImgName.'" " alt="ShareFiles" style="max-width: 75%">';

                 } else {
                     echo '<i class="fas fa-paper-plane"></i>';
                 }
                 ?>
            </h1>
            <?php if(isset($send) && $send){ ?>

                <h2> Fichier envoyé avec succés!</h2>
                <p>Retrouvez ci-dessous le lien vers votre fichier</p>
                <input type="text" id="link" value="http://localhost/uploads/<?=$newImgName ?>" readonly>
            
            <?php } else { ?>

                <form method="post" action="index.php" enctype="multipart/form-data">
                <p>
                    <label for="image">Sélectionnez votre fichier</label><br>
                    <input type="file" name="image" id="image">
                </p>
                <p id="send">
                    <button type="submit">Envoyer <i class="fas fa-long-arrow-alt-right"></i></button>
                </p>
            </form>
            
            <?php } ?>


        </section>
        
    </body>
</html>