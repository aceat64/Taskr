<div class="task view">
    <h2 class="task-title">
        <?php
        switch ($task->status) {
            case 'completed':
                echo '<small class="text-success">[Completed]</small> ';
                break;
            case 'closed':
                echo '<small class="text-danger">[Closed]</small> ';
                break;
        }
        echo h($task->name);
        ?>
    </h2>

    <div class="row">
        <div class="col-sm-8 col-sm-offset-2">
            <p>

            </p>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">
                    <?php
                    echo $this->Number->format($task->total_points);
                    echo $task->total_points == 1 ? ' point' : ' points';
                    echo ' - ';
                    echo $this->Time->timeAgoInWords($task->created, ['end' => '+1 year']);
                    echo ' by ';
                    echo $this->Html->link($task->user->username, ['controller' => 'Users', 'action' => 'view', $task->user->id]);
                    ?>
                    </h3>
                </div>
                <div class="panel-body">
                    <p><?= h($task->description); ?></p>
                </div><!--/.panel-body -->
                <div class="panel-footer">
                    <div class="btn-group">
                        <?php
                        if ($task->status == 'open' && $this->UserData->id()) {
                            echo $this->Html->link('I Did This', ['action' => 'complete', $task->id], ['class' => 'btn btn-success']);
                        }
                        ?>
                    </div>
                    <div class="btn-group">
                        <?= $this->Html->link('Comment', '#comment', ['class' => 'btn btn-primary']) ?>
                    </div>
                    <div class="btn-group">
                        <?= $this->Html->link('Share', '#share', ['class' => 'btn btn-info']) ?>
                    </div>
                    <?php if ($task->user_id == $this->UserData->id() || $this->UserData->admin()): ?>
                    <div class="btn-group">
                        <?= $this->Html->link('Edit Task', ['action' => 'edit', $task->id], ['class' => 'btn btn-default']) ?>
                        <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                            <span class="caret"></span>
                            <span class="sr-only">Toggle Dropdown</span>
                        </button>
                        <ul class="dropdown-menu" role="menu">
                            <li>
                                <?php
                                echo $this->Form->postLink('
                                    Close Task',
                                    ['action' => 'close', $task->id],
                                    ['confirm' => 'Closing this task will not award any points, are you sure?']
                                );
                                ?>
                            </li>
                        </ul>
                    </div>
                    <?php endif; ?>
                </div>
            </div><!--/.panel -->
        </div><!--/.col-sm-12 -->
    </div><!--/.row -->
    <div class="row">
        <div class="col-sm-4">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Likes (<?= $task->vote_count ?>)
                    <?php
                    if ($task->user_id == $this->UserData->id() || !$this->UserData->id()) {
                        echo '';
                    } elseif ($task->voted) {
                        echo $this->Form->postLink(
                            'Unlike',
                            ['action' => 'unlike', $task->id],
                            ['escape' => false, 'class' => 'btn btn-warning btn-xs pull-right']
                        );
                    } else {
                        echo $this->Form->postLink(
                            '<span class="glyphicon glyphicon-thumbs-up" aria-hidden="true"></span> Like',
                            ['action' => 'like', $task->id],
                            ['escape' => false, 'class' => 'btn btn-primary btn-xs pull-right']
                        );
                    }
                    ?>
                </div>
                <div class="panel-body">
                    <?php
                    $vote_links = [];
                    foreach ($task->votes as $vote) {
                        $vote_links[] = $this->Html->link($vote->user->username, ['controller' => 'users', 'action' => 'profile', $vote->user->username]);
                    }
                    echo '<p>' . (count($vote_links) ? implode(', ', $vote_links) : 'none') . '</p>';
                    ?>
                </div><!--/.panel-body -->
            </div><!--/.panel -->
        </div><!--/.col-sm-4 -->
        <div class="col-sm-4">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Gift Points (<?= $task->gift_points ?>)
                    <?php
                    if ($this->UserData->id() && !$task->gifted) {
                        echo $this->Form->postLink(
                            '<span class="glyphicon glyphicon-gift" aria-hidden="true"></span> Gift',
                            ['action' => 'gift', $task->id],
                            ['escape' => false, 'class' => 'btn btn-primary btn-xs pull-right']
                        );
                    }
                    ?>
                </div>
                <div class="panel-body">
                    <?php
                    $gift_links = [];
                    foreach ($task->gifts as $gift) {
                        $gift_links[] = $this->Html->link($gift->user->username . "({$gift->points})", ['controller' => 'users', 'action' => 'profile', $gift->user->username]);
                    }
                    echo '<p>' . (count($gift_links) ? implode(', ', $vote_links) : 'none') . '</p>';
                    ?>
                </div><!--/.panel-body -->
            </div><!--/.panel -->
        </div><!--/.col-sm-4 -->
        <div class="col-sm-4">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Tags (<?= count($task->tags) ?>)
                    <?php
                    if ($this->UserData->id()) {
                        echo $this->Form->postLink(
                        '<span class="glyphicon glyphicon-tag" aria-hidden="true"></span> Add Tag',
                        ['action' => 'tag', $task->id],
                        ['escape' => false, 'class' => 'btn btn-primary btn-xs pull-right']
                    );
                }
                ?>
                </div>
                <div class="panel-body">
                    <?php
                    $tag_links = [];
                    foreach ($task->tags as $tag) {
                        $tag_links[] = $this->Html->link($tag->name, ['action' => 'tagged', $tag->name]);
                    }
                    echo '<p>' . (count($tag_links) ? implode(', ', $tag_links) : 'none') . '</p>';
                    ?>
                </div><!--/.panel-body -->
            </div><!--/.panel -->
        </div><!--/.col-sm-4 -->
    </div><!--/.row -->

    <?php if ($task->completion_count != 0): ?>
    <div class="row">
        <div class="col-sm-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Comments (<?= $task->comment_count ?>)
                </div>
                <div class="panel-body">
                    <?php
                    if ($task->comment_count == 0) {
                        echo '<p>No comments</p>';
                    } else {

                    }
                    ?>
                </div><!--/.panel-body -->
            </div><!--/.panel -->
        </div><!--/.col-sm-12 -->
    </div><!--/.row -->
    <?php endif; ?>

    <div class="row">
        <div class="col-sm-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Comments (<?= $task->comment_count ?>)
                </div>
                <div class="panel-body">
                    <?php
                    if ($task->comment_count == 0) {
                        echo '<p>No comments</p>';
                    } else {

                    }
                    ?>
                </div><!--/.panel-body -->
            </div><!--/.panel -->
        </div><!--/.col-sm-12 -->
    </div><!--/.row -->
</div><!--/.task -->
