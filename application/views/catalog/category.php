<div class="container-fluid main_container">

    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default category_info">
                <div class="panel-heading">
                    <h1 class="panel-title"><?php echo $category_title;?></h1>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <?php if( isset($category['img']) && !empty($category['img']) ) : ?>                                       
                            <div class="col-md-2">
                            <p><img src="<?php echo $data_cat_img_path . $category['img'];?>" class="img-responsive" alt="<?php echo $category['name'];?>" width="200"></p>
                            </div>
                        <?php endif; ?>
                        <div class="col-md-4">
                        <p><?php echo $category['description'];?></p>
                        </div>
                    </div>
                    
                    <?php if( count( $sub_categories ) > 0 ) : ?>                    
                    <div class="row">
                        <div class="col-md-12">                       
                        <h2>Подкатегории:</h2>                                       
                        <?php foreach( $sub_categories as $sub_category ) : ?>
                            <div class="col-md-3 sub_category">
                                <div class="thumbnail">
                                    <?php if( isset($sub_category['img']) && !empty($sub_category['img']) ) : ?>
                                        <img src="<?php echo $data_cat_img_path . $sub_category['img']; ?>" alt="<?php echo $sub_category['name']; ?>" width="200" class="img-responsive">
                                    <?php endif; ?>
                                    <h3><?php echo $sub_category['name']; ?></h3>
                                    <p><?php echo $sub_category['description']; ?></p>
                                    <p><a class="btn btn-default" href="<?php echo base_url(); ?>catalog/categories/<?php echo $sub_category['id'];?>/" role="button">Подробнее »</a></p>
                                </div>
                            </div>    
                        <?php endforeach; ?>
                        
                        </div>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
    
    <?php if( count( $items ) > 0 ) : ?>
    <div class="panel panel-default category_items">            
        <div class="panel-heading"><h2 class="panel-title">Проекты</h2></div>
                    
        <div class="panel-body">                    
            <?php foreach( $items as $item_num => $item ) : ?>
                <div class="col-md-3 category_item">
                    <div class="thumbnail">
                        <?php if( isset($item['img']) && !empty($item['img']) ) : ?>
                            <img src="<?php echo $data_item_img_path . $item['img']; ?>" alt="<?php echo $item['name']; ?>" width="200" class="img-responsive">
                        <?php endif; ?>
                        <h3><?php echo $item['name']; ?></h3>
                        <p><?php echo $item['description']; ?></p>
                        <p class="price">От <?php echo $item['price']; ?> р.</p>
                        <p><a class="btn btn-default" href="<?php echo base_url(); ?>catalog/item/<?php echo $item['id'];?>" role="button">Подробнее »</a></p>
                    </div>
                </div>    
            <?php endforeach; ?>
                            
        </div>
    </div>
    <?php endif; ?>

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
                            
            <div class="all_bestsellers"><a class="btn btn-default" href="/catalog/examples/<?php echo $category['id'];?>/" role="button">Все примеры в категории <?php echo $category['name'];?> »</a></div>       
        </div>
    </div>    
    <?php endif; ?>
        
</div><!-- /.container-fluid main container-->