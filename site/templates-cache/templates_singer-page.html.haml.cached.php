<!DOCTYPE html>
<html>
  <head>
    <title><?php echo title('Исполнитель ' . $singer->getName()) ?></title>
    <?php echo $app->render('header-common.html.haml')     ?>
  </head>
  <body>
    <div <?php atts(array('class' => 'container-narrow')); ?>>
      <?php echo $app->render('search-form.html.haml', array('relPath' => './../'))   ?>
     <h3><?php echo $singer->getName() ?></h3>
     <div <?php atts(array('class' => 'row-fluid')); ?>>
        <div <?php atts(array('class' => 'span4')); ?>>
          <img <?php atts(array('class' => 'img-polaroid', 'src' => $singer->getImgLink(), 'width' => '200px')); ?>></img>
        </div>
       <div <?php atts(array('class' => 'span8')); ?>>
          <pre <?php atts(array('class' => 'font')); ?>><?php echo $singer->getDescr() ?></pre>
       </div>
      <div <?php atts(array('class' => 'clearfix')); ?>></div>
      <div <?php atts(array('class' => 'row-fluid')); ?>>
        <div <?php atts(array('class' => 'span6')); ?>>
          <h3>Альбомы</h3>
          <?php echo $app->render('albums.html.haml', array('app' => $app, 'albums' => $albums, 'pathToAlbum' => './'))   ?>
        </div>
        <div <?php atts(array('class' => 'span6')); ?>>
          <?php if (count($styles) > 0): ?>
            <h3>Стили</h3>
            <?php echo $app->render('styles.html.haml', array('app' => $app, 'styles' => $styles, 'pathToStyles' => '../')) ?>
          <?php endif; ?>
          <?php if (count($instruments) > 0): ?>
            <h3>Инструменты</h3>
            <?php echo $app->render('instruments.html.haml', array('app' => $app, 'instruments' => $instruments, 'pathToInstruments' => '../')) ?>
          <?php endif; ?>
          <?php if (count($seealso) > 0): ?>
            <h3>См. также</h3>
            <?php echo $app->render('singers.html.haml', array('app' => $app, 'singers' => $seealso, 'pathToSinger' => '../')) ?>
          <?php endif; ?>
        </div>
      </div>
     </div>
    </div>
  </body>
</html>
