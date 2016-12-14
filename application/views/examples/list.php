<div class="container-fluid main_container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default category_info">
                <div class="panel-heading">
                    <h1 class="panel-title"><?php echo $title;?></h1>
                </div>
                
                <div class="panel-body">
                <?php foreach( $categories as $category ) : ?>
                    <h2><?php echo $category['name'];?>:</h2> 

                    <div class="row">
                        <div class="col-md-12">                            
                            <?php if( isset( $examples[$category['id']] ) ) : ?>
                            <?php foreach( $examples[$category['id']] as $item ) : ?>
                                <div class="col-md-3 example_item">
                                    <div class="thumbnail">
                                        <?php if( isset($item['img']) && !empty($item['img']) ) : ?>
                                            <img src="<?php echo $data_projects_img_path . $item['img']; ?>" alt="<?php echo $item['name']; ?>" width="200" class="img-responsive">
                                        <?php endif; ?>
                                        <h3><?php echo $item['name']; ?></h3>
                                        <p><?php echo nl2br($item['description']); ?></p>
                                        <?php if( isset( $item['item_id'] ) && isset( $projects[$item['item_id']] ) ) : ?>
                                            <p>По проекту: <a href="<?php echo base_url(); ?>catalog/item/<?php echo $projects[$item['item_id']]['id'];?>"><?php echo $projects[$item['item_id']]['name']; ?></a></p>
                                        <?php endif; ?>
                                        <p><a class="btn btn-default" href="<?php echo base_url(); ?>examples/item/<?php echo $item['id'];?>" role="button">Подробнее »</a></p>
                                    </div>
                                </div>    
                            <?php endforeach; ?>
                            <?php endif; ?>

                        </div>
                    </div>
                    <?php if( $category['id'] != 0 ) : ?>
                    <div class="row"><div class="col-md-12"><a href="<?php echo base_url(); ?>catalog/categories/<?php echo $category['id'];?>">Посмотреть проекты - <?php echo $category['name'];?></a></div></div>
                    <?php endif; ?>
                <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
        
</div><!-- /.container-fluid main container-->