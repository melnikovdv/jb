<!DOCTYPE html>
<html>
  <head>
    <title>Альбом</title>
    <?php echo $app->render('header-common.html.haml')         ?>
  </head>
  <body>
   <div <?php atts(array('id' => 'album')); ?>>
      <p>
        Исполнитель:
        <?php echo $singer->getName() ?>
        <br />
        Альбом:
        <?php echo $album->getName()         ?>
        <?php if ($album->isDvd()): ?>
          <span <?php atts(array('class' => 'dvd')); ?>>
            dvd
          </span>
        <?php endif; ?>
        <br />
        Год:
        <?php echo $album->getYear() ?>
        <br />
        <img src="<?php echo $album->getImgLink(); ?>"></img>
        <br />
        Описание:
        <pre><?php echo $album->getDescr() ?></pre>
      </p>
   </div>
  </body>
</html>
