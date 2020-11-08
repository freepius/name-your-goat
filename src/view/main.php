<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="main.css">

    <title><?= t('head.title', isAuth()) ?></title>
</head>

<body>
<div id="page">

    <nav id="languages">
        <span><?= t('My language:') ?></span>
        <a href="/locale/fr" <?= locale('fr') ? 'class="my-locale"' : '' ?>>Français</a>
        <a href="/locale/en" <?= locale('en') ? 'class="my-locale"' : '' ?>>English</a>
    </nav>

    <header id="masthead">
        <h1><?= t('title') ?></h1>
        <p>
            <?= isAuth() ? t('subtitle.hello', $user->name) : '' ?>
            <?= t('subtitle', isAuth()) ?>
        </p>
    </header>

    <section id="the-farm">
        <h2><?= t('the-farm.title') ?></h2>
        <ul class="list-inline">
        <?php if (locale('fr')) : ?>
            <li>21 chèvres de race <big>Rove</big></li>
            <li>2 boucs de race <big>Rove</big></li>
            <li>2 chèvres de race Alpine (les cheffes)</li>
            <li>1 chevrette de race Alpine <big>(née ici)</big></li>
            <li>2 chèvres de race Provençales</li>
            <li>3 poules mangeuses de larves de mouches</li>
            <li><big>1 adorable chienne de berger</big></li>
            <li>1 ruchette et ses centaines d'abeilles</li>
            <li><big>Et 2 apprentis paysans :-)</big></li>
        <?php else : ?>
            <li>21 goats of the <big>Rove</big> breed</li>
            <li>2 billy goats of the <big>Rove</big> breed</li>
            <li>2 goats of the Alpine breed (the leaders)</li>
            <li>1 kid goat of the Alpine breed <big>(borned here)</big></li>
            <li>2 goats of the Provençale breed</li>
            <li>3 chickens which eat fly larvae</li>
            <li><big>1 adorable shepherd female dog</big></li>
            <li>1 small hive and its hundreds of bees</li>
            <li><big>Et 2 little farmers :-)</big></li>
        <?php endif; ?>
        </ul>

        <p class="hr-top arrow-down">
        <?php if (locale('fr')) : ?>
            Il y a Droppie, Coco, Tima, Chocolat, Vanille, Nuage, Conquistador, etc.
            Mais il reste encore <strong><?= $countNoNamedGoats ?> chèvres sans prénom</strong>.
            <?= isAuth() ? 'Alors on compte sur toi et ton inspiration !' : '' ?>
        <?php else : ?>
            There are Droppie, Coco, Tima, Chocolat, Vanille, Nuage, Conquistador, etc.
            But there are still <strong><?= $countNoNamedGoats ?> goats without a name</strong>.
            <?= isAuth() ? 'So we count on you and your inspiration!' : '' ?>
        <?php endif; ?>
        </p>

        <?php if (isAuth()) : ?>
        <div class="box">
            <?php if (locale('fr')) : ?>
            <strong>Consignes pour nommer ta chèvre</strong>
            <ol>
                <li>Tu peux proposer plusieurs noms, il n'y a pas de limite.</li>
                <li>Parmi toutes tes propositions, nous en choisirons une seule&nbsp;!</li>
                <li>Une proposition c'est : <strong>un thème + un nom</strong> qui suit ce thème
                    <em>(ex : thème = "Canada", nom = "Niagara")</em>.
                    Chaque année, nos nouvelles chevrettes recevront un nom qui suivra le thème de leur mère.
                    Nous pourrons suivre ainsi les lignées.
                </li>
                <li>Choisis un nom <strong>simple à prononcer</strong>,
                    car nous aurons à le dire quotidiennement.
                </li>
            </ol>
            <?php else : ?>
            <strong>Instructions to name your goat</strong>
            <ol>
                <li>You can propose several names, there is no limit.</li>
                <li>Among all your proposals, we will choose only one!</li>
                <li>A proposal is: <strong>a theme + a name</strong> following this theme
                    <em>(ex: theme = "Canada", name = "Niagara")</em>.
                    Every year, our new baby goats will receive a name following their mother's theme.
                    It's a funny way to follow the parentages.
                </li>
                <li>Please choose a name <strong>easy to enunciate</strong> (for french speakers),
                    because we will have to say it daily.
                </li>
            </ol>
            <?php endif; ?>
        </div>
        <?php endif; ?>
    </section>

    <section id="the-place">
        <h2><?= t('the-place.title') ?></h2>
        <p>
            <?php if (locale('fr')) : ?>
            Actuellement, tout ce beau monde est situé en Ardèche verte,
            sur la commune de Désaignes, au lieu-dit "Le Douzet".
            Plus précisément ici...
            <?php else : ?>
            Currently, all these beautiful people are located in the "Ardèche verte",
            in the town of Désaignes, at a place called "Le Douzet".
            More precisely here...
            <?php endif; ?>
        </p>
        <div id="map" class="box">
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3701.2303672939047!2d4.477103182498977!3d45.01523570127451!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zNDXCsDAwJzU0LjgiTiA0wrAyOCc0NS4zIkU!5e1!3m2!1sfr!2sfr!4v1594037730383!5m2!1sfr!2sfr"
                width="100%" height="<?= isAuth() ? '600' : '400' ?>" frameborder="0" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
        </div>
    </section>

    <section id="gallery">
        <?php
        render('_gallery', [
            'parent' => 'gallery',
            'img' => ['chickens', 'droppie', 'bees', 'farmers'],
        ]);
        ?>
    </section>

    <main id="the-goats">
        <h2><?=t('main.title')?></h2>
        <p><?=t('main.help')?></p>
        <?php
        for ($i = 0; $i < $colsNum; $i++) {
            echo "<div class=\"column\">\n";
            foreach ($goatsByCol[$i] as $goat) {
                render('_goat-card', (array) $goat);
            }
            echo "</div>\n";
        }

        foreach ($goats as $i => $goat) {
            render(
                '_goat-full',
                (array) $goat +
                [
                    'prev' => $goats[$i-1]->ID ?? null,
                    'next' => $goats[$i+1]->ID ?? null,
                    'user' => $user,
                ]
            );
        }
        ?>
    </main>

    <script src="main.js"></script>

</div><!-- END_#page -->
</body>
</html>
