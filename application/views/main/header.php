<!DOCTYPE html>
<html lang="ru">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title><?php echo $site_name; ?></title>
        
        <link href="/css/bootstrap.min.css" rel="stylesheet">
        <link href="/css/normalize.css" rel="stylesheet">
        <link href="/css/main.css" rel="stylesheet">

        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>
    
    <body>
        <header>
            <nav class="navbar navbar-default navbar-fixed-top">
                <div class="container-fluid">
                    <div class="navbar-header">
                    
                        <!--<a class="navbar-brand logo" href="#"><img alt="<?php echo $site_name; ?>" src="/img/logo-small.png"></a>-->
                        <a class="navbar-brand logo" href="<?php echo base_url(); ?>"><img alt="<?php echo $site_name; ?>" src="/img/logo-big.png"></a>
                        
                        <div class="header-top-info container-fluid">
                            
                            <!--<div class="container-fluid">-->
                            <div class="row">
                                <div class="col-md-4"><?php echo $site_slogan; ?></div>
                                <div class="col-md-4 phone"><?php echo $site_contact_phones; ?></div>
                                <div class="col-md-2"><?php echo $site_contact_address; ?></div>
                            </div>
                            <!--</div>-->
                        </div>
                    
                    </div>

                    <div class="collapse navbar-collapse top_menu" id="bs-example-navbar-collapse-1">
                        <ul class="nav navbar-nav">
                            <?php foreach( $top_menu as $menu_item ) : ?>
                                <?php if( isset( $menu_item['sub_menu'] ) && is_array($menu_item['sub_menu']) && ( count($menu_item['sub_menu']) > 0) ) : ?>
                                    <li class="dropdown">
                                        <a href="<?php echo $menu_item['link']; ?>" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><?php echo $menu_item['title']; ?> <span class="caret"></span></a>
                                        <ul class="dropdown-menu">
                                            <?php foreach( $menu_item['sub_menu'] as $sub_menu_item ) : ?>
                                                <?php if( isset($sub_menu_item['is_separator']) && ($sub_menu_item['is_separator']) ): ?>
                                                    <li role="separator" class="divider"></li>
                                                <?php else: ?>
                                                    <li><a href="<?php echo $sub_menu_item['link']; ?>"><?php echo $sub_menu_item['title']; ?></a></li>
                                                <?php endif; ?>
                                            
                                            <?php endforeach; ?>
                                        </ul>
                                    </li>
                                <?php else: ?>
                                    <li<?php if( isset($menu_item['li_class']) && ($menu_item['li_class']) ) { echo " class=\"" . $menu_item['li_class'] . "\""; } ?>>
                                    <?php if( $menu_item['is_link'] ) : ?>
                                        <a<?php if( isset($menu_item['a_class']) && ($menu_item['a_class']) ) { echo " class=\"" . $menu_item['a_class'] . "\""; } ?> href="<?php echo $menu_item['link']; ?>"><?php echo $menu_item['title']; ?></a>
                                    <?php else : ?>
                                        <?php echo $menu_item['title']; ?>
                                    <?php endif; ?>
                                    </li>
                                <? endif; // have sub menu ?>
                            <?php endforeach; ?>
                        </ul>
                    </div><!-- /.navbar-collapse -->
                    
                </div><!-- /.container-fluid -->
            </nav>    
        </header>
