<!DOCTYPE html>
<html lang="ru">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Авторизация</title>
        
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
        <div class="container">

            <form class="form-signin" method="post" action="/admin/auth/">
                <h2 class="form-signin-heading">Введите логин и пароль</h2>
                
                <?php
                    $loginErrors = form_error('login');
                    $passwordErrors = form_error('password');
                    if( isset($auth_error) ) {
                        $loginErrors .= "<p>" . $auth_error . "</p>";
                        $passwordErrors .= "<p>" . $auth_error . "</p>";
                    } // End if
                ?>
                <div class="form-group<?php if( $loginErrors != "" ) { echo " has-error has-feedback"; } ?>">
                    <label for="login" class="sr-only">Логин</label>
                    <input type="email" id="login" class="form-control" placeholder="Логин (Эл. почта)" autofocus name="login"<?php if( $loginErrors != "" ) { echo " aria-describedby=\"loginHelpBlock\""; } ?> value="<?php echo set_value('login'); ?>" required autofocus>
                    <?php if( $loginErrors != "" ) : ?>
                        <span class="glyphicon glyphicon-remove form-control-feedback" aria-hidden="true"></span>
                        <span id="loginHelpBlock" class="help-block"><?php echo $loginErrors; ?></span>
                    <?php endif; ?>
                </div>

                <div class="form-group<?php if( $passwordErrors != "" ) { echo " has-error has-feedback"; } ?>">
                    <label for="password" class="sr-only">Пароль</label>
                    <input type="password" id="password" class="form-control" placeholder="Пароль" autofocus name="password"<?php if( $passwordErrors != "" ) { echo " aria-describedby=\"passwordHelpBlock\""; } ?> value="<?php echo set_value('password'); ?>" required >
                    <?php if( $passwordErrors != "" ) : ?>
                        <span class="glyphicon glyphicon-remove form-control-feedback" aria-hidden="true"></span>
                        <span id="passwordHelpBlock" class="help-block"><?php echo $passwordErrors; ?></span>
                    <?php endif; ?>
                </div>
                
                <?php if( isset($redirect_url) ) : ?>
                    <input type="hidden" name="redirect_url" value="<?php echo $redirect_url; ?>">
                <?php else : ?>
                    <input type="hidden" name="redirect_url" value="/admin/index/">
                <?php endif; ?>
                
                <button class="btn btn-lg btn-primary btn-block" type="submit">Войти</button>
            </form>

        </div> 

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <script src="/js/bootstrap.min.js"></script>
        <script src="/js/main.js"></script>
    </body>
</html>