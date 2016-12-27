        <footer>

            <div class="container-fluid">
                
                <div class="row">
                    <div class="col-md-3 col-md-offset-2">
                        <h2><a href="/catalog/">КАТАЛОГ ПРОЕКТОВ</a></h2>
                        <ul class="footer_categories">
                        <?php foreach( $footer_menu['catalog'] as $sub_menu_item ) : ?>                               
                            <li><a href="<?php echo $sub_menu_item['link']; ?>"><?php echo $sub_menu_item['title']; ?></a></li>
                        <?php endforeach; ?>
                        </ul>
                    </div>
                    <div class="col-md-3">
                        <h2><a href="/about/">АЛМАЗ-СТРОЙ</a></h2>
                        <ul class="footer_pages">
                        <?php foreach( $footer_menu['pages'] as $sub_menu_item ) : ?>                               
                            <li><a href="<?php echo $sub_menu_item['link']; ?>"><?php echo $sub_menu_item['title']; ?></a></li>
                        <?php endforeach; ?>
                        </ul>                    
                    </div>
                    <div class="col-md-3">
                        <h2><a href="/contacts/">КОНТАКТЫ</a></h2>
                        <div><span class="glyphicon glyphicon-earphone" aria-hidden="true"></span> <?php echo $footer_menu['contacts']['phones']; ?></div>
                        <div><span class="glyphicon glyphicon-home" aria-hidden="true"></span> <?php echo $footer_menu['contacts']['address']; ?></div>
                        <div><span class="glyphicon glyphicon-envelope" aria-hidden="true"></span> <a href="mailto:<?php echo $footer_menu['contacts']['email']; ?>"><?php echo $footer_menu['contacts']['email']; ?></a></div>
                        <div><span class="glyphicon glyphicon-map-marker" aria-hidden="true"></span> <a href="<?php echo $footer_menu['contacts']['scheme']['link']; ?>"><?php echo $footer_menu['contacts']['scheme']['title']; ?></a></div>

                    </div>
                </div>
                
                <div class="row">
                    <div class="col-md-8 col-md-offset-2 footer_cr">
                        <?php echo nl2br( $footer_menu['info'] ); ?>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-md-8 col-md-offset-3">
                        <!-- counters -->
                    </div>
                </div>
                    
            </div><!-- /.container-fluid-->        
                    
                    
        </footer>
        

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <script src="/js/bootstrap.min.js"></script>
        <script src="/js/blueimp-gallery.min.js"></script>
        <script src="/js/main.js"></script>
        
<script>
if( document.getElementById('project_images') ) {
document.getElementById('project_images').onclick = function (event) {
    event = event || window.event;
    var target = event.target || event.srcElement,
        link = target.src ? target.parentNode : target,
        options = {index: link, event: event},
        links = this.getElementsByTagName('a');
    blueimp.Gallery(links, options);
};
}
</script>
        
    </body>
</html>