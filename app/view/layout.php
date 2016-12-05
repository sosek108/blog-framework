<html>
<head>
    <title><?php !empty($title) ? $title . ' | ' : '' ?>Navabi blog</title>
    <link rel="stylesheet" href="<?php echo $this->getPrefix()?>assets/css/font-awesome.min.css"/>
    <link rel="stylesheet" href="<?php echo $this->getPrefix()?>assets/css/bootstrap.min.css"/>
    <link rel="stylesheet" href="<?php echo $this->getPrefix()?>assets/css/app.css"/>
</head>
<body>
    <div class="container">
        <header>
            <a href="/">
                <h1>Navabi</h1>
                <h2>Your imagination - your blog</h2>
            </a>
        </header>
        <hr/>
        <nav>
            <ul>
                <li><a href="/">Homepage</a></li>
                <li><a href="contact">Contact</a></li>
                <?php if (isset($this->user)): ?>
                    <li><a href="add">Add entry</a></li>
                    <li><a href="logout">Logout</a></li>
                <?php else: ?>
                    <li><a href="login">Login</a></li>
                <?php endif; ?>
            </ul>
        </nav>
        <hr/>
        <?php if (!empty($this->error)): ?>
            <div class="alert alert-danger"><?php echo $this->error; ?></div>
        <?php endif; ?>
        <?php if (!empty($this->message)): ?>
            <div class="alert alert-success"><?php echo $this->message; ?></div>
        <?php endif; ?>
        <?php require_once $template ?>
        <hr/>
        <footer>
            <div class="text-center">
                Copyright (C) 2016-Forever
            </div>
        </footer>
    </div>

    <script src="<?php echo $this->getPrefix()?>assets/js/jquery.min.js"></script>
    <script src="<?php echo $this->getPrefix()?>assets/js/tinymce/tinymce.min.js"></script>
    <script src="<?php echo $this->getPrefix()?>assets/js/bootstrap.min.js"></script>
    <script src="<?php echo $this->getPrefix()?>assets/js/app.js"></script>
</body>
</html>