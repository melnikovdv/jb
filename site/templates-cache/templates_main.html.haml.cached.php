<!DOCTYPE html>
<html>
  <header>
    <title>Исполнители</title>
    <?php echo $app->render('header-common.html.haml') ?>
  </header>
  <body>
    <div <?php atts(array('id' => 'header')); ?>></div>
    <div <?php atts(array('id' => 'container')); ?>>
      <h2>Сайт джазовой музыки</h2>
      <?php echo $app->render('search-form.html.haml') ?>
    </div>
    <!--   %h1 Все исполнители -->
    <!--   %p Текст рыба для всех исполнителей -->
    <!--   %div#singers -->
    <!--     %ul -->
    <!--       - foreach($singers as $key => $s) -->
    <!--         %li -->
    <!--           %a{:href => $s->getLink()}= $s->getName() -->
    <!-- %div#footer -->
  </body>
</html>
