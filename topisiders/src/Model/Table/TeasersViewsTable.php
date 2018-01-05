<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * TeasersViews Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Blocks
 * @property \Cake\ORM\Association\BelongsTo $Teasers
 *
 * @method \App\Model\Entity\TeasersView get($primaryKey, $options = [])
 * @method \App\Model\Entity\TeasersView newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\TeasersView[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\TeasersView|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\TeasersView patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\TeasersView[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\TeasersView findOrCreate($search, callable $callback = null, $options = [])
 */
class TeasersViewsTable extends Table
{

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     *
     * @return void
     */
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->setTable('teasers_views');
        $this->setDisplayField('block_id');
        $this->setPrimaryKey(['block_id', 'teaser_id', 'event_hour']);

        $this->belongsTo('Blocks', ['foreignKey' => 'block_id', 'joinType' => 'INNER']);
        $this->belongsTo('Teasers', ['foreignKey' => 'teaser_id', 'joinType' => 'INNER']);
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     *
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator)
    {
        $validator->integer('event_hour')->allowEmpty('event_hour', 'create');

        $validator->integer('viewed')->requirePresence('viewed', 'create')->notEmpty('viewed');

        $validator->integer('opened')->requirePresence('opened', 'create')->notEmpty('opened');

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     *
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules)
    {
        $rules->add($rules->existsIn(['block_id'], 'Blocks'));
        $rules->add($rules->existsIn(['teaser_id'], 'Teasers'));

        return $rules;
    }

    public function registerOpen($params)
    {
        // lt_id - is 'local teaser id'. teaser_id - id of teaser from burnsmi.com
        if (empty($params['b_id']) || empty($params['lt_id'])) {
            // TODO: throw valid exception
            throw new \Exception('Не указан параметр block_id или teaser_id');
        }

        $seconds = time();
        $roundedSeconds = $seconds - ($seconds % 3600);

        $this->_register([
            [
                'block_id' => intval($params['b_id']),
                'teaser_id' => intval($params['lt_id']),
                'event_hour' => $roundedSeconds,
                'opened' => 1
            ]
        ], 'opened');

    }

    public function registerViews($views)
    {
        $this->_register(static::_generateRows($views), 'viewed');
    }

    private function _register($values, $fieldName)
    {
        $query = $this->query();
        $query->insert(['block_id', 'teaser_id', 'event_hour', $fieldName])
            ->clause('values')
            ->values($values);

        $query
            ->epilog('ON DUPLICATE KEY UPDATE `'.$fieldName.'`= `'.$fieldName.'` + 1')
            ->execute();
    }

    private static function _generateRows($dataList)
    {
        $rows = [];
        $seconds = time();

        // round to hours (each 3 hour)
        $roundedSeconds = $seconds - ($seconds % 3600);

        // min values of opened or viewed
        $minVal = 1;

        foreach ($dataList as $dataRow) {
            $rows[] = [intval($dataRow['block_id']), intval($dataRow['teaser_id']), $roundedSeconds, $minVal];
        }

        return $rows;
    }
}
