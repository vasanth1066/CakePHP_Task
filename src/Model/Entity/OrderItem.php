<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * OrderItem Entity
 *
 * @property int $id
 * @property int|null $order_id
 * @property int|null $book_id
 * @property int|null $quantity
 * @property string|null $price
 *
 * @property \App\Model\Entity\Order $order
 * @property \App\Model\Entity\Book $book
 */
class OrderItem extends Entity
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
        'order_id' => true,
        'book_id' => true,
        'quantity' => true,
        'price' => true,
        'order' => true,
        'book' => true,
    ];
}
