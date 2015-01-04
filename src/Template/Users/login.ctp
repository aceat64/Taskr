<?= $this->Form->create('User', ['class' => 'form-signin']) ?>
    <h2 class="form-signin-heading">Please sign in</h2>
    <label for="inputUsername" class="sr-only">Username</label>
    <?= $this->Form->input('username', ['label' => false, 'id' => 'inputUsername', 'class' => 'form-control', 'placeholder' => 'Username', 'required' => true, 'autofocus' => true]) ?>
    <label for="inputPassword" class="sr-only">Password</label>
    <?= $this->Form->input('password', ['label' => false, 'id' => 'inputUsername', 'class' => 'form-control', 'placeholder' => 'Password', 'required' => true, 'autofocus' => true]) ?>
    <div class="checkbox">
        <label>
            <?php echo $this->Form->checkbox('remember-me', array('label' => false)); ?> Remember me
        </label>
    </div>
    <?php
    echo $this->Form->button(__('Submit'), array('type'=>'submit','class'=>'btn btn-primary'));
    echo $this->Html->link(__('Register'), array('action' => 'register'), array('class' => 'btn btn-link'));
    echo $this->Form->end();
    ?>
</form>
