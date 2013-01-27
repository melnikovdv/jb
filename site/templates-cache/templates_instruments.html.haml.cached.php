<div <?php atts(array('id' => 'instruments')); ?>>
  <ul>
    <?php foreach($instruments as $key => $s)            : ?>
      <li>
        <?php if (!isset($pathToInstruments)): ?>
          <?php $pathToInstruments = ''; ?>
        <?php endif; ?>
        <?php $tmp = $pathToInstruments . 'spec-search?instrument=' . $s->getName(); ?>
        <a href="<?php echo $tmp ; ?>"><?php echo $s->getName() ?></a>
        <?php echo parenthesise($s->getCount()) ?>
      </li>
    <?php endforeach; ?>
  </ul>
</div>
