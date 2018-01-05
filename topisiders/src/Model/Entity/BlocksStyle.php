<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * BlocksStyle Entity
 *
 * @property int $id
 * @property string $block
 * @property string $link
 * @property string $teaser
 * @property int $block_id
 *
 * @ property \App\Model\Entity\Block $block
 */
class BlocksStyle extends Entity
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
}
