<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\UserChangeLogsTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\UserChangeLogsTable Test Case
 */
class UserChangeLogsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\UserChangeLogsTable
     */
    protected $UserChangeLogs;

    /**
     * Fixtures
     *
     * @var array<string>
     */
    protected $fixtures = [
        'app.UserChangeLogs',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('UserChangeLogs') ? [] : ['className' => UserChangeLogsTable::class];
        $this->UserChangeLogs = $this->getTableLocator()->get('UserChangeLogs', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->UserChangeLogs);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\UserChangeLogsTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
