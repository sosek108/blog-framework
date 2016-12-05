<h1>Contact <?php if (isset($this->user)): ?><a href="?edit=1">edit</a> <?php endif;?></h1>

<div class="contact">
    <?php
        if ($edit) {
            echo '<form method="post"><textarea name="content">';
        }

        echo $content;

        if ($edit) {
            echo '</textarea>';
            echo '<input type="submit" class="btn btn-success" value="Save"/>';
            echo '</form>';
        }

    ?>
</div>