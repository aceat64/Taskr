<h2><?php echo __('Create New Task'); ?></h2>
<div class="panel panel-default">
    <div class="panel-body">
        <?php
        echo $this->Form->create($task, ['horizontal' => true]);
        echo $this->Form->input('name', ['placeholder' => 'Short task description']);
        echo $this->Form->input('description', ['rows' => 10, 'placeholder' => 'Detailed task description']);
        echo $this->Form->input('tag_string', ['placeholder' => 'Comma separated tags']);
        ?>
        <div class="form-group">
            <div class="col-lg-offset-2 col-lg-10">
                <?php
                echo $this->Form->button('Submit', ['type' => 'submit', 'class' => 'btn-primary']);
                echo $this->Html->link('Cancel', ['action' => 'index'], ['class' => 'btn btn-link']);
                ?>
            </div>
        </div>
    </div>
</div><!-- /.panel -->
