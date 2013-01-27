<!DOCTYPE html>
<html>
  <head>
    <title><?php echo title('Коллекция современного джаза, классики, блюза, рок-н-ролла и других направлений') ?></title>
    <?php echo $app->render('header-common.html.haml') ?>
  </head>
  <body>
      <div <?php atts(array('class' => 'container-narrow')); ?>>
        <?php echo $app->render('search-form.html.haml', array('relPath' => './'))           ?>
        <h3><?php echo 'Коллекция ' . title(); ?></h3>
        <div <?php atts(array('class' => 'row-fluid')); ?>>
          <div <?php atts(array('class' => 'span6')); ?>>
            <img <?php atts(array('class' => 'img-polaroid pull-left', 'src' => 'http://boogiewoogie.ru/images/headerpic1.jpg')); ?>></img>
          </div>
          <div <?php atts(array('class' => 'span5 offset1')); ?>>
            <ul <?php atts(array('class' => 'unstyled')); ?>>
              <!-- %li -->
              <!--   %h3= 'Коллекция ' . title(); -->
              <li>
                <h3 <?php atts(array('class' => 'muted')); ?>>современный джаз</h3>
              </li>
              <li>
                <h3 <?php atts(array('class' => 'muted')); ?>>классика</h3>
              </li>
              <li>
                <h3 <?php atts(array('class' => 'muted')); ?>>rock'n'roll</h3>
              </li>
              <li>
                <h3 <?php atts(array('class' => 'muted')); ?>>pop & rock</h3>
              </li>
              <li>
                <h3 <?php atts(array('class' => 'muted')); ?>>blues</h3>
              </li>
            </ul>
          </div>
        </div>
        <br />
        <h5>Вашему вниманию предлагается коллекция CD и DVD современного джаза самых разных направлений.</h5>
        <br />
        <p>
          Условия доставки и цены в файле
          <a href='fullbase.zip'>fullbase.zip</a>
          , там же полный список дисков исполнителей джаза, классики, pop&rock музыки.
        </p>
        <p>
          Коллекция постоянно пополняется, следите за обновлениями.
        </p>
        <p>
          По вопросам и предложениям можете обращаться по адресу
          <a href="mailto:gss@ru.ru">gss@ru.ru</a>
        </p>
        <br />
        <div <?php atts(array('class' => 'alert alert-info')); ?>>
          <span <?php atts(array('class' => 'badge badge-info')); ?>>
            Совет
          </span>
          Компакты можно заказывать не только в формате СD, но и в APE или FLAC.
        </div>
        <br />
        <h5 <?php atts(array('class' => 'muted center')); ?>>© BoogieWoogie.ru, 2013</h5>
      </div>
  </body>
</html>
