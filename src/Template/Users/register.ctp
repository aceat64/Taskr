<h2><?php echo __('Create Account'); ?></h2>
<div class="col-sm-8">
    <div class="panel panel-default">
        <div class="panel-body">
            <?php
            echo $this->Form->create($user, ['horizontal' => true]);
            echo $this->Form->input('username');
            echo $this->Form->input('password');
            echo $this->Form->input('confirm_password', ['type' => 'password']);
            echo $this->Form->input('display_name');
            echo $this->Form->input('email');
            ?>
            <div class="form-group">
                <div class="col-lg-offset-2 col-lg-10">
                    <?php
                    echo $this->Form->button('Submit', ['type' => 'submit', 'class' => 'btn-primary']);
                    echo $this->Html->link('Cancel', ['controller' => 'tasks', 'action' => 'index'], ['class' => 'btn btn-link']);
                    ?>
                </div>
            </div>
        </div>
    </div><!-- /.panel -->
</div>
