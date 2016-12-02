<!DOCTYPE html>
<html lang="ru">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Упарвление</title>
        
        <link href="/css/bootstrap.min.css" rel="stylesheet">
        <link href="/css/normalize.css" rel="stylesheet">
        <!--<link href="/css/main.css" rel="stylesheet">-->
        <link href="/css/admin.css" rel="stylesheet">

        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>
    
    <body>

    <nav class="navbar navbar-inverse navbar-fixed-top">
        <div class="container-fluid">
            <div class="navbar-header"><a class="navbar-brand" href="#">Алмаз Строй</a></div>
            <div id="navbar" class="navbar-collapse collapse">
            <ul class="nav navbar-nav navbar-right">
                <li style="margin-top:17px;"><span class="glyphicon glyphicon-user white" aria-hidden="true"></span><?php echo $user_name; ?></li>
                <li><a href="/admin/logout/">Выход</a></li>
            </ul>
            </div>
        </div>
    </nav>
    <div class="container-fluid">
        <div class="row">