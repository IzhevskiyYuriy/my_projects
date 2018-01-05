<?php
namespace App\Model\Table;

use Cake\Database\Schema\TableSchema;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * BlocksStyles Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Blocks
 *
 * @method \App\Model\Entity\BlocksStyle get($primaryKey, $options = [])
 * @method \App\Model\Entity\BlocksStyle newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\BlocksStyle[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\BlocksStyle|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\BlocksStyle patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\BlocksStyle[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\BlocksStyle findOrCreate($search, callable $callback = null, $options = [])
 */
class BlocksStylesTable extends Table
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

        $this->setTable('blocks_styles');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('Blocks', [
            'foreignKey' => 'block_id',
            'joinType' => 'INNER',
            'propertyName' => 'blockItem'
        ]);
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator)
    {
        $validator
            ->integer('id')
            ->allowEmpty('id', 'create');

        $validator
            ->requirePresence('block', 'create')
            ->notEmpty('block');

        $validator
            ->requirePresence('link', 'create')
            ->notEmpty('link');

        $validator
            ->requirePresence('teaser', 'create')
            ->notEmpty('teaser');

        return $validator;
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

        return $rules;
    }

    protected function _initializeSchema(TableSchema $schema)
    {
        $schema->columnType('link', 'json');
        $schema->columnType('block', 'json');
        $schema->columnType('teaser', 'json');

        return $schema;
    }
}
