<!DOCTYPE html>
<html>
  <head>
    <title><?php echo title('Исполнители') ?></title>
    <?php echo $app->render('header-common.html.haml') ?>
  </head>
  <body>
    <div <?php atts(array('class' => 'container-narrow')); ?>>
      <?php echo $app->render('search-form.html.haml', array('relPath' => './')) ?>
      <h3>Все исполнители</h3>
      <?php echo $app->render('singers.html.haml', array('app' => $app, 'singers' => $singers)) ?>
    </div>
  </body>
</html>
