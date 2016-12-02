<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
    <h1 class="page-header"><?php echo $header; ?></h1>
    <div class="row">
        <div class="col-md-8">

            <form class="form-signin" method="post" enctype="multipart/form-data" action="/admin/catalog_cat_edit/<?php echo $category_info['id']; ?>/">
                       
                <?php
                    /*
                    $imageError = "";
                    if( isset($img_error) ) {
                        $imageError .= "<p>" . $auth_error . "</p>";
                        $passwordErrors .= "<p>" . $auth_error . "</p>";
                    } // End if
                    */
                    
                    $values['name'] = "";
                    $values['parent'] = "";
                    $values['description'] = "";
                    
                    if( set_value('name') ) {
                        $values['name'] = set_value('name');
                    } else {
                        $values['name'] = $category_info['name'];
                    } // End if
                    
                    if( set_value('parent') ) {
                        $values['parent'] = set_value('parent');
                    } else {
                        $values['parent'] = $category_info['parent_id'];
                    } // End if
                    
                    if( set_value('description') ) {
                        $values['description'] = set_value('description');
                    } else {
                        $values['description'] = $category_info['description'];
                    } // End if

                
                ?>
            
                <div class="form-group<?php if( form_error('name') != "" ) { echo " has-error has-feedback"; } ?>">
                    <label for="name">Название</label>
                    <input type="text" id="name" class="form-control" placeholder="" name="name"<?php if( form_error('name') != "" ) { echo " aria-describedby=\"nameHelpBlock\""; } ?> value="<?php echo $values['name']; ?>" autofocus>
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
                        <option value="<?php echo $category['id']; ?>"<?php if( $category['id'] == $values['parent'] ) echo " selected"; ?>><?php echo $category['name']; ?></option>
                    <?php endforeach; ?>
                    </select>
                </div>            
            
                <div class="form-group">
                    <label for="description">Описание</label>
                    <textarea class="form-control" name="description" id="description" rows="5"><?php echo $values['description']; ?></textarea>
                </div>            
            
                <div class="form-group<?php if( $img_error != "" ) { echo " has-error has-feedback"; } ?>">
                    <label for="img">Изображение</label>
                    <input type="file" id="img" class="form-control" placeholder="<?php echo $img_name; ?>" name="img"<?php if( $img_error != "" ) { echo " aria-describedby=\"imgHelpBlock\""; } ?> value="<?php echo $img_name; ?>" autofocus>
                    
                    <?php if( $img_error != "" ) : ?>
                        <span class="glyphicon glyphicon-remove form-control-feedback" aria-hidden="true"></span>
                        <span id="imgHelpBlock" class="help-block"><?php echo $img_name; ?> <?php echo $img_error; ?></span>
                    <?php elseif( $img_name != "" ) : ?>
                        <img src="<?php echo $data_img_path . $img_name; ?>" width="100" class="img-thumbnail" />
                    <?php endif; ?>
                </div>                 
            
                <div class="form-group">
                    <label for="delete_img">
                    <input type="checkbox" id="delete_img" name="delete_img"> Удалить изображение
                    </label>
                </div>                 
               
                <button class="btn btn-lg btn-primary btn-block" type="submit">Сохранить</button>
            </form>
            
        </div>
    
    </div>
    
</div>
