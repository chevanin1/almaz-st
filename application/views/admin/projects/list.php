<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
    <h1 class="page-header"><?php echo $header; ?></h1>
    <div class="row">
        <div class="col-md-8">
            
            <a href="/admin/catalog_add/">
                <button type="button" class="btn btn-default btn-sm" id="add_new_project">
                    <span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Добавить проект
                </button>
            </a>            
            
            <?php if( isset( $items ) && ( count( $items ) > 0 ) ) : ?>
            <?php
                $category_names = array();
                foreach( $categories as $category ) {
                    $category_names[$category['id']] = $category['name'];
                } // End foreach
            ?>
            <form action="/admin/catalog_list/" method="post">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Сортировка</th>
                            <th>Название</th>
                            <th>Цена</th>
                            <th>Категория</th>
                            <th>Лучшее предложение</th>
                            <th></th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach( $items as $item ) : ?>
                        <?php
                            if( set_value('sort_'.$item['id']) ) {
                                $sort_value = set_value('sort_'.$item['id']);
                            } else {
                                $sort_value = $item['sort'];
                            } // End if
                            if( set_value('name_'.$item['id']) ) {
                                $name_value = set_value('name_'.$item['id']);
                            } else {
                                $name_value = $item['name'];
                            } // End if
                            if( set_value('price_'.$item['id']) ) {
                                $price_value = set_value('price_'.$item['id']);
                            } else {
                                $price_value = $item['price'];
                            } // End if
                            if( isset( $is_bestseller_values[$item['id']] ) ) {
                                $is_bestseller_value = $is_bestseller_values[$item['id']];
                            } else {
                                $is_bestseller_value = $item['is_bestseller'];
                            } // End if
                        ?>
                        <tr>
                            <td>
                                <div class="form-group<?php if( form_error('sort_'.$item['id']) != "" ) { echo " has-error has-feedback"; } ?>">
                                    <input style="width: 200px;" type="text" id="sort_<?php echo $item['id']; ?>" class="form-control" name="sort_<?php echo $item['id']; ?>"<?php if( form_error('sort_'.$item['id']) != "" ) { echo " aria-describedby=\"sort_" . $item['id'] . "_HelpBlock\""; } ?> value="<?php echo $sort_value; ?>" >
                                    <?php if( form_error('sort_'.$item['id']) != "" ) : ?>
                                        <span class="glyphicon glyphicon-remove form-control-feedback" aria-hidden="true"></span>
                                        <span id="sort_<?php echo $item['id']; ?>_HelpBlock" class="help-block"><?php echo form_error('sort_'.$item['id']); ?></span>
                                    <?php endif; ?>
                                </div> 
                            </td>
                            <td>
                                <div class="form-group<?php if( form_error('name_'.$item['id']) != "" ) { echo " has-error has-feedback"; } ?>">
                                    <input style="width: 200px;" type="text" id="name_<?php echo $item['id']; ?>" class="form-control" name="name_<?php echo $item['id']; ?>"<?php if( form_error('name_'.$item['id']) != "" ) { echo " aria-describedby=\"name_" . $item['id'] . "_HelpBlock\""; } ?> value="<?php echo $name_value; ?>" >
                                    <?php if( form_error('name_'.$item['id']) != "" ) : ?>
                                        <span class="glyphicon glyphicon-remove form-control-feedback" aria-hidden="true"></span>
                                        <span id="name_<?php echo $item['id']; ?>_HelpBlock" class="help-block"><?php echo form_error('name_'.$item['id']); ?></span>
                                    <?php endif; ?>
                                </div> 
                            </td>
                            <td>
                                <div class="form-group<?php if( form_error('price_'.$item['id']) != "" ) { echo " has-error has-feedback"; } ?>">
                                    <input style="width: 200px;" type="text" id="price_<?php echo $item['id']; ?>" class="form-control" name="price_<?php echo $item['id']; ?>"<?php if( form_error('price_'.$item['id']) != "" ) { echo " aria-describedby=\"price_" . $item['id'] . "_HelpBlock\""; } ?> value="<?php echo $price_value; ?>" >
                                    <?php if( form_error('price_'.$item['id']) != "" ) : ?>
                                        <span class="glyphicon glyphicon-remove form-control-feedback" aria-hidden="true"></span>
                                        <span id="price_<?php echo $item['id']; ?>_HelpBlock" class="help-block"><?php echo form_error('price_'.$item['id']); ?></span>
                                    <?php endif; ?>
                                </div> 
                            </td>
                            <td><?php if( isset( $category_names[$item['category_id']] ) ) { echo $category_names[$item['category_id']]; } ?></td>
                            <td>
                                <div class="form-group">
                                    <input type="checkbox" id="is_bestseller_<?php echo $item['id']; ?>" name="is_bestseller_<?php echo $item['id']; ?>" <?php if( ( $is_bestseller_value == "on" ) || ( $is_bestseller_value == 1 ) ) { echo "checked"; } ?>>
                                    
                                </div> 
                            </td>
                            <td><a href="/admin/catalog_edit/<?php echo $item['id']; ?>/">[Редактировать]</a></td>
                            <td><a href="/admin/catalog_delete/<?php echo $item['id']; ?>/">[Удалить]</a></td>
                        </tr>
                        <?php endforeach; ?>               
                    </tbody>
                </table>
                               
                <button class="btn btn-md btn-primary btn-block" type="submit" id="proj_list_save" >Сохранить</button>
            
            </form>
            <?php endif; ?>
            
        </div>
    
    </div>
    
</div>
