        <div class="container-fluid main_container">
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
        
        <footer>
        футер
        </footer>
        

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <script src="/js/bootstrap.min.js"></script>
        <script src="/js/main.js"></script>
    </body>
</html>