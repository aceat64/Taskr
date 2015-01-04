<h2><?php echo __('Users'); ?></h2>
<table class="table table-striped table-bordered table-condensed">
    <thead>
        <tr>
            <th><?= $this->Paginator->sort('username');?></th>
            <th><?= $this->Paginator->sort('display_name');?></th>
            <th><?= $this->Paginator->sort('email');?></th>
            <th><?= $this->Paginator->sort('credits');?></th>
            <th><?= $this->Paginator->sort('lifetime_points');?></th>
            <th><?= $this->Paginator->sort('votes_count');?></th>
            <th><?= __('Actions'); ?></th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($users as $user): ?>
            <tr>
                <td><?= $this->Html->link($user->username, ['action' => 'view', $user->id]) ?></td>
                <td><?= h($user->display_name) ?></td>
                <td><?= h($user->email) ?></td>
                <td><?= h($user->credits) ?></td>
                <td><?= h($user->lifetime_points) ?></td>
                <td><?= h($user->votes_count) ?></td>
                <td>
                    <?= $this->Html->Link('<span class="glyphicon glyphicon-pencil"></span>', ['action' => 'edit', $user->id], ['escape' => false]) ?>
                    <?= $this->Form->postLink('<span class="glyphicon glyphicon-trash"></span>', ['action' => 'delete', $user->id], ['escape' => false, 'confirm' => __('Are you sure you want to delete {0}?', $user->username)]) ?>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<ul class="pagination">
    <?= $this->Paginator->prev('&laquo;',  array('escape' => false, 'tag' => 'li'), null, array('escape' => false, 'tag' => 'li', 'disabledTag' => 'a', 'class' => 'disabled')) ?>
    <?= $this->Paginator->numbers(array('currentClass' => 'active', 'currentTag' => 'a', 'tag' => 'li', 'separator' => '')) ?>
    <?= $this->Paginator->next('&raquo;', array('escape' => false, 'tag' => 'li'), null, array('escape' => false, 'tag' => 'li', 'disabledTag' => 'a', 'class' => 'disabled')) ?>
</ul>
<p><?= $this->Paginator->counter('Page {{page}} of {{pages}}, showing {{current}} records out of {{count}} total, starting on record {{start}}, ending on {{end}}') ?></p>
