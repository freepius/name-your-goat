<?php
$numImg = count($img);
for ($i = 0; $i < $numImg; $i++) : ?>
    <figure id="<?=$img[$i]?>" class="modal">
        <nav>
            <?= isset($img[$i-1]) ? "<a href=\"#{$img[$i-1]}\" rel=\"prev\">&larr;</a>" : '' ?>
            <a href="#<?=$parent?>" rel="parent"><?=t('Close')?></a>
            <?= isset($img[$i+1]) ? "<a href=\"#{$img[$i+1]}\" rel=\"next\">&rarr;</a>" : '' ?>
        </nav>

        <img src="img/<?=$parent.'/'.$img[$i]?>.jpg" alt="">

        <figcaption><?=t($parent.'.'.$img[$i])?></figcaption>
    </figure>
<?php endfor; ?>
