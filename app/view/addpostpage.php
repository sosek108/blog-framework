<h1>Create post</h1>

<form method="post">
    <div class="form-group">
        <label for="title">Title</label>
        <input class="form-control" type="text" name="title" id="title" placeholder="Fancy and short title"/>
    </div>
    <div class="form-group">
        <label for="text">Text</label>
        <textarea class="form-control" name="text" id="text" cols="30" rows="10" placeholder="Long text"></textarea>
    </div>
    <div class="form-group">
        <label for="author">Author</label>
        <input class="form-control" type="text" name="author" id="author" value="<?php echo $this->user->getFullName();?>"/>
    </div>
    <input type="submit" class="btn btn-success" value="Save"/>
</form>