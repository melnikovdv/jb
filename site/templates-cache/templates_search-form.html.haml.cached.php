<div>
    <ul <?php atts(array('class' => 'nav nav-pills pull-right')); ?>>
      <li>
        <a href="<?php echo $relPath . '.'; ?>">
          <i <?php atts(array('class' => 'icon-book')); ?>></i>
          Магазин
        </a>
      </li>
      <li>
        <a href="<?php echo $relPath . 'order'; ?>">
          <i <?php atts(array('class' => 'icon-pencil')); ?>></i>
          Заказать
        </a>
      </li>
      <li>
        <a href="<?php echo $relPath . 'chatting'; ?>">
          <i <?php atts(array('class' => 'icon-user')); ?>></i>
          Общение
        </a>
      </li>
      <li>
        <a href='http://boogiewoogie.ru/'>
          <i <?php atts(array('class' => 'icon-home')); ?>></i>
          На главную
        </a>
      </li>
    </ul>
    <h3 <?php atts(array('class' => 'muted')); ?>><?php echo title() ?></h3>
  <div <?php atts(array('class' => 'clearfix')); ?>></div>
  <div <?php atts(array('class' => 'center')); ?>>
    <div <?php atts(array('id' => 'search')); ?>>
      <form <?php atts(array('class' => 'form-search', 'action' => $relPath . 'search', 'method' => 'post')); ?>>
        <div <?php atts(array('class' => 'input-append')); ?>>
          <input <?php atts(array('id' => 'searchField', 'class' => 'search-query', 'name' => 'text', 'type' => 'text', 'placeholder' => 'Поиск')); ?>></input>
          <button <?php atts(array('class' => 'btn', 'name' => 'submit', 'type' => 'submit')); ?>>Найти</button>
        </div>
        <div <?php atts(array('class' => 'clearfix')); ?>></div>
        <div>
          <label <?php atts(array('class' => 'radio')); ?>>
            <input <?php atts(array('id' => 'i1', 'name' => "type", 'type' => 'radio', 'value' => "singer", 'checked' => "true")); ?>>по исполнителям</input>
          </label>
          <label <?php atts(array('class' => 'radio')); ?>>
            <input <?php atts(array('id' => 'i2', 'name' => "type", 'type' => 'radio', 'value' => "album")); ?>>по альбомам</input>
          </label>
        </div>
      </form>
    </div>
  </div>
  <div <?php atts(array('class' => 'clearfix')); ?>></div>
  <div>
    <ul <?php atts(array('class' => 'nav nav-tabs')); ?>>
      <li <?php atts(array('class' => 'dropdown')); ?>>
        <a <?php atts(array('class' => 'dropdown-toggle', 'href' => $relPath . 'singers', 'data-toggle' => 'dropdown')); ?>>
          Исполнители
          <b <?php atts(array('class' => 'caret')); ?>></b>
        </a>
        <ul <?php atts(array('class' => 'dropdown-menu')); ?>>
          <li>
            <a href="<?php echo $relPath . 'singers'; ?>">Все исполнители</a>
          </li>
          <li <?php atts(array('class' => 'dropdown-submenu')); ?>>
            <a data-toggle='dropdown' tabindex="-1">
              По алфавиту
            </a>
            <ul <?php atts(array('class' => 'dropdown-menu')); ?>>
              <li <?php atts(array('class' => 'dropdown')); ?>>
                <a href="<?php echo $relPath . 'spec-search?letter=A'; ?>">A</a>
              </li>
              <li <?php atts(array('class' => 'dropdown')); ?>>
                <a href="<?php echo $relPath . 'spec-search?letter=B'; ?>">B</a>
              </li>
              <li <?php atts(array('class' => 'dropdown')); ?>>
                <a href="<?php echo $relPath . 'spec-search?letter=C'; ?>">C</a>
              </li>
              <li <?php atts(array('class' => 'dropdown')); ?>>
                <a href="<?php echo $relPath . 'spec-search?letter=D'; ?>">D</a>
              </li>
              <li <?php atts(array('class' => 'dropdown')); ?>>
                <a href="<?php echo $relPath . 'spec-search?letter=E'; ?>">E</a>
              </li>
              <li <?php atts(array('class' => 'dropdown')); ?>>
                <a href="<?php echo $relPath . 'spec-search?letter=F'; ?>">F</a>
              </li>
              <li <?php atts(array('class' => 'dropdown')); ?>>
                <a href="<?php echo $relPath . 'spec-search?letter=G'; ?>">G</a>
              </li>
              <li <?php atts(array('class' => 'dropdown')); ?>>
                <a href="<?php echo $relPath . 'spec-search?letter=H'; ?>">H</a>
              </li>
              <li <?php atts(array('class' => 'dropdown')); ?>>
                <a href="<?php echo $relPath . 'spec-search?letter=I'; ?>">I</a>
              </li>
              <li <?php atts(array('class' => 'dropdown')); ?>>
                <a href="<?php echo $relPath . 'spec-search?letter=J'; ?>">J</a>
              </li>
              <li <?php atts(array('class' => 'dropdown')); ?>>
                <a href="<?php echo $relPath . 'spec-search?letter=K'; ?>">K</a>
              </li>
              <li <?php atts(array('class' => 'dropdown')); ?>>
                <a href="<?php echo $relPath . 'spec-search?letter=L'; ?>">L</a>
              </li>
              <li <?php atts(array('class' => 'dropdown')); ?>>
                <a href="<?php echo $relPath . 'spec-search?letter=M'; ?>">M</a>
              </li>
              <li <?php atts(array('class' => 'dropdown')); ?>>
                <a href="<?php echo $relPath . 'spec-search?letter=N'; ?>">N</a>
              </li>
              <li <?php atts(array('class' => 'dropdown')); ?>>
                <a href="<?php echo $relPath . 'spec-search?letter=O'; ?>">O</a>
              </li>
              <li <?php atts(array('class' => 'dropdown')); ?>>
                <a href="<?php echo $relPath . 'spec-search?letter=P'; ?>">P</a>
              </li>
              <li <?php atts(array('class' => 'dropdown')); ?>>
                <a href="<?php echo $relPath . 'spec-search?letter=Q'; ?>">Q</a>
              </li>
              <li <?php atts(array('class' => 'dropdown')); ?>>
                <a href="<?php echo $relPath . 'spec-search?letter=R'; ?>">R</a>
              </li>
              <li <?php atts(array('class' => 'dropdown')); ?>>
                <a href="<?php echo $relPath . 'spec-search?letter=S'; ?>">S</a>
              </li>
              <li <?php atts(array('class' => 'dropdown')); ?>>
                <a href="<?php echo $relPath . 'spec-search?letter=T'; ?>">T</a>
              </li>
              <li <?php atts(array('class' => 'dropdown')); ?>>
                <a href="<?php echo $relPath . 'spec-search?letter=U'; ?>">U</a>
              </li>
              <li <?php atts(array('class' => 'dropdown')); ?>>
                <a href="<?php echo $relPath . 'spec-search?letter=V'; ?>">V</a>
              </li>
              <li <?php atts(array('class' => 'dropdown')); ?>>
                <a href="<?php echo $relPath . 'spec-search?letter=W'; ?>">W</a>
              </li>
              <li <?php atts(array('class' => 'dropdown')); ?>>
                <a href="<?php echo $relPath . 'spec-search?letter=X'; ?>">X</a>
              </li>
              <li <?php atts(array('class' => 'dropdown')); ?>>
                <a href="<?php echo $relPath . 'spec-search?letter=Y'; ?>">Y</a>
              </li>
              <li <?php atts(array('class' => 'dropdown')); ?>>
                <a href="<?php echo $relPath . 'spec-search?letter=Z'; ?>">Z</a>
              </li>
            </ul>
          </li>
        </ul>
      </li>
      <li>
        <a href="<?php echo $relPath . 'albums'; ?>">Альбомы</a>
      </li>
      <li>
        <a href="<?php echo $relPath . 'dvd'; ?>">DVD</a>
      </li>
      <li>
        <a href="<?php echo $relPath . 'styles'; ?>">Стили</a>
      </li>
      <li>
        <a href="<?php echo $relPath . 'instruments'; ?>">Инструменты</a>
      </li>
    </ul>
  </div>
</div>
