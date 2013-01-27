<!DOCTYPE html>
<html>
  <header>
    <title>Исполнители</title>
    <?php echo $app->render('header-common.html.haml') ?>
  </header>
  <body>
    <div <?php atts(array('id' => 'header')); ?>></div>
    <div <?php atts(array('id' => 'container')); ?>>
      <?php echo $app->render('search-form.html.haml') ?>
      <p>
        <?php if (isset($search)): ?>
          Вы искали:
          <span><?php echo $search ?></span>
          <br></br>
          Найдено:
          <?php $i = count($singers) ?>
          <?php echo $i ?>
        <?php endif; ?>
      </p>
      <?php if (isset($search))        : ?>
        <b>Результаты</b>
        <?php if ($singertype): ?>
          <div <?php atts(array('id' => 'singers')); ?>>
            <ul>
              <?php foreach($singers as $key => $s)            : ?>
                <li>
                  <a href="<?php echo $s->getLink(); ?>"><?php echo $s->getName() ?></a>
                </li>
              <?php endforeach; ?>
            </ul>
          </div>
        <?php endif; ?>
        <?php else : ?>
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
        <?php endif; ?>
      <?php endif; ?>
    </div>
  </body>
</html>
