<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Teaser Entity
 *
 * @property int $teaser_id
 * @property string $img
 * @property string $text
 * @property int $teaser_type
 * @property string $new_or_not
 * @property string $rubric
 * @property int $status
 * @property string $price
 * @property int $campaign_id
 * @property bool $new
 *
 * @property \App\Model\Entity\Teaser $teaser
 * @property \App\Model\Entity\Campaign $campaign
 */
class RemoteTeaser extends Entity
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
        'teaser_id' => false
    ];

    protected $_hidden = [
        'new_or_not', 'status', 'price', 'campaign_id', 'new', 'teaser_type', 'relink'
    ];



    const DOMAIN_PREFIX = 'topisiders.ru/';

    protected function _getImgPath()
    {
        return static::DOMAIN_PREFIX . $this->img;
    }


    
    protected function _getRowName()
    {
        return "{$this->_properties['teaser_id']}, {$this->_properties['text']}";
    }
}
