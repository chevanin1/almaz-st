<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
    <h1 class="page-header"><?php echo $header; ?></h1>
    <div class="row">
        <div class="col-md-8">

            <form class="form-signin" method="post" enctype="multipart/form-data" action="/admin/example_add/">
            
                <div class="form-group<?php if( form_error('name') != "" ) { echo " has-error has-feedback"; } ?>">
                    <label for="name">Название</label>
                    <input type="text" id="name" class="form-control" name="name"<?php if( form_error('name') != "" ) { echo " aria-describedby=\"nameHelpBlock\""; } ?> value="<?php echo set_value('name'); ?>" >
                    <?php if( form_error('name') != "" ) : ?>
                        <span class="glyphicon glyphicon-remove form-control-feedback" aria-hidden="true"></span>
                        <span id="nameHelpBlock" class="help-block"><?php echo form_error('name'); ?></span>
                    <?php endif; ?>
                </div>                     

                <div class="form-group">
                    <label for="category_id">Категория</label>
                    <select class="form-control" id="category_id" name="category_id">
                    <?php foreach( $categories as $category ) : ?>
                        <option value="<?php echo $category['id']; ?>"<?php if( $category['id'] == set_value('category_id') ) echo " selected"; ?>><?php echo $category['name']; ?></option>
                    <?php endforeach; ?>
                    </select>
                </div>  
                <div class="form-group">
                    <label for="item_id">Проект</label>
                    <select class="form-control" id="item_id" name="item_id">
                    <?php foreach( $projects as $project ) : ?>
                        <option value="<?php echo $project['id']; ?>"<?php if( $project['id'] == set_value('item_id') ) echo " selected"; ?>><?php echo $project['name']; ?></option>
                    <?php endforeach; ?>
                    </select>
                </div>   

                <div class="form-group">
                    <label for="description">Описание</label>
                    <textarea class="form-control" name="description" id="description" rows="5"><?php echo set_value('description'); ?></textarea>
                </div>     
                
                <?php for( $i = 1; $i <= $images_count; $i++ ) : ?>
                <div class="form-group<?php if( $img_error[$i] != "" ) { echo " has-error has-feedback"; } ?>">
                    <label for="img_<?php echo $i; ?>">Изображение</label>
                    <input type="file" id="img_<?php echo $i; ?>" class="form-control" placeholder="<?php echo $img_name[$i]; ?>" name="img_<?php echo $i; ?>"<?php if( $img_error[$i] != "" ) { echo " aria-describedby=\"img_" . $i . "_HelpBlock\""; } ?> value="<?php echo $img_name[$i]; ?>">
                    
                    <?php if( $img_name[$i] != "" ) { echo "Загружено: " . $img_name[$i]; } ?>
                    <?php if( ( $img_name[$i] != "" ) && ( $img_error[$i] == "" ) ) : ?>
                    <img src="<?php echo $data_img_path . $img_name[$i]; ?>" width="100" class="img-thumbnail" />
                    <?php endif; ?>
                    <input type="hidden" name="uploaded_<?php echo $i; ?>" value="<?php echo $img_name[$i]; ?>">
                    <?php if( $img_error[$i] != "" ) : ?>
                        <span class="glyphicon glyphicon-remove form-control-feedback" aria-hidden="true"></span>
                        <span id="img_<?php echo $i; ?>_HelpBlock" class="help-block"><?php echo $img_name[$i]; ?> <?php echo $img_error[$i]; ?></span>
                    <?php endif; ?>
                </div>   
                <? endfor; ?>
               
                <button class="btn btn-lg btn-primary btn-block" type="submit">Добавить</button>
            </form>
            
        </div>
    
    </div>
    
</div>
