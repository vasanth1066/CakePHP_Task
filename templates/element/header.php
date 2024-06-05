<header class="site-header">
    <div class="site-header-header">Welcome to  <?= h($heading) ?></div>
    <nav>
        <ul>
            <li><?= $this->Html->link('Books', ['controller' => 'Books', 'action' => 'index', 'Books']) ?></li>
            <li><?= $this->Html->link('Author', ['controller' => 'Authors', 'action' => 'index', 'Author']) ?></li>
            <li><?= $this->Html->link('Publisher', ['controller' => 'Publishers', 'action' => 'index', 'Publisher']) ?></li>
            <li>
                <button><?= $this->Html->link('Logout', ['controller' => 'Users', 'action' => 'logout']) ?></button>
            </li>
        </ul>
      
    </nav>
</header>
