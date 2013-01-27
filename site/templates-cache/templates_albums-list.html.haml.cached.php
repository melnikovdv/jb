<div <?php atts(array('id' => 'albums')); ?>>
  <ul>
    <?php foreach($albums as $key => $a): ?>
      <li>
        <a href="<?php echo $a->getLink($pathToAlbum); ?>"><?php echo $a->getName() ?></a>
        <?php echo parenthesise($a->getYear()) ?>
        <?php echo '-' ?>
        <?php echo $a->getDescr() ?>
      </li>
    <?php endforeach; ?>
  </ul>
</div>
