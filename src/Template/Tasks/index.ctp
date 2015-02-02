<table class="table table-striped table-bordered table-condensed">
    <thead>
        <th style="width: 1%"><?= $this->Paginator->sort('total_points', 'Points');?></th>
        <th style="width: 60%"><?= $this->Paginator->sort('name', 'Task');?></th>
        <th style="width: 20%">Tags</th>
        <th style="width: 1%"><?= $this->Paginator->sort('comment_count', 'Comments');?></th>
    </thead>
    <tbody>
        <?php foreach ($tasks as $task): ?>
        <tr>
            <td><?= $task->total_points ?></td>
            <td><?= $this->Html->link($task->name, ['action' => 'view', $task->id, $this->Text->slug($task->name)]) ?></td>
            <td>
                <?php
                $tag_links = [];
                foreach ($task->tags as $tag) {
                    $tag_links[] = $this->Html->link($tag->name, ['action' => 'tagged', $tag->name]);
                }
                echo count($tag_links) ? implode(', ', $tag_links) : 'none';
                ?>
            </td>
            <td><?= $task->comment_count ?></td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<?php if ($this->Paginator->hasPage('Tasks', 2)): ?>
<div class="paginator">
    <ul class="pagination">
        <?php
        echo $this->Paginator->prev('&laquo;', ['escape' => false]);
        echo $this->Paginator->numbers();
        echo $this->Paginator->next('&raquo;', ['escape' => false]);
        ?>
    </ul>
    <p><?= $this->Paginator->counter('Page {{page}} of {{pages}}') ?></p>
</div><!--/.paginator -->
<?php endif; ?>
