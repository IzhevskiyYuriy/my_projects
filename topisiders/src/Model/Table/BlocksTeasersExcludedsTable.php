<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * BlocksTeasersExcludeds Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Blocks
 * @property \Cake\ORM\Association\BelongsTo $Teasers
 *
 * @method \App\Model\Entity\BlocksTeasersExcluded get($primaryKey, $options = [])
 * @method \App\Model\Entity\BlocksTeasersExcluded newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\BlocksTeasersExcluded[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\BlocksTeasersExcluded|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\BlocksTeasersExcluded patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\BlocksTeasersExcluded[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\BlocksTeasersExcluded findOrCreate($search, callable $callback = null, $options = [])
 */
class BlocksTeasersExcludedsTable extends Table
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

        $this->setTable('blocks_teasers_excludeds');
        $this->setDisplayField('block_id');
        $this->setPrimaryKey(['block_id', 'teaser_id']);

        $this->belongsTo('Blocks', [
            'foreignKey' => 'block_id',
            'joinType' => 'INNER'
        ]);
//        $this->belongsTo('Teasers', [
//            'foreignKey' => 'teaser_id',
//            'joinType' => 'INNER'
//        ]);
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
        $rules->add($rules->existsIn(['block_id'], 'Blocks'));
       // $rules->add($rules->existsIn(['teaser_id'], 'Teasers'));

        return $rules;
    }
}
