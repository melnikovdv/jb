<div <?php atts(array('id' => 'styles')); ?>>
  <ul>
    <?php foreach($styles as $key => $s)            : ?>
      <li>
        <?php if (!isset($pathToStyles)): ?>
          <?php $pathToStyles = ''; ?>
        <?php endif; ?>
        <?php $tmp = $pathToStyles . 'spec-search?style=' . $s->getName(); ?>
        <a href="<?php echo $tmp ; ?>"><?php echo $s->getName() ?></a>
        <?php echo parenthesise($s->getCount()) ?>
      </li>
    <?php endforeach; ?>
  </ul>
</div>
