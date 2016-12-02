<div class="container-fluid main_container">

    <?php
        $category_title = "category_title";
    ?>

    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default category_info">
                <div class="panel-heading">
                    <h1 class="panel-title"><?php echo $category_title;?></h1>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-2">
                        <p>Качественные материалы, контроль работ всех подрядчиков, проверенные проекты, согласование на всех этапах</p>
                        <p>Качественные материалы, контроль работ всех подрядчиков, проверенные проекты, согласование на всех этапах</p>
                        <p>Качественные материалы, контроль работ всех подрядчиков, проверенные проекты, согласование на всех этапах</p>
                        <p>Более подробно о нашей компании читайте <a href="#">тут</a></p>
                        </div>
                        <div class="col-md-4">
                        <p>Качественные материалы, контроль работ всех подрядчиков, проверенные проекты, согласование на всех этапах</p>
                        <p>Качественные материалы, контроль работ всех подрядчиков, проверенные проекты, согласование на всех этапах</p>
                        <p>Качественные материалы, контроль работ всех подрядчиков, проверенные проекты, согласование на всех этапах</p>
                        <p>Более подробно о нашей компании читайте <a href="#">тут</a></p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-2">
                        <p>Качественные материалы, контроль работ всех подрядчиков, проверенные проекты, согласование на всех этапах</p>
                        <p>Качественные материалы, контроль работ всех подрядчиков, проверенные проекты, согласование на всех этапах</p>
                        <p>Качественные материалы, контроль работ всех подрядчиков, проверенные проекты, согласование на всех этапах</p>
                        <p>Более подробно о нашей компании читайте <a href="#">тут</a></p>
                        </div>
                        <div class="col-md-4">
                        <p>Качественные материалы, контроль работ всех подрядчиков, проверенные проекты, согласование на всех этапах</p>
                        <p>Качественные материалы, контроль работ всех подрядчиков, проверенные проекты, согласование на всех этапах</p>
                        <p>Качественные материалы, контроль работ всех подрядчиков, проверенные проекты, согласование на всех этапах</p>
                        <p>Более подробно о нашей компании читайте <a href="#">тут</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    
    <div class="col-md-4">
                    <div class="panel panel-default why">
                        <div class="panel-heading">
                        <h2 class="panel-title">Почему выбирают нас</h2>
                        </div>
                        <div class="panel-body">
                            <p>Качественные материалы, контроль работ всех подрядчиков, проверенные проекты, согласование на всех этапах</p>
                            <p>Качественные материалы, контроль работ всех подрядчиков, проверенные проекты, согласование на всех этапах</p>
                            <p>Качественные материалы, контроль работ всех подрядчиков, проверенные проекты, согласование на всех этапах</p>
                            <p>Более подробно о нашей компании читайте <a href="#">тут</a></p>
                        </div>
                    </div>
                </div>
    
    описание категории
    подкатегории
    список проектов
    постраничная
    список галерей со ссылкой на все галереи категории и все галереи в принципе
    
        
        
        
        
            <?php if( isset($banners_data) && isset($banners_data['items']) && ( count($banners_data['items']) > 0 ) ) $this->load->view('main/banners', $banners_data ); ?>
            <?php if( isset($bestsellers) && isset($bestsellers['items']) && ( count($bestsellers['items']) > 0 ) ) $this->load->view('catalog/bestsellers', $bestsellers ); ?>
        
            <div class="row content">
                <div class="col-md-4">
                    <div class="panel panel-default why">
                        <div class="panel-heading">
                        <h2 class="panel-title">Почему выбирают нас</h2>
                        </div>
                        <div class="panel-body">
                            <p>Качественные материалы, контроль работ всех подрядчиков, проверенные проекты, согласование на всех этапах</p>
                            <p>Качественные материалы, контроль работ всех подрядчиков, проверенные проекты, согласование на всех этапах</p>
                            <p>Качественные материалы, контроль работ всех подрядчиков, проверенные проекты, согласование на всех этапах</p>
                            <p>Более подробно о нашей компании читайте <a href="#">тут</a></p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <?php if( isset($reviews) && isset($reviews['items']) && ( count($reviews['items']) > 0 ) ) $this->load->view('main/reviews', $reviews ); ?>
                </div>
                <div class="col-md-4">
                    <?php if( isset($examples) && isset($examples['items']) && ( count($examples['items']) > 0 ) ) $this->load->view('main/examples', $examples ); ?>
                </div>
            </div>
        
            <div class="row about">
                <div class="col-md-12">
                    <h1>Алмаз Строй</h1>
                    <p>Это строительство домов в Саранске и районах Мордовии</p>
                    <p>Это строительство домов в Саранске и районах Мордовии</p>
                    <p>Это строительство домов в Саранске и районах Мордовии</p>
                    <p>Это строительство домов в Саранске и районах Мордовии</p>
                    <p>Это строительство домов в Саранске и районах Мордовии</p>
                </div>
            </div>
        
            <div class="row map">
                карта с адресом офиса и возможно потом с постройками со ссылками на адреса
                возможно совместить с предыдущим
            </div>
            
            
        </div><!-- /.container-fluid main container-->












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