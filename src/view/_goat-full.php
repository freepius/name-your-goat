<article id="<?=$ID?>" class="modal goat-full <?=$name ? '' : 'noName'?>">
    <nav>
        <?php if ($prev) : ?>
            <a href="#<?=$prev?>" rel="prev">&larr;</a>
        <?php endif ?>
    
        <a href="#the-goats" rel="parent"><?=t('Close')?></a>

        <?php if ($next) : ?>
            <a href="#<?=$next?>" rel="next">&rarr;</a>
        <?php endif ?>
    </nav>

    <h1><?=$name ? tg('goat.name', $name) : tg('I have no name')?></h1>

    <section class="info">
        <p>
            <?=tg('goat.birthyear', $birthyear)?>
            <?=$birthday ? ' ('.tg('goat.birthday', ldate($birthday)).')' : ''?>
            <br>
            <?=$motherName ? tg('goat.motherName', $motherName).'<br>' : ''?>
            <?=tg('goat.breed', $breed)?><br>
            <?=$name && $themeOfName ? tg('goat.themeOfName', _t('themes', $themeOfName, [], true)).'<br>' : ''?>
        </p>
    </section>

    <?php if (isAuth() && ! $user->goatNamed && ! $name) : ?>
    <section class="form-name">
        <form action="/give-a-name" method="post">
            <h2><?=tg('form.title')?></h2>

            <input type="hidden" name="id" value="<?=$ID?>">

            <p>
                <label for="name"><?=tg('form.name')?></label>
                <input type="text" name="name" id="name" required>
            </p>
            <p>
                <label for="theme"><?=tg('form.theme')?></label>
                <input type="text" name="theme" id="theme" required>
            </p>
            <input type="submit" value="<?=tg('form.submit')?>">
        </form>
    </section>
    <?php endif ?>

    <section class="pictures">
        <?php foreach ($pictures as $pic) {
            echo "<img src=\"goats/$ID/$pic\" alt=\"\">";
        }?>
    </section>
</article>