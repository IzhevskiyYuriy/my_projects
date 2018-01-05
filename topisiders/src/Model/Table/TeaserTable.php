<?php
namespace App\Model\Table;

use Cake\Event\Event;
use Cake\ORM\Behavior\TranslateBehavior;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use ArrayObject;


/**
 * Teaser Model
 *
 * @method \App\Model\Entity\Teaser get($primaryKey, $options = [])
 * @method \App\Model\Entity\Teaser newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Teaser[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Teaser|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Teaser patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Teaser[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Teaser findOrCreate($search, callable $callback = null, $options = [])
 */
class TeaserTable extends Table
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

        $this->setTable('teaser');
        $this->setDisplayField('teaser_id');
        $this->setPrimaryKey('teaser_id');
        $this->hasOne('Relink', [
            'foreignKey' => 'teaser_id',
        ]);
        $this->setEntityClass('App\Model\Entity\RemoteTeaser');

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
            ->requirePresence('img', 'create')
            ->notEmpty('img');

        $validator
            ->requirePresence('text', 'create')
            ->notEmpty('text');

        $validator
            ->integer('teaser_type')
            ->requirePresence('teaser_type', 'create')
            ->notEmpty('teaser_type');

        $validator
            ->requirePresence('new_or_not', 'create')
            ->notEmpty('new_or_not');

        $validator
            ->requirePresence('rubric', 'create')
            ->notEmpty('rubric');

        $validator
            ->integer('status')
            ->requirePresence('status', 'create')
            ->notEmpty('status');

        $validator
            ->requirePresence('price', 'create')
            ->notEmpty('price');

        $validator
            ->boolean('new')
            ->requirePresence('new', 'create')
            ->notEmpty('new');

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
        return $rules;
    }

    /**
     * Returns the database connection name to use by default.
     *
     * @return string
     */
    public static function defaultConnectionName()
    {
        return 'teaser';
    }
    
    //'teaser_type' => '3' -- это тип тизеров, для которых мы пишем функционнал
    public function beforeFind(Event $event, Query $query, ArrayObject $options, $primary)
    {
        $query->where(['teaser_type' => '3']);
    }


}
