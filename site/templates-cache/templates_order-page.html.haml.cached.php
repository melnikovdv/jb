<!DOCTYPE html>
<html>
  <head>
    <title><?php echo title('Форма заказа') ?></title>
    <?php echo $app->render('header-common.html.haml') ?>
  </head>
  <body>
    <div <?php atts(array('class' => 'container-narrow')); ?>>
      <?php echo $app->render('search-form.html.haml', array('relPath' => './')) ?>
      <?php if (!isset($params)): ?>
        <h3>Форма заказа</h3>
        <p>
          Для оформления заказа достаточно прислать список понравившихся Вам исполнителей и альбомов, наши менеджеры свяжутся с вами для дальнейшего обсуждения способов доставки и оплаты.
        </p>
        <?php echo $app->render('feedback-form.html.haml', array()) ?>
      <?php endif; ?>
      <?php if (isset($params))       : ?>
        <?php if (count($params['errors']) > 0)          : ?>
          <?php if (isset($params) && (count($params['errors']) > 0)): ?>
            <div <?php atts(array('class' => 'alert alert-error')); ?>>
              <ul <?php atts(array('class' => 'unstyled')); ?>>
                <li>
                  <span <?php atts(array('class' => 'label label-important')); ?>>Ошибка!</span>
                </li>
                <?php foreach($params['errors'] as $v): ?>
                  <li><?php echo $v ?></li>
                <?php endforeach; ?>
              </ul>
            </div>
          <?php endif; ?>
          <?php echo $app->render('feedback-form.html.haml', array('params' => $params)) ?>
        <?php endif; ?>
        <?php if (count($params['errors']) == 0): ?>
          <div <?php atts(array('class' => 'alert alert-success')); ?>>
            <span <?php atts(array('class' => 'label label-success')); ?>>Заказ отправлен</span>
          </div>
        <?php endif; ?>
      <?php endif; ?>
    </div>
  </body>
</html>
