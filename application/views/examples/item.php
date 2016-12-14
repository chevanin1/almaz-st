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
                    <h1 class="panel-title"><?php echo $example_title;?></h1>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <?php if( isset($example['img']) && count($example['img']) ) : ?>                                       
                            <div class="col-md-5" id="project_images">
                                <?php foreach( $example['img'] as $key => $img ) : ?>
                                    <?php if( $key == 1 ) : ?>
                                        <p>
                                            <a href="<?php echo $data_example_img_path . $img['img'];?>" class="thumbnail thumbnail_main">
                                                <img src="<?php echo $data_example_img_path . $img['img'];?>" class="img-responsive" alt="<?php echo $example['name'];?>" width="400">
                                            </a>
                                        </p>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                                
                                <div style="clear: both;"></div>
                                
                                <p>
                                <?php foreach( $example['img'] as $key => $img ) : ?>
                                    <?php if( $key != 1 ) : ?>
                                        <a href="<?php echo $data_example_img_path . $img['img'];?>" class="thumbnail">
                                            <img src="<?php echo $data_example_img_path . $img['img'];?>" class="img-responsive" alt="<?php echo $example['name'];?>" width="50">
                                        </a>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                                </p>
                                
                            </div>
                        <?php endif; ?>
                        <div class="col-md-4">
                            <?php if( isset( $example['category_id'] ) && isset( $example['category_name'] ) ) : ?>
                                <p class="example_category"><h2>Категория: <?php echo $example['category_name'];?></h2> <a href="<?php echo base_url(); ?>catalog/categories/<?php echo $example['category_id'];?>">Посмотреть проекты - <?php echo $example['category_name'];?></a></p>
                            <?php endif;?>
                            
                            <?php if( isset( $example['item_id'] ) && isset( $example['item_name'] ) ) : ?>
                                <p class="example_category"><h2>По проекту: <?php echo $example['item_name'];?></h2> <a href="<?php echo base_url(); ?>catalog/item/<?php echo $example['item_id'];?>">Посмотреть проект - <?php echo $example['item_name'];?></a></p>
                            <?php endif;?>
                        
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-12">                       
                            <h2>О реализованном проекте:</h2>                                       
                            <p class="item_description"><?php echo nl2br($example['description']); ?></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
        
</div><!-- /.container-fluid main container-->