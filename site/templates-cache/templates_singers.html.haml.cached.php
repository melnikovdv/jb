<div <?php atts(array('id' => 'singers')); ?>>
  <ul>
    <?php foreach($singers as $key => $s)            : ?>
      <li>
        <?php if (isset($pathToSinger)): ?>
          <a href="<?php echo $s->getLink($pathToSinger); ?>"><?php echo $s->getName() ?></a>
        <?php endif; ?>
        <?php if (!isset($pathToSinger)): ?>
          <a href="<?php echo $s->getLink(); ?>"><?php echo $s->getName() ?></a>
        <?php endif; ?>
      </li>
    <?php endforeach; ?>
  </ul>
</div>
