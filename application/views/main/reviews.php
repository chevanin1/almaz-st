<div class="panel panel-default reviews">
    <div class="panel-heading"><h2 class="panel-title">Отзывы</h2>
    </div>
    <div class="panel-body">
    <?php foreach( $items as $item_num => $item ) : ?>
        <blockquote class="blockquote-reverse">
            <p><?php echo $item['text']; ?></p>
            <footer><?php echo $item['author']; ?> <i><?php echo $item['date']; ?></i></footer>
        </blockquote>
    <?php endforeach; ?>
    </div>
</div>            