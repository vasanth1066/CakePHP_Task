<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * AuthorsFixture
 */
class AuthorsFixture extends TestFixture
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
                'first_name' => 'Lorem ipsum dolor sit amet',
                'email' => 'Lorem ipsum dolor sit amet',
                'created_at' => '2024-05-31 10:17:41',
                'updated_at' => '2024-05-31 10:17:41',
            ],
        ];
        parent::init();
    }
}
