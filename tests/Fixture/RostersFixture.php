<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * RostersFixture
 */
class RostersFixture extends TestFixture
{
    /**
     * Init method
     *
     * @return void
     */
    public function init(): void
    {
        $this->records = [
            [
                'id' => 1,
                'users_id' => 1,
                'start_time' => '2022-11-12 12:17:46',
                'end_time' => '2022-11-12 12:17:46',
                'status' => 1,
                'reason' => 'Lorem ipsum dolor sit amet',
                'deleted' => '2022-11-12 12:17:46',
                'created' => 1668223066,
                'modified' => 1668223066,
                'created_user' => 'Lorem ipsum dolor sit amet',
                'modified_user' => 'Lorem ipsum dolor sit amet',
            ],
        ];
        parent::init();
    }
}
