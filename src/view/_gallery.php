<?php

$numImg = count($img);
$imgElement = fn ($img) =>
    "<img src=\"img/$parent/$img.jpg\" alt=\"\">";

for ($i = 0; $i < $numImg; $i++) : ?>
    <a href="#<?=$img[$i]?>" class="thumb">
        <?=$imgElement($img[$i].'-thumb')?>
    </a>

    <figure id="<?=$img[$i]?>" class="modal">
        <nav>
            <?= isset($img[$i-1]) ? "<a href=\"#{$img[$i-1]}\" rel=\"prev\">&larr;</a>" : '' ?>
            <a href="#<?=$parent?>" rel="parent"><?=t('Close')?></a>
            <?= isset($img[$i+1]) ? "<a href=\"#{$img[$i+1]}\" rel=\"next\">&rarr;</a>" : '' ?>
        </nav>

        <?=$imgElement($img[$i])?>

        <figcaption><?=t($parent.'.'.$img[$i])?></figcaption>
    </figure>
<?php endfor; ?>
