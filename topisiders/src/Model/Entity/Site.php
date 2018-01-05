<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Site Entity
 *
 * @property int $id
 * @property int $category_id
 * @property string $domain
 * @property int $account_id
 * @property \Cake\I18n\Time $created
 * @property \Cake\I18n\Time $modified
 * @property int $status
 *
 * @property \App\Model\Entity\Category $category
 * @property \App\Model\Entity\Account $account
 * @property \App\Model\Entity\Block[] $blocks
 */
class Site extends Entity
{
    const STATUS_NOT_ACTIVE = 0;

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

    public function _getStatusName()
    {
        if ($this->status === static::STATUS_NOT_ACTIVE) return 'На модерации';

        return 'Не указано';
    }

    public function isWithoutStat()
    {
        return empty($this->blocks) || empty($this->blocks[0]->teasers_views);
    }

    public function calcStatProfit()
    {
        $profit = 0.00;

        if (empty($this->blocks)) return $profit;

        foreach ($this->blocks as $block) {
            $profit += $block->calcStatProfit();
        }

        return $profit;
    }
}
