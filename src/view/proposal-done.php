<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="main.css">

    <title><?= t('head.title', isAuth()) ?></title>

    <style>
        #page > p {
            text-align: center;
            font-size: 2em;
        }
    </style>
</head>

<body>
<div id="page">

    <p>
    <?php if (locale('fr')) : ?>
        <strong>Merci <?= $user ?> pour ta proposition !</strong> Nous l'avons bien enregistrée.
        <br><br>
        N'hésite pas à proposer d'autres noms, pour la même chèvre ou pour une autre.
        Nous t'enverrons un email pour te dire laquelle de tes propositions nous avons finalement choisie !
        <br><br>
        <a href="/">Clique ici pour retourner à l'accueil.</a>
    <?php else : ?>
        <strong>Thanks <?= $user ?> for your proposal!</strong> We recorded it well.
        <br><br>
        Do not hesitate to propose other names, for the same goat or an other one.
        We will send you an email to tell you which of your proposals we have finally chosen!
        <br><br>
        <a href="/">Click here to go back to the home page.</a>
    <?php endif; ?>

        <br><br>
        <img src="goats/<?=$goat?>/thumb.jpg" alt="">
    </p>

</div><!-- END_#page -->
</body>
</html>
