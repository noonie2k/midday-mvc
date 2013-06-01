<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />

    <title><?php echo isset($this->view['title']) ? $this->view['title'] : 'Midday MVC' ?></title>
</head>
<body>
    <?php echo $this->content(); ?>
</body>
</html>