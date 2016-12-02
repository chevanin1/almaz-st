<div id="carousel-actions" class="carousel slide banners" data-ride="carousel">
    <ol class="carousel-indicators">
    <?php foreach( $items as $item_num => $item ) : ?>
        <li data-target="#carousel-actions" data-slide-to="<?php echo $item_num; ?>"<?php if( $item_num == 0 ) { echo " class=\"active\""; } ?>></li>
    <?php endforeach; ?>
    </ol>

    <div class="carousel-inner" role="listbox">
    <?php foreach( $items as $item_num => $item ) : ?>
        <div class="item<?php if( $item_num == 0 ) { echo " active"; } ?>">
            <a href="<?php echo $item['link']; ?>"><img src="<?php echo $item['img']; ?>" alt="<?php echo $item['name']; ?>"></a>
            <div class="carousel-caption"><?php echo $item['caption']; ?></div>
        </div>
    <?php endforeach; ?>
    </div>

    <a class="left carousel-control" href="#carousel-actions" role="button" data-slide="prev">
        <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
        <span class="sr-only">Назад</span>
    </a>
    <a class="right carousel-control" href="#carousel-actions" role="button" data-slide="next">
        <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
        <span class="sr-only">Далее</span>
    </a>
</div>
