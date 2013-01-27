<!DOCTYPE html>
<html>
  <head>
    <title><?php echo title('Поиск') ?></title>
    <?php echo $app->render('header-common.html.haml') ?>
  </head>
  <body>
    <div <?php atts(array('class' => 'container-narrow')); ?>>
      <?php echo $app->render('search-form.html.haml', array('relPath' => './')) ?>
      <?php if (isset($letter)): ?>
        <h3>
          Исполнители начинающиеся на
          <?php echo quote($letter)           ?>
        </h3>
      <?php endif; ?>
      <?php if (isset($style)): ?>
        <h3>
          Исполнители со стилем
          <?php echo quote($style) ?>
        </h3>
      <?php endif; ?>
      <?php if (isset($instrument)): ?>
        <h3>
          Инструменты
          <?php echo quote($instrument) ?>
        </h3>
      <?php endif; ?>
      <p>
        Всего:
          <?php echo count($singers) ?>
      </p>
      <?php echo $app->render('singers.html.haml', array('app' => $app, 'singers' => $singers)) ?>
    </div>
  </body>
</html>
