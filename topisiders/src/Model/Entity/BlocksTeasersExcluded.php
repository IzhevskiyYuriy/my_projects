<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * BlocksTeasersExcluded Entity
 *
 * @property int $block_id
 * @property int $teaser_id
 *
 * @property \App\Model\Entity\Block $block
 * @property \App\Model\Entity\Teaser $teaser
 */
class BlocksTeasersExcluded extends Entity
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
        'block_id' => false,
        'teaser_id' => false
    ];
}
