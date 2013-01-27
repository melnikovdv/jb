<!DOCTYPE html>
<html>
  <header>
    <title>Исполнитель</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"></meta>
    <?php include 'head.html' ?>
  </header>
  <body>
   <h1><?php echo $singer->getName() ?></h1>
   <img src="<?php echo $singer->getImgLink(); ?>"></img>
   <p>
      <pre><?php echo $singer->getDescr() ?></pre>
    <h2>Альбомы</h2>
   </p>
   <div <?php atts(array('id' => 'albums')); ?>>
      <ul>
        <?php foreach($albums as $key => $a): ?>
          <li>
            <a href="<?php echo $a->getLink(); ?>"><?php echo $a->getName() ?></a>
            <?php if ($a->isDvd()): ?>
              <span <?php atts(array('class' => 'dvd')); ?>>dvd</span>
            <?php endif; ?>
          </li>
        <?php endforeach; ?>
      </ul>
   </div>
  </body>
</html>
