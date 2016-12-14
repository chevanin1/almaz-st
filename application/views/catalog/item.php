<div class="container-fluid main_container">

    <div id="blueimp-gallery" class="blueimp-gallery">
        <div class="slides"></div>
        <h3 class="title"></h3>
        <a class="prev">‹</a>
        <a class="next">›</a>
        <a class="close">×</a>
        <a class="play-pause"></a>
        <ol class="indicator"></ol>
    </div>
    
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default item_info">
                <div class="panel-heading">
                    <h1 class="panel-title"><?php echo $item_title;?></h1>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <?php if( isset($item['img']) && count($item['img']) ) : ?>                                       
                            <div class="col-md-5" id="project_images">
                                <?php foreach( $item['img'] as $key => $img ) : ?>
                                    <?php if( $key == 1 ) : ?>
                                        <p>
                                            <a href="<?php echo $data_item_img_path . $img['name'];?>" class="thumbnail thumbnail_main">
                                                <img src="<?php echo $data_item_img_path . $img['name'];?>" class="img-responsive" alt="<?php echo $item['name'];?>" width="400">
                                            </a>
                                        </p>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                                
                                <div style="clear: both;"></div>
                                
                                <p>
                                <?php foreach( $item['img'] as $key => $img ) : ?>
                                    <?php if( $key != 1 ) : ?>
                                        <a href="<?php echo $data_item_img_path . $img['name'];?>" class="thumbnail">
                                            <img src="<?php echo $data_item_img_path . $img['name'];?>" class="img-responsive" alt="<?php echo $item['name'];?>" width="50">
                                        </a>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                                </p>
                                
                            </div>
                        <?php endif; ?>
                        <div class="col-md-4">
                        <p><h2>Проект <?php echo $item['name'];?></h2></p>
                        <p class="item_category"><?php echo $item['category_name'];?></p>
                        <p><h3 class="item_price">Цена: <?php echo $item['price'];?> р.</h3></p>
                        <p><button type="button" class="btn btn-warning item_fb">Отправить заявку</button></p>
                        <p><!--<a href="#">распечатать</a> --><a href="/info/" target="_blank"><span class="glyphicon glyphicon-info-sign" aria-hidden="true"></span> Как заказать</a></p>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-12">                       
                            <h2>О проекте:</h2>                                       
                            <p class="item_description"><?php echo nl2br($item['description']); ?></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php if( count( $examples ) > 0 ) : ?>
    <div class="panel panel-default category_examples">            
        <div class="panel-heading"><h2 class="panel-title">Примеры выполненных работ</h2></div>
                    
        <div class="panel-body">                    
            <?php foreach( $examples as $item_num => $item ) : ?>
                <div class="col-md-3 category_example">
                    <div class="thumbnail">
                        <?php if( isset($item['img']) ) : ?>
                            <img src="<?php echo $item['img']; ?>" alt="<?php echo $item['name']; ?>" width="200" class="img-responsive">
                        <?php endif; ?>
                        <h3><?php echo $item['name']; ?></h3>
                        <p><?php echo $item['caption']; ?></p>
                        <p><a class="btn btn-default" href="<?php echo $item['link']; ?>" role="button">Подробнее »</a></p>
                    </div>
                </div>    
            <?php endforeach; ?>
                            
            <div class="all_bestsellers"><a class="btn btn-default" href="/catalog/examples/" role="button">Все примеры »</a></div>       
        </div>
    </div>    
    <?php endif; ?>
        
</div><!-- /.container-fluid main container-->