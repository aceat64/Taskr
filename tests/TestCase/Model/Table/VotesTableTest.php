<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\VotesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\VotesTable Test Case
 */
class VotesTableTest extends TestCase
{

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'Votes' => 'app.votes',
        'Tasks' => 'app.tasks',
        'Users' => 'app.users',
        'Comments' => 'app.comments',
        'Completions' => 'app.completions',
        'Flags' => 'app.flags',
        'Gifts' => 'app.gifts',
        'Tags' => 'app.tags',
        'TasksTags' => 'app.tasks_tags'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Votes') ? [] : ['className' => 'App\Model\Table\VotesTable'];
        $this->Votes = TableRegistry::get('Votes', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Votes);

        parent::tearDown();
    }

    /**
     * Test initialize method
     *
     * @return void
     */
    public function testInitialize()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test validationDefault method
     *
     * @return void
     */
    public function testValidationDefault()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     */
    public function testBuildRules()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
