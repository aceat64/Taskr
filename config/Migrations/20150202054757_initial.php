<?php
use Phinx\Migration\AbstractMigration;

class Initial extends AbstractMigration {

    /**
     * Change Method.
     *
     * More information on this method is available here:
     * http://docs.phinx.org/en/latest/migrations.html#the-change-method
     *
     * @return void
     */
    public function change()
    {

		$table = $this->table('comments');
    $table
      ->addColumn('id', 'integer', [
        'limit' => '10', 
        'unsigned' => '1', 
        'null' => '', 
        'default' => '', 
      ])
      ->addColumn('created', 'datetime', [
        'limit' => '', 
        'null' => '', 
        'default' => '', 
      ])
      ->addColumn('task_id', 'integer', [
        'limit' => '10', 
        'unsigned' => '1', 
        'null' => '', 
        'default' => '', 
      ])
      ->addColumn('user_id', 'integer', [
        'limit' => '10', 
        'unsigned' => '1', 
        'null' => '', 
        'default' => '', 
      ])
      ->addColumn('text', 'text', [
        'limit' => '', 
        'null' => '', 
        'default' => '', 
      ])
      ->save();

		$table = $this->table('completions');
    $table
      ->addColumn('id', 'integer', [
        'limit' => '10', 
        'unsigned' => '1', 
        'null' => '', 
        'default' => '', 
      ])
      ->addColumn('created', 'datetime', [
        'limit' => '', 
        'null' => '', 
        'default' => '', 
      ])
      ->addColumn('task_id', 'integer', [
        'limit' => '10', 
        'unsigned' => '1', 
        'null' => '', 
        'default' => '', 
      ])
      ->addColumn('user_id', 'integer', [
        'limit' => '10', 
        'unsigned' => '1', 
        'null' => '', 
        'default' => '', 
      ])
      ->save();

		$table = $this->table('flags');
    $table
      ->addColumn('id', 'integer', [
        'limit' => '10', 
        'unsigned' => '1', 
        'null' => '', 
        'default' => '', 
      ])
      ->addColumn('created', 'datetime', [
        'limit' => '', 
        'null' => '', 
        'default' => '', 
      ])
      ->addColumn('modified', 'datetime', [
        'limit' => '', 
        'null' => '', 
        'default' => '', 
      ])
      ->addColumn('status', 'integer', [
        'limit' => '3', 
        'unsigned' => '1', 
        'null' => '', 
        'default' => '', 
      ])
      ->addColumn('completion_id', 'integer', [
        'limit' => '10', 
        'unsigned' => '1', 
        'null' => '', 
        'default' => '', 
      ])
      ->addColumn('user_id', 'integer', [
        'limit' => '10', 
        'unsigned' => '1', 
        'null' => '', 
        'default' => '', 
      ])
      ->addColumn('description', 'text', [
        'limit' => '', 
        'null' => '', 
        'default' => '', 
      ])
      ->save();

		$table = $this->table('gifts');
    $table
      ->addColumn('id', 'integer', [
        'limit' => '10', 
        'unsigned' => '1', 
        'null' => '', 
        'default' => '', 
      ])
      ->addColumn('created', 'datetime', [
        'limit' => '', 
        'null' => '', 
        'default' => '', 
      ])
      ->addColumn('task_id', 'integer', [
        'limit' => '10', 
        'unsigned' => '1', 
        'null' => '', 
        'default' => '', 
      ])
      ->addColumn('user_id', 'integer', [
        'limit' => '10', 
        'unsigned' => '1', 
        'null' => '', 
        'default' => '', 
      ])
      ->addColumn('credits', 'decimal', [
        'limit' => '10', 
        'unsigned' => '1', 
        'null' => '', 
        'default' => '', 
      ])
      ->addColumn('points', 'integer', [
        'limit' => '10', 
        'unsigned' => '1', 
        'null' => '', 
        'default' => '', 
      ])
      ->save();

		$table = $this->table('tags');
    $table
      ->addColumn('id', 'integer', [
        'limit' => '10', 
        'unsigned' => '1', 
        'null' => '', 
        'default' => '', 
      ])
      ->addColumn('name', 'string', [
        'limit' => '32', 
        'null' => '', 
        'default' => '', 
      ])
      ->addColumn('task_count', 'integer', [
        'limit' => '10', 
        'unsigned' => '1', 
        'null' => '', 
        'default' => '', 
      ])
      ->save();

		$table = $this->table('tasks');
    $table
      ->addColumn('id', 'integer', [
        'limit' => '10', 
        'unsigned' => '1', 
        'null' => '', 
        'default' => '', 
      ])
      ->addColumn('created', 'datetime', [
        'limit' => '', 
        'null' => '', 
        'default' => '', 
      ])
      ->addColumn('modified', 'datetime', [
        'limit' => '', 
        'null' => '', 
        'default' => '', 
      ])
      ->addColumn('status', 'text', [
        'limit' => '', 
        'null' => '', 
        'default' => 'open', 
      ])
      ->addColumn('user_id', 'integer', [
        'limit' => '10', 
        'unsigned' => '1', 
        'null' => '', 
        'default' => '', 
      ])
      ->addColumn('name', 'string', [
        'limit' => '64', 
        'null' => '', 
        'default' => '', 
      ])
      ->addColumn('description', 'text', [
        'limit' => '', 
        'null' => '', 
        'default' => '', 
      ])
      ->addColumn('total_points', 'integer', [
        'limit' => '10', 
        'unsigned' => '1', 
        'null' => '', 
        'default' => '', 
      ])
      ->addColumn('base_points', 'integer', [
        'limit' => '10', 
        'unsigned' => '1', 
        'null' => '', 
        'default' => '1', 
      ])
      ->addColumn('gift_points', 'integer', [
        'limit' => '10', 
        'unsigned' => '1', 
        'null' => '', 
        'default' => '0', 
      ])
      ->addColumn('vote_count', 'integer', [
        'limit' => '10', 
        'unsigned' => '1', 
        'null' => '', 
        'default' => '', 
      ])
      ->addColumn('completion_count', 'integer', [
        'limit' => '10', 
        'unsigned' => '1', 
        'null' => '', 
        'default' => '', 
      ])
      ->addColumn('comment_count', 'integer', [
        'limit' => '10', 
        'unsigned' => '1', 
        'null' => '', 
        'default' => '', 
      ])
      ->save();

		$table = $this->table('tasks_tags');
    $table
      ->addColumn('id', 'integer', [
        'limit' => '10', 
        'unsigned' => '1', 
        'null' => '', 
        'default' => '', 
      ])
      ->addColumn('task_id', 'integer', [
        'limit' => '10', 
        'unsigned' => '1', 
        'null' => '', 
        'default' => '', 
      ])
      ->addColumn('tag_id', 'integer', [
        'limit' => '10', 
        'unsigned' => '1', 
        'null' => '', 
        'default' => '', 
      ])
      ->save();

		$table = $this->table('users');
    $table
      ->addColumn('id', 'integer', [
        'limit' => '10', 
        'unsigned' => '1', 
        'null' => '', 
        'default' => '', 
      ])
      ->addColumn('created', 'datetime', [
        'limit' => '', 
        'null' => '', 
        'default' => '', 
      ])
      ->addColumn('modified', 'datetime', [
        'limit' => '', 
        'null' => '', 
        'default' => '', 
      ])
      ->addColumn('admin', 'boolean', [
        'limit' => '', 
        'null' => '', 
        'default' => '0', 
      ])
      ->addColumn('username', 'string', [
        'limit' => '32', 
        'null' => '', 
        'default' => '', 
      ])
      ->addColumn('password', 'string', [
        'limit' => '255', 
        'null' => '', 
        'default' => '', 
      ])
      ->addColumn('display_name', 'string', [
        'limit' => '255', 
        'null' => '', 
        'default' => '', 
      ])
      ->addColumn('email', 'string', [
        'limit' => '255', 
        'null' => '', 
        'default' => '', 
      ])
      ->addColumn('credits', 'decimal', [
        'limit' => '10', 
        'unsigned' => '1', 
        'null' => '', 
        'default' => '0.00', 
      ])
      ->addColumn('lifetime_points', 'integer', [
        'limit' => '11', 
        'unsigned' => '', 
        'null' => '', 
        'default' => '0', 
      ])
      ->addColumn('vote_count', 'integer', [
        'limit' => '11', 
        'unsigned' => '', 
        'null' => '', 
        'default' => '0', 
      ])
      ->save();

		$table = $this->table('votes');
    $table
      ->addColumn('id', 'integer', [
        'limit' => '10', 
        'unsigned' => '1', 
        'null' => '', 
        'default' => '', 
      ])
      ->addColumn('created', 'datetime', [
        'limit' => '', 
        'null' => '', 
        'default' => '', 
      ])
      ->addColumn('task_id', 'integer', [
        'limit' => '10', 
        'unsigned' => '1', 
        'null' => '', 
        'default' => '', 
      ])
      ->addColumn('user_id', 'integer', [
        'limit' => '10', 
        'unsigned' => '1', 
        'null' => '', 
        'default' => '', 
      ])
      ->save();
    }

    /**
     * Migrate Up.
     *
     * @return void
     */
    public function up()
    {
    }

    /**
     * Migrate Down.
     *
     * @return void
     */
    public function down()
    {
    }

}
