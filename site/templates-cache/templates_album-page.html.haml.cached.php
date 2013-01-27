<!DOCTYPE html>
<html>
  <head>
    <title><?php echo title('Исполнитель: ' . $singer->getName() . ', альбом ' . $album->getName()) ?></title>
    <?php echo $app->render('header-common.html.haml')         ?>
  </head>
  <body>
    <div <?php atts(array('class' => 'container-narrow')); ?>>
      <?php echo $app->render('search-form.html.haml', array('relPath' => '../../')) ?>
      <h3>
        Альбом:
        <?php echo $album->getName()         ?>
        <?php if ($album->isDvd()): ?>
          <span <?php atts(array('class' => 'badge badge-info')); ?>>
            dvd
          </span>
        <?php endif; ?>
      </h3>
      <p>
        Исполнитель:
        <a href="<?php echo $singer->getLink('../../'); ?>"><?php echo $singer->getName() ?></a>
      </p>
      <p>
        Год:
        <?php echo $album->getYear() ?>
      </p>
      <div <?php atts(array('class' => 'row-fluid')); ?>>
        <div <?php atts(array('class' => 'span4')); ?>>
          <img <?php atts(array('class' => 'img-polaroid', 'src' => $album->getImgLink(), 'width' => '200')); ?>></img>
        </div>
        <div <?php atts(array('class' => 'span8')); ?>>
          <pre <?php atts(array('class' => 'font')); ?>><?php echo $album->getDescr() ?></pre>
        </div>
      </div>
    </div>
  </body>
</html>
