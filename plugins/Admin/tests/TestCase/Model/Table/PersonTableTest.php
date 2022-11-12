<?php
declare(strict_types=1);

namespace Admin\Test\TestCase\Model\Table;

use Admin\Model\Table\PersonTable;
use Cake\TestSuite\TestCase;

/**
 * Admin\Model\Table\PersonTable Test Case
 */
class PersonTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \Admin\Model\Table\PersonTable
     */
    protected $Person;

    /**
     * Fixtures
     *
     * @var array<string>
     */
    protected $fixtures = [
        'plugin.Admin.Person',
        'plugin.Admin.Boards',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('Person') ? [] : ['className' => PersonTable::class];
        $this->Person = $this->getTableLocator()->get('Person', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->Person);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \Admin\Model\Table\PersonTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
