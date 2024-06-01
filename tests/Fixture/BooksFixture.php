<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * BooksFixture
 */
class BooksFixture extends TestFixture
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
                'title' => 'Lorem ipsum dolor sit amet',
                'publication_date' => '2024-05-31',
                'publisher_id' => 1,
                'author_id' => 1,
                'created_at' => '2024-05-31 10:17:48',
                'updated_at' => '2024-05-31 10:17:48',
            ],
        ];
        parent::init();
    }
}
