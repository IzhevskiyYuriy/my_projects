<?php
namespace App\Model\Table;


use Cake\ORM\Behavior;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;


/**
 * Teasers Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Posts
 * @property \Cake\ORM\Association\BelongsTo $Teasers
 * @property \Cake\ORM\Association\HasMany $BlocksTeasersExcludeds
 * @property \Cake\ORM\Association\HasMany $Teaser
 * @property \Cake\ORM\Association\HasMany $TeasersViews
 * @property \Cake\ORM\Association\BelongsToMany $Categories
 *
 * @method \App\Model\Entity\Teaser get($primaryKey, $options = [])
 * @method \App\Model\Entity\Teaser newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Teaser[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Teaser|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Teaser patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Teaser[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Teaser findOrCreate($search, callable $callback = null, $options = [])
 */
class TeasersTable extends Table
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

        $this->setTable('teasers');
        $this->setDisplayField('title');
        $this->setPrimaryKey('id');

        /*$this->belongsTo('Posts', [
            'foreignKey' => 'post_id',
            'joinType' => 'INNER'
        ]);*/
       /*  $this->belongsTo('Teasers', [
            'foreignKey' => 'teaser_id'
            'joinType' => 'INNER'
        ]);*/
        $this->hasMany('BlocksTeasersExcludeds', [
            'foreignKey' => 'teaser_id'
        ]);
        $this->hasMany('Teasers', [
            'foreignKey' => 'teaser_id'
        ]);

        $this->hasOne('Teaser', [
            'foreignKey' => 'teaser_id'
        ])
            ->setBindingKey('teaser_id');

        $this->hasMany('TeasersViews', [
            'foreignKey' => 'teaser_id'
        ]);
        $this->belongsToMany('Categories', [
            'foreignKey' => 'teaser_id',
            'targetForeignKey' => 'category_id',
            'joinTable' => 'categories_teasers'
        ]);
         $this->setEntityClass('App\Model\Entity\Teaser');

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
            ->requirePresence('img', 'create')
            ->notEmpty('img')
            ->allowEmpty('img', 'update');

         $validator
            ->requirePresence('link', 'create')
            ->notEmpty('link');

        $validator
            ->allowEmpty('text');

        $validator
            ->requirePresence('title', 'create')
            ->notEmpty('title');

        $validator
            ->decimal('price')
            ->requirePresence('price', 'create')
            ->notEmpty('price');

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
       $rules->add($rules->existsIn(['teaser_id'], 'Teaser'));

        return $rules;
    }




}
