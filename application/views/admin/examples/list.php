<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
    <h1 class="page-header"><?php echo $header; ?></h1>
    <div class="row">
        <div class="col-md-8">
            
            <a href="/admin/example_add/">
                <button type="button" class="btn btn-default btn-sm" id="add_new_project">
                    <span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Добавить галерею
                </button>
            </a>            
            
            <?php if( isset( $items ) && ( count( $items ) > 0 ) ) : ?>
            
            <?php               
                $category_names = array();
                foreach( $categories as $category ) {
                    $category_names[$category['id']] = $category['name'];
                } // End foreach
                
                $item_names = array();
                foreach( $projects as $project ) {
                    $item_names[$project['id']] = $project['name'];
                } // End foreach
            ?>  
        
            <table class="table">
                <thead>
                    <tr>
                        <th>Галерея</th>
                        <th>Категория</th>
                        <th>Проект</th>
                        <th></th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach( $items as $item ) : ?>
                    <tr>
                        <td>
                            <?php echo $item['name']; ?>
                            <?php if( isset($item['img']) ) : ?>
                                <img src="<?php echo $data_img_path . $item['img']; ?>" width="100" class="img-thumbnail" />
                            <?php endif; ?>
                        </td>
                        <td><?php if( isset( $category_names[$item['category_id']] ) ) { echo $category_names[$item['category_id']]; } ?></td>
                        <td><?php if( isset( $item_names[$item['item_id']] ) ) { echo $item_names[$item['item_id']]; } ?></td>
                        <td><a href="/admin/example_edit/<?php echo $item['id']; ?>/">[Редактировать]</a></td>
                        <td><a href="/admin/example_delete/<?php echo $item['id']; ?>/">[Удалить]</a></td>
                    </tr>
                    <?php endforeach; ?>               
                </tbody>
            </table>

            <?php endif; ?>
            
        </div>
    
    </div>
    
</div>
