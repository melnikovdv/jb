<!DOCTYPE html>
<html>
  <head>
    <title><?php echo title('Поиск') ?></title>
    <?php echo $app->render('header-common.html.haml') ?>
  </head>
  <body>
    <div <?php atts(array('class' => 'container-narrow')); ?>>
      <?php echo $app->render('search-form.html.haml', array('relPath' => './')) ?>
      <p>
        <?php if (isset($search)): ?>
          Вы искали:
          <span><?php echo $search ?></span>
          <br></br>
          Найдено:
          <?php echo $count ?>
        <?php endif; ?>
      </p>
      <?php if (isset($search))        : ?>
        <b>Результаты</b>
        <?php if ($singertype): ?>
          <?php echo $app->render('singers.html.haml', array('app' => $app, 'singers' => $singers))   ?>
        <?php endif; ?>
        <?php if (!$singertype): ?>
          <?php echo $app->render('albums.html.haml', array('app' => $app, 'albums' => $albums)) ?>
        <?php endif; ?>
      <?php endif; ?>
    </div>
  </body>
</html>
