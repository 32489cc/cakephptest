<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * UserChangeLogs Model
 *
 * @method \App\Model\Entity\UserChangeLog newEmptyEntity()
 * @method \App\Model\Entity\UserChangeLog newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\UserChangeLog[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\UserChangeLog get($primaryKey, $options = [])
 * @method \App\Model\Entity\UserChangeLog findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\UserChangeLog patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\UserChangeLog[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\UserChangeLog|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\UserChangeLog saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\UserChangeLog[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\UserChangeLog[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\UserChangeLog[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\UserChangeLog[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class UserChangeLogsTable extends Table
{
    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config): void
    {
        parent::initialize($config);

        $this->setTable('user_change_logs');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator): Validator
    {
        $validator
            ->scalar('action')
            ->maxLength('action', 45)
            ->requirePresence('action', 'create')
            ->notEmptyString('action');

        $validator
            ->scalar('before_value')
            ->requirePresence('before_value', 'create')
            ->notEmptyString('before_value');

        $validator
            ->scalar('after_value')
            ->requirePresence('after_value', 'create')
            ->notEmptyString('after_value');

        $validator
            ->scalar('modified_user')
            ->maxLength('modified_user', 45)
            ->allowEmptyString('modified_user');

        $validator
            ->scalar('created_user')
            ->maxLength('created_user', 45)
            ->allowEmptyString('created_user');

        return $validator;
    }
}
