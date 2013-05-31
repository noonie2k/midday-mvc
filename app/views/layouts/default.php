<!DOCTYPE html>
<html>
<head>
    <title><?php echo isset($this->view['title']) ? $this->view['title'] : 'MVC' ?></title>
</head>
<body>
    <?php echo $this->content(); ?>
</body>
</html>