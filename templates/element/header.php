<header class="site-header">
    <div class="site-header-header">Welcome to  <?= h($heading) ?></div>
    <nav>
        <ul>
            <li><?= $this->Html->link('Books', ['controller' => 'Books', 'action' => 'index', 'Books']) ?></li>
            <li><?= $this->Html->link('Author', ['controller' => 'Authors', 'action' => 'index', 'Author']) ?></li>
            <li><?= $this->Html->link('Publisher', ['controller' => 'Publishers', 'action' => 'index', 'Publisher']) ?></li>
        </ul>
    </nav>
</header>
