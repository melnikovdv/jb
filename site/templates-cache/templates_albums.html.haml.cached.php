<div <?php atts(array('id' => 'albums')); ?>>
  <ul>
    <?php foreach($albums as $key => $a): ?>
      <li>
        <?php if ($a->isDvd()): ?>
          <span <?php atts(array('class' => 'badge badge-info')); ?>>
            dvd
          </span>
        <?php endif; ?>
        <a href="<?php echo $a->getLink($pathToAlbum); ?>"><?php echo $a->getName() ?></a>
        <?php echo parenthesise($a->getYear()) ?>
      </li>
    <?php endforeach; ?>
  </ul>
</div>
