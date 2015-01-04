<h2>Type <small><?= h($user->username) ?></small>
    <div class="btn-group pull-right">
        <?php
        echo $this->Html->link(
            '<span class="glyphicon glyphicon-pencil"></span> Edit',
            ['action' => 'edit', $user->id],
            ['escape' => false, 'class' => 'btn btn-primary']
        );
        echo $this->Form->postLink(
            '<span class="glyphicon glyphicon-trash"></span> Delete',
            ['action' => 'delete', $user->id],
            [
                'class' => 'btn btn-danger',
                'escape' => false,
                'confirm' => __('Are you sure you want to delete {0}?', $user->username)]
        );
    ?>
</div>
</h2>

<div class="panel panel-default">
    <div class="panel-body">
        <dl class="dl-horizontal">
            <dt>ID</dt>
            <dd>
                <?= h($user->id); ?>
            </dd>
            <dt>Created</dt>
            <dd>
                <?= $this->Time->nice($user->created); ?>
            </dd>
            <dt>Modified</dt>
            <dd>
                <?= $this->Time->nice($user->modified); ?>
            </dd>
            <dt>Display Name</dt>
            <dd>
                <?= h($user->display_name); ?>
            </dd>
            <dt>E-Mail</dt>
            <dd>
                <?= h($user->email); ?>
            </dd>
            <dt>Credits</dt>
            <dd>
                <?= h($user->credits); ?>
            </dd>
            <dt>Lifetime Points</dt>
            <dd>
                <?= h($user->lifetime_points); ?>
            </dd>
            <dt>Votes</dt>
            <dd>
                <?= h($user->votes_count); ?>
            </dd>
        </dl>
    </div><!--/.panel-body -->
</div><!--/.panel -->

<?php if ($user->comments): ?>
<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title">Related Comments</h3>
    </div>
    <table class="table">
        <thead>
            <tr>
                <th>Time</th>
                <th>Task</th>
                <th>Text</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($user->comments as $comment): ?>
                <td><?= $this->Time->nice($comment->created) ?></td>
                <td>
                    <?= $this->Html->link($comment->task_id, ['controller' => 'Tasks', 'action' => 'view', $comment->task_id]) ?>
                </td>
                <td><?= h($comment->text) ?></td>
            <?php endforeach; ?>
        </tbody>
    </table>
</div><!--/.panel -->
<?php endif; ?>

<?php if ($user->completions): ?>
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">Related Completions</h3>
        </div>
        <table class="table">
            <thead>
                <tr>
                    <th>Time</th>
                    <th>Task</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($user->completions as $completion): ?>
                    <td><?= $this->Time->nice($completion->created) ?></td>
                    <td>
                        <?= $this->Html->link($completion->task_id, ['controller' => 'Completions', 'action' => 'view', $completion->task_id]) ?>
                    </td>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div><!--/.panel -->
<?php endif; ?>

<?php if ($user->flags): ?>
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">Related Flags</h3>
        </div>
        <table class="table">
            <thead>
                <tr>
                    <th>Time</th>
                    <th>Task</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($user->flags as $flag): ?>
                    <td><?= $this->Time->nice($flag->created) ?></td>
                    <td>
                        <?= $this->Html->link($flag->completion_id, ['controller' => 'Completions', 'action' => 'view', $flag->completion_id]) ?>
                    </td>
                    <td>
                        <?= $this->Html->link($flag->status, ['controller' => 'Flags', 'action' => 'view', $flag->id]) ?>
                    </td>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div><!--/.panel -->
<?php endif; ?>

<?php if ($user->gifts): ?>
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">Related Gifts</h3>
        </div>
        <table class="table">
            <thead>
                <tr>
                    <th>Time</th>
                    <th>Task</th>
                    <th>Credits</th>
                    <th>Points</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($user->gifts as $gift): ?>
                    <td><?= $this->Time->nice($gift->created) ?></td>
                    <td>
                        <?= $this->Html->link($gift->task_id, ['controller' => 'Gifts', 'action' => 'view', $gift->task_id]) ?>
                    </td>
                    <td><?= h($gift->credits) ?></td>
                    <td><?= h($gift->points) ?></td>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div><!--/.panel -->
<?php endif; ?>

<?php if ($user->tasks): ?>
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">Related Tasks</h3>
        </div>
        <table class="table">
            <thead>
                <tr>
                    <th>Time</th>
                    <th>Task</th>
                    <th>Points</th>
                    <th>Completions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($user->tasks as $task): ?>
                    <td><?= $this->Time->nice($task->created) ?></td>
                    <td>
                        <?= $this->Html->link($task->name, ['controller' => 'Tasks', 'action' => 'view', $task->task_id]) ?>
                    </td>
                    <td><?= h($task->points) ?></td>
                    <td><?= h($task->completions_count) ?></td>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div><!--/.panel -->
<?php endif; ?>

<?php if ($user->votes): ?>
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">Related Votes</h3>
        </div>
        <table class="table">
            <thead>
                <tr>
                    <th>Time</th>
                    <th>Task</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($user->votes as $vote): ?>
                    <td><?= $this->Time->nice($vote->created) ?></td>
                    <td>
                        <?= $this->Html->link($vote->task_id, ['controller' => 'Tasks', 'action' => 'view', $vote->task_id]) ?>
                    </td>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div><!--/.panel -->
<?php endif; ?>
