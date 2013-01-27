<!DOCTYPE html>
<html>
  <header>
    <title>Исполнители</title>
    <?php echo $app->render('header-common.html.haml') ?>
  </header>
  <body>
    <div <?php atts(array('id' => 'header')); ?>>
      <?php echo $app->render('search-form.html.haml', array('relPath' => './')) ?>
    </div>
    <div <?php atts(array('id' => 'container')); ?>>
      <p>
        Исполнители начинающиеся на
        <?php echo quote($letter) ?>
      </p>
      <p>
        Всего:
          <?php echo $count ?>
      </p>
      <?php echo $app->render('singers.html.haml', array('app' => $app, 'singers' => $singers)) ?>
    </div>
  </body>
</html>
