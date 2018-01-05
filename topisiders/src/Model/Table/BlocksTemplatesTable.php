<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * BlocksTemplates Model
 *
 * @method \App\Model\Entity\BlocksTemplate get($primaryKey, $options = [])
 * @method \App\Model\Entity\BlocksTemplate newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\BlocksTemplate[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\BlocksTemplate|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\BlocksTemplate patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\BlocksTemplate[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\BlocksTemplate findOrCreate($search, callable $callback = null, $options = [])
 */
class BlocksTemplatesTable extends Table
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

        $this->setTable('blocks_templates');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');
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
            ->integer('amount_x')
            ->requirePresence('amount_x', 'create')
            ->notEmpty('amount_x');

        $validator
            ->integer('amount_y')
            ->requirePresence('amount_y', 'create')
            ->notEmpty('amount_y');

        $validator
            ->integer('size_x')
            ->requirePresence('size_x', 'create')
            ->notEmpty('size_x');

        $validator
            ->integer('size_y')
            ->requirePresence('size_y', 'create')
            ->notEmpty('size_y');

        return $validator;
    }
}
