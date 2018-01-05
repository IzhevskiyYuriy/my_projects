<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Block Entity
 *
 * @property int $id
 * @property int $site_id
 * @property string $name
 * @property int $template_id
 * @property int $amount_x
 * @property int $amount_y
 * @property int $width
 * @property string $width_units
 * @property string $no_elemens_code
 *
 * @property \App\Model\Entity\Site $site
 * @property \App\Model\Entity\BlocksTemplate $blocks_template
 * @property \App\Model\Entity\BlocksStyle[] $blocks_styles
 * @property \App\Model\Entity\BlocksTeasersExcluded[] $blocks_teasers_excludeds
 * @property \App\Model\Entity\TeasersView[] $teasers_views
 */
class Block extends Entity
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

    public function getWidthUnits()
    {
        return [
            '%' => '%',
            'px' => 'px'
        ];
    }

    public function getAllowedTeasersXNumbers()
    {
        return array_combine(range(1, 20), range(1, 20));
    }

    /** Возвращает список доступных количеств строк тизеров. Пока(тестово) возвращает то же кол-во, что и кол-во столбцов
     *
     */
    public function getAllowedTeasersYNumbers()
    {
        return $this->getAllowedTeasersXNumbers();
    }

    public function calcStatProfit()
    {
        $profit = 0.00;

        if (empty($this->teasers_views)) return $profit;

        foreach ($this->teasers_views as $teasersView) {
            $profit += $teasersView->opened * $teasersView->teaser->price;
        }

        return $profit;
    }
}
