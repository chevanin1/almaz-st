<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
    <h1 class="page-header"><?php echo $header; ?></h1>
    <div class="row">
        <div class="col-md-8">

            <form class="form-signin" method="post" enctype="multipart/form-data" action="/admin/catalog_cat_add/">
                       
                <?php
                    /*
                    $imageError = "";
                    if( isset($img_error) ) {
                        $imageError .= "<p>" . $auth_error . "</p>";
                        $passwordErrors .= "<p>" . $auth_error . "</p>";
                    } // End if
                    */
                
                ?>
            
                <div class="form-group<?php if( form_error('name') != "" ) { echo " has-error has-feedback"; } ?>">
                    <label for="name">Название</label>
                    <input type="text" id="login" class="form-control" placeholder="" name="name"<?php if( form_error('name') != "" ) { echo " aria-describedby=\"nameHelpBlock\""; } ?> value="<?php echo set_value('name'); ?>" autofocus>
                    <!-- required --> 
                    <?php if( form_error('name') != "" ) : ?>
                        <span class="glyphicon glyphicon-remove form-control-feedback" aria-hidden="true"></span>
                        <span id="nameHelpBlock" class="help-block"><?php echo form_error('name'); ?></span>
                    <?php endif; ?>
                </div>            

                <div class="form-group">
                    <label for="parent">Родительская категория</label>
                    <select class="form-control" id="parent" name="parent">
                    <?php foreach( $top_categories as $category ) : ?>
                        <option value="<?php echo $category['id']; ?>"<?php if( $category['id'] == set_value('parent') ) echo " selected"; ?>><?php echo $category['name']; ?></option>
                    <?php endforeach; ?>
                    </select>
                </div>            
            
                <div class="form-group">
                    <label for="description">Описание</label>
                    <textarea class="form-control" name="description" id="description" rows="5"><?php echo set_value('description'); ?></textarea>
                </div>            
            
                <div class="form-group<?php if( $img_error != "" ) { echo " has-error has-feedback"; } ?>">
                    <label for="img">Изображение</label>
                    <input type="file" id="img" class="form-control" placeholder="<?php echo $img_name; ?>" name="img"<?php if( $img_error != "" ) { echo " aria-describedby=\"imgHelpBlock\""; } ?> value="<?php echo $img_name; ?>" autofocus>
                    <?php if( $img_error != "" ) : ?>
                        <span class="glyphicon glyphicon-remove form-control-feedback" aria-hidden="true"></span>
                        <span id="imgHelpBlock" class="help-block"><?php echo $img_name; ?> <?php echo $img_error; ?></span>
                    <?php endif; ?>
                </div>                 
               
                <button class="btn btn-lg btn-primary btn-block" type="submit">Добавить</button>
            </form>
            
        </div>
    
    </div>
    
</div>
