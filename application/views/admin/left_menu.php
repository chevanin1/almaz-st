<div class="col-sm-3 col-md-2 sidebar">
<?php foreach( $menu as $menu_block ) : ?>
    <ul class="nav nav-sidebar">
    <?php foreach( $menu_block as $item ) : ?>
        
        <?php if( isset( $item['active'] ) && $item['active'] ) : ?>
            <li class="active"><a href="<?php echo $item['link']; ?>"><?php echo $item['title']; ?> <span class="sr-only">(current)</span></a></li>
        <?php else : ?>
            <li><a href="<?php echo $item['link']; ?>"><?php echo $item['title']; ?></a></li>
        <?php endif; ?>
        
    <?php endforeach;?>
    </ul>
<?php endforeach;?>
</div>