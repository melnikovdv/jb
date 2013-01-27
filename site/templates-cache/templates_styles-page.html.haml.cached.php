<!DOCTYPE html>
<html>
  <head>
    <title><?php echo title('Cтили') ?></title>
    <?php echo $app->render('header-common.html.haml') ?>
  </head>
  <body>
    <div <?php atts(array('class' => 'container-narrow')); ?>>
      <?php echo $app->render('search-form.html.haml', array('relPath' => './')) ?>
      <h3>Все стили</h3>
      <?php echo $app->render('styles.html.haml', array('app' => $app, 'styles' => $styles)) ?>
    </div>
    <div <?php atts(array('id' => 'footer')); ?>></div>
  </body>
</html>
