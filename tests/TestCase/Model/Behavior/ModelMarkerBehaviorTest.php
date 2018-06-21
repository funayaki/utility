<?php
namespace Utility\Test\TestCase\Model\Behavior;

use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * Utility\Model\Behavior\ModelMarkerBehavior Test Case
 * @property  \Utility\Test\TestApp\Model\Table\AssetsTable Assets
 */
class ModelMarkerBehaviorTest extends TestCase
{

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'plugin.utility.assets',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();

        TableRegistry::clear();
        $this->Assets = TableRegistry::get('Assets', [
            'className' => 'Utility\Test\TestApp\Model\Table\AssetsTable'
        ]);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Assets);

        parent::tearDown();
    }

    public function testModelMarking()
    {
        $asset = $this->Assets->newEntity();

        $asset->file_name = 'logo.png';
        $asset->dir = 'webroot/';
        $asset->file_type = 'image/png';

        $success = (bool)$this->Assets->save($asset);

        $this->assertTrue($success);
        $this->assertEquals('Assets', $asset->model);
    }
}
