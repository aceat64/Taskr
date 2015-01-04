<!DOCTYPE html>
<html lang="en">
<head>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="">
    <meta name="author" content="">

    <?= $this->Html->meta('icon') ?>

    <title>Taskr: <?= $this->fetch('title') ?></title>

    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css">

    <!-- Optional theme -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap-theme.min.css">

    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
    <?= $this->fetch('script') ?>
    <?= $this->Html->css('main') ?>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body role="document">

    <!-- Fixed navbar -->
    <nav class="navbar navbar-default navbar-fixed-top">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <?= $this->Html->link($this->Html->image('logo.png', array('alt' => 'Dallas Makerspace')), 'http://dallasmakerspace.org', array('escape' => false, 'class' => 'navbar-brand')) ?>
                <?= $this->Html->link('Taskr', 'http://dallasmakerspace.org', array('class' => 'navbar-brand')) ?>
            </div>
            <div id="navbar" class="navbar-collapse collapse">
                <ul class="nav navbar-nav">
                    <li<?php if (in_array($this->request->params['action'], ['index']) && $this->name == 'Tasks') { echo ' class="active"'; } ?>>
                        <?= $this->Html->link('Tasks', ['controller' => 'Tasks', 'action' => 'index']) ?>
                    </li>
                    <li<?php if (in_array($this->request->params['action'], ['tags']) && $this->name == 'Tasks') { echo ' class="active"'; } ?>>
                        <?= $this->Html->link('Tags', ['controller' => 'Tasks', 'action' => 'tags']) ?>
                    </li>
                    <li<?php if (in_array($this->request->params['action'], ['leaderboard']) && $this->name == 'Tasks') { echo ' class="active"'; } ?>>
                        <?= $this->Html->link('Leaderboard', ['controller' => 'Tasks', 'action' => 'leaderboard']) ?>
                    </li>
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <?php if (!empty($userData)): ?>
                        <?php if ($userData['admin'] === true): ?>
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                    Admin <span class="caret"></span>
                                </a>
                                <ul class="dropdown-menu" role="menu">
                                    <li>
                                        <?= $this->Html->link('Flags', ['controller' => 'flags', 'action' => 'index']) ?>
                                    </li>
                                    <li>
                                        <?= $this->Html->link('List Users', ['controller' => 'Users', 'action' => 'index']) ?>
                                    </li>
                                    <li>
                                        <?= $this->Html->link('Add User', ['controller' => 'Users', 'action' => 'add']) ?>
                                    </li>
                                </ul>
                            </li>
                        <?php endif; ?>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                <?= $userData['username'] ?> <span class="caret"></span>
                            </a>
                            <ul class="dropdown-menu" role="menu">
                                <li>
                                    <?= $this->Html->link('Profile', ['controller' => 'Users', 'action' => 'profile']) ?>
                                </li>
                                <li>
                                    <?= $this->Html->link('Settings', ['controller' => 'Users', 'action' => 'settings']) ?>
                                </li>
                                <li class="divider"></li>
                                <li>
                                    <?= $this->Html->link('Logout', ['controller' => 'Users', 'action' => 'logout']) ?>
                                </li>
                            </ul>
                        </li>
                    <?php else: ?>
                        <li>
                            <?= $this->Html->link('Login', ['controller' => 'Users', 'action' => 'login']) ?>
                        </li>
                    <?php endif; ?>
                    <li<?php if($this->name == 'Pages' && strtolower($page) == 'help') { echo ' class="active"'; } ?>>
                        <?= $this->Html->link(__('Help', true), array('controller' => 'Pages', 'action' => 'display', 'help')) ?>
                    </li>
                </ul>
            </div><!--/.nav-collapse -->
        </div>
    </nav>

    <div class="container theme-showcase" role="main">
        <?= $this->Flash->render() ?>
        <?= $this->fetch('content') ?>
    </div><!--/.container -->

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <!-- Latest compiled and minified JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.min.js"></script>
</body>
</html>
