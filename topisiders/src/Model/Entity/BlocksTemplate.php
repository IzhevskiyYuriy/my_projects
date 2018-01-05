<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * BlocksTemplate Entity
 *
 * @property int $id
 * @property int $amount_x
 * @property int $amount_y
 * @property int $size_x
 * @property int $size_y
 */
class BlocksTemplate extends Entity
{

    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array
     */
    protected $_accessible = [
        '*' => true,
        'id' => false
    ];

    protected function _getTemplate()
    {
        return "{$this->_properties['amount_x']}x{$this->_properties['amount_y']}, {$this->_properties['size_x']} на {$this->_properties['size_y']}";
    }
}
