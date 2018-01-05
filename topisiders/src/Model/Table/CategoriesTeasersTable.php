<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * CategoriesTeasers Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Categories
 * @property \Cake\ORM\Association\BelongsTo $Teasers
 *
 * @method \App\Model\Entity\CategoriesTeaser get($primaryKey, $options = [])
 * @method \App\Model\Entity\CategoriesTeaser newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\CategoriesTeaser[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\CategoriesTeaser|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\CategoriesTeaser patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\CategoriesTeaser[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\CategoriesTeaser findOrCreate($search, callable $callback = null, $options = [])
 */
class CategoriesTeasersTable extends Table
{

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->setTable('categories_teasers');
        $this->setDisplayField('category_id');
        $this->setPrimaryKey(['category_id', 'teaser_id']);

        $this->belongsTo('Categories', [
            'foreignKey' => 'category_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Teasers', [
            'foreignKey' => 'teaser_id',
            'joinType' => 'INNER'
        ]);
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules)
    {
        $rules->add($rules->existsIn(['category_id'], 'Categories'));
        $rules->add($rules->existsIn(['teaser_id'], 'Teasers'));

        return $rules;
    }
}
