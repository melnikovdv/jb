<!DOCTYPE html>
<html>
  <head>
    <?php if ($type == 0): ?>
      <title><?php echo title('Все альбомы') ?></title>
    <?php endif; ?>
    <?php if ($type == 1)    : ?>
      <title><?php echo title('Все DVD') ?></title>
    <?php endif; ?>
    <?php echo $app->render('header-common.html.haml') ?>
  </head>
  <body>
    <div <?php atts(array('class' => 'container-narrow')); ?>>
      <?php echo $app->render('search-form.html.haml', array('relPath' => './')) ?>
      <?php if ($type == 0): ?>
        <h3>Все альбомы</h3>
      <?php endif; ?>
      <?php if ($type == 1): ?>
        <h3>Все DVD</h3>
      <?php endif; ?>
      <p>
        Всего:
        <?php echo count($albums) ?>
      </p>
      <?php echo $app->render('albums-list.html.haml', array('app' => $app, 'albums' => $albums, 'pathToAlbum' => './singers/')) ?>
    </div>
    <div <?php atts(array('id' => 'footer')); ?>></div>
  </body>
</html>
