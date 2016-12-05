<h1>Welcome on Navabi blog</h1>

<div class="posts">
    <?php foreach($posts as $id => $post): ?>
        <div class="post">
            <div class="title"><a href="post?id=<?php echo $id; ?>"><?php echo $post->getTitle()?></a></div>
            <div class="text"><?php echo substr($post->getText(),0, 100)?></div>
            <div class="footer"><?php echo $post->getAuthor()?> on <?php echo $post->getDate()->format('Y-m-d H:i') ?></div>
        </div>
    <?php endforeach; ?>
    <?php if ($maxPage > 1): ?>
        <nav aria-label="Page navigation">
            <ul class="pagination">
                <?php for ($i = 1; $i <= $maxPage; $i++) {
                    $class = $i == $page ? 'active' : '';
                    echo "<li class='$class'><a href='/?page=$i'>$i</a></li>";
                } ?>
            </ul>
        </nav>
    <?php endif; ?>
</div>
