<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * TeasersView Entity
 *
 * @property int $block_id
 * @property int $teaser_id
 * @property int $event_hour
 * @property int $viewed
 * @property int $opened
 *
 * @property \App\Model\Entity\Block $block
 * @property \App\Model\Entity\Teaser $teaser
 */
class TeasersView extends Entity
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
        'teaser_id' => false,
        'event_hour' => false
    ];
}
