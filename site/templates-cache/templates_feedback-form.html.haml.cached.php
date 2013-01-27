<div>
  <form method="post" action="order">
    <label for='nameField'>Ваше имя</label>
    <input <?php atts(array('id' => 'nameField', 'name' => 'name', 'type' => 'text', 'placeholder' => 'Остап Бендер', 'value' => $params['name'])); ?>></input>
    <label for='emailField'>Ваш email</label>
    <input <?php atts(array('id' => 'emailField', 'class' => 'fbcontrol', 'name' => 'email', 'type' => 'email', 'placeholder' => 'ostap@email.com', 'value' => $params['email'])); ?>></input>
    <label for='orderField'>Описание заказа</label>
    <textarea <?php atts(array('id' => 'orderField', 'class' => 'input-xxlarge', 'name' => 'order', 'type' => 'text', 'rows' => "7")); ?>><?php echo $params['order'] ?></textarea>
    <?php captcha()         ?>
    <input <?php atts(array('class' => 'btn', 'name' => 'submit', 'type' => 'submit', 'value' => 'Отправить')); ?>></input>
  </form>
</div>
