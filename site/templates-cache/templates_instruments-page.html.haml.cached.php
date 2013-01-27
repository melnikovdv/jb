<!DOCTYPE html>
<html>
  <head>
    <title><?php echo title('Инструменты') ?></title>
    <?php echo $app->render('header-common.html.haml') ?>
  </head>
  <body>
    <div <?php atts(array('class' => 'container-narrow')); ?>>
      <?php echo $app->render('search-form.html.haml', array('relPath' => './')) ?>
      <h3>Все инструменты</h3>
      <?php echo $app->render('instruments.html.haml', array('app' => $app, 'styles' => $instruments)) ?>
    </div>
  </body>
</html>
