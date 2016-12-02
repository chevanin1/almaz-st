<div class="panel panel-default bestsellers">            
    <div class="panel-heading"><h2 class="panel-title">Лучшие предложения</h2></div>
                
    <div class="panel-body">                    
        <?php foreach( $items as $item_num => $item ) : ?>
            <div class="col-md-3 bestsellers_item">
                <div class="thumbnail">
                    <?php if( isset($item['img']) ) : ?>
                        <img src="<?php echo $item['img']; ?>" alt="<?php echo $item['name']; ?>" width="200" class="img-responsive">
                    <?php endif; ?>
                    <h3><?php echo $item['name']; ?></h3>
                    <p><?php echo $item['description']; ?></p>
                    <p class="price">От <?php echo $item['price']; ?> р.</p>
                    <p><a class="btn btn-default" href="<?php echo $item['link']; ?>" role="button">Подробнее »</a></p>
                </div>
            </div>    
        <?php endforeach; ?>
                        
        <div class="all_bestsellers"><a class="btn btn-default" href="/catalog/bestsellers/" role="button">Все лучшие предложения »</a></div>       
    </div>
</div>