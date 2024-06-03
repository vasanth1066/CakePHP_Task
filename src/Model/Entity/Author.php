<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Author Entity
 *
 * @property int $id
 * @property string $first_name
 * @property string|null $email
 * @property \Cake\I18n\DateTime|null $created_at
 * @property \Cake\I18n\DateTime|null $updated_at
 *
 * @property \App\Model\Entity\Book[] $books
 */
class Author extends Entity
{
    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array<string, bool>
     */
    protected array $_accessible = [
        'first_name' => true,
        'email' => true,
        'created_at' => true,
        'updated_at' => true,
        'books' => true,
        'publisher' => true,
        'publication_date' => true,
        'publisher_id' => true,
    ];
}
