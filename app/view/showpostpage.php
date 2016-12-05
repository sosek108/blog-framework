<h1><?php echo $post->getTitle()?></h1>
<div class="post">
    <div class="text"><?php echo $post->getText()?></div>
    <div class="footer"><?php echo $post->getAuthor()?> on <?php echo $post->getDate()->format('Y-m-d H:i') ?></div>
</div>

