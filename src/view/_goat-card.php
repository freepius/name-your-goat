<a href="#<?=$ID?>">
    <figure class="goat-card <?=$name ? '' : 'noName'?>">
        <img src="goats/<?=$ID?>/thumb.jpg" alt="<?=tg('The goat').' '.($name ?: tg('No name'))?>">
        <figcaption><?=$name ?: '???'?></figcaption>
    </figure>
</a>
