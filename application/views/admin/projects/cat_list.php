<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
    <h1 class="page-header"><?php echo $header; ?></h1>
    <div class="row">
        <div class="col-md-8">
        
            <a href="/admin/catalog_cat_add/">
                <button type="button" class="btn btn-default btn-sm" id="add_new_category">
                    <span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Добавить категорию
                </button>
            </a>
            
            <form action="/admin/catalog_cat_list_action/" method="post">
            <?php if( isset( $items ) && ( count( $items ) > 0 ) ) : ?>
            
                <div class="dd">
                    <ol class="dd-list">
                    <?php foreach( $items as $item ) : ?>
                        <?php if( $item['parent_id'] == 0 ) : ?>
                            <?php
                                $sub_items = array();
                                foreach( $items as $sub_item ) {
                                    if( $sub_item['parent_id'] == $item['id'] ) $sub_items[] = $sub_item;
                                } // End foreach
                            ?>
                            <li class="dd-item" data-id="<?php echo $item['id']; ?>">
                                <div class="dd-handle"><?php echo $item['name']; ?></div> 
                                &nbsp; &nbsp; &nbsp;
                                <a href="/admin/catalog_cat_edit/<?php echo $item['id']; ?>/">[Редактировать]</a> 
                                <a href="/admin/catalog_cat_delete/<?php echo $item['id']; ?>/">[Удалить]</a>
                                <?php if( count($sub_items) > 0 ) : ?>
                                    <ol class="dd-list">
                                        <?php foreach( $sub_items as $sub_item ) : ?>
                                        <li class="dd-item" data-id="<?php echo $sub_item['id']; ?>">
                                            <div class="dd-handle"><?php echo $sub_item['name']; ?></div> 
                                            &nbsp; &nbsp; &nbsp;
                                            <a href="/admin/catalog_cat_edit/<?php echo $sub_item['id']; ?>/">[Редактировать]</a> 
                                            <a href="/admin/catalog_cat_delete/<?php echo $sub_item['id']; ?>/">[Удалить]</a>
                                        </li>
                                        <?php endforeach; ?>
                                    </ol>                                
                                <?php endif; ?>
                            </li>
                        <?php endif; ?>
                    <?php endforeach; ?>               
                    </ol>
                </div>
            <?php endif; ?>
            
            <input type="hidden" id="proj_cats_json_hidden" name="items_json" value="<?php echo $items_json; ?>">
                    
            <button class="btn btn-md btn-primary btn-block" type="submit" id="proj_cats_list_save" >Сохранить</button>
            
            </form>
            
        </div>
    
    </div>
    
</div>
