<h2><?php echo __('Edit User'); ?></h2>
<div class="panel panel-default">
    <div class="panel-body">
        <?= $this->Form->create($user, array('class' => 'form-horizontal')) ?>
        <div class="form-group">
            <?php echo $this->Form->label('username', 'Username', array('class' => 'col-lg-2 control-label')); ?>
            <div class="col-lg-4">
                <?php echo $this->Form->input('username', array('label' => false, 'class' => 'form-control')); ?>
            </div>
        </div>
        <div class="form-group">
            <?php echo $this->Form->label('password', 'Password', array('class' => 'col-lg-2 control-label')); ?>
            <div class="col-lg-4">
                <?php echo $this->Form->input('password', array('label' => false, 'class' => 'form-control')); ?>
            </div>
        </div>
        <div class="form-group">
            <?php echo $this->Form->label('display_name', 'Display Name', array('class' => 'col-lg-2 control-label')); ?>
            <div class="col-lg-4">
                <?php echo $this->Form->input('display_name', array('label' => false, 'class' => 'form-control')); ?>
            </div>
        </div>
        <div class="form-group">
            <?php echo $this->Form->label('email', 'E-Mail', array('class' => 'col-lg-2 control-label')); ?>
            <div class="col-lg-4">
                <?php echo $this->Form->input('email', array('label' => false, 'class' => 'form-control')); ?>
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <div class="checkbox">
                    <label>
                        <?php echo $this->Form->checkbox('admin', array('label' => false)); ?> Admin
                    </label>
                </div>
            </div>
        </div>
        <div class="form-group">
            <?php echo $this->Form->label('credits', 'Credits', array('class' => 'col-lg-2 control-label')); ?>
            <div class="col-lg-4">
                <?php echo $this->Form->input('credits', array('label' => false, 'class' => 'form-control')); ?>
            </div>
        </div>
        <div class="form-group">
            <?php echo $this->Form->label('lifetime_points', 'Lifetime Points', array('class' => 'col-lg-2 control-label')); ?>
            <div class="col-lg-4">
                <?php echo $this->Form->input('lifetime_points', array('label' => false, 'class' => 'form-control')); ?>
            </div>
        </div>
        <div class="form-group">
            <div class="col-lg-offset-2 col-lg-10">
                <?php
                echo $this->Form->button(__('Submit'), array('type'=>'submit','class'=>'btn btn-primary'));
                echo $this->Html->link(__('Cancel'), array('action' => 'index'), array('class' => 'btn btn-link'));
                echo $this->Form->end();
                ?>
            </div>
        </div>
    </div>
</div><!-- /.panel -->
