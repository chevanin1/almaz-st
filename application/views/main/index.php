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
                            <p>Наши преимущества:
                                <ul><li>строительство под ключ;</li>
                                <li>гарантия на все виды работ;</li>
                                <li>работаем без посредников;</li>
                                <li>работаем круглый год;</li>
                                <li>гибкая система скидок;</li>
                                <li>профессионализм наших специалистов;</li>
                                <li>бесплатная доставка и сборка.</li></ul></p>
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
                    <h1>Алмаз Строй - Строительство под ключ и любые виды работ:</h1>
                    <p>
                        <ul>
                            <li>строительство деревянных домов;</li>
                            <li>строительство домов из кирпича и пеноблока;</li>
                            <li>строительство бань, беседок, бытовок;</li>
                            <li>строительство домов из оцилиндрованного бревна;</li>
                            <li>строительство домов из клееного бруса;</li>
                            <li>внутренняя и внешняя отделка;</li>
                            <li>гарантия;</li>
                            <li>продажа стройматериалов.</li>
                        </ul>
                        Более подробно о нашей компании читайте <a href="/about/">тут</a>
                    </p>
                </div>
            </div>
        
            <div class="row map">
                <div class="col-md-12">
                    <p><h2>Наш офис:</h2>
                    <script type="text/javascript" charset="utf-8" async src="https://api-maps.yandex.ru/services/constructor/1.0/js/?sid=2FotHxuu2F5mwUgolU14uGiijfX5ZxkS&amp;width=840&amp;height=400&amp;lang=ru_RU&amp;sourceType=constructor&amp;scroll=true"></script></p>
                </div>
            </div>
            
            
        </div><!-- /.container-fluid main container-->
        
