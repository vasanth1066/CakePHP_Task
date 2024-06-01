<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * PublishersFixture
 */
class PublishersFixture extends TestFixture
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
                'name' => 'Lorem ipsum dolor sit amet',
                'website' => 'Lorem ipsum dolor sit amet',
                'created_at' => '2024-05-31 10:18:11',
                'updated_at' => '2024-05-31 10:18:11',
            ],
        ];
        parent::init();
    }
}
