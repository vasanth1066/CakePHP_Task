<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query\SelectQuery;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Users Model
 *
 * @property \App\Model\Table\ArticlesTable&\Cake\ORM\Association\HasMany $Articles
 *
 * @method \App\Model\Entity\User newEmptyEntity()
 * @method \App\Model\Entity\User newEntity(array $data, array $options = [])
 * @method array<\App\Model\Entity\User> newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\User get(mixed $primaryKey, array|string $finder = 'all', \Psr\SimpleCache\CacheInterface|string|null $cache = null, \Closure|string|null $cacheKey = null, mixed ...$args)
 * @method \App\Model\Entity\User findOrCreate($search, ?callable $callback = null, array $options = [])
 * @method \App\Model\Entity\User patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method array<\App\Model\Entity\User> patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\User|false save(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method \App\Model\Entity\User saveOrFail(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method iterable<\App\Model\Entity\User>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\User>|false saveMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\User>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\User> saveManyOrFail(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\User>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\User>|false deleteMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\User>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\User> deleteManyOrFail(iterable $entities, array $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class TestsTable extends Table
{
    /**
     * Initialize method
     *
     * @param array<string, mixed> $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config): void
    {
        parent::initialize($config);

       
        $this->setTable('tests');
        
        // // //  Set the primary key
        $this->setPrimaryKey('id');
        
        // // // Set the display field
        $this->setDisplayField('id');
        
       
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
            ->email('email')//single rule per field
            ->requirePresence('email', 'create')
            ->notEmptyString('email', 'This field cannot be empty')
            ->add('email', 'validFormat', [
                'rule' => ['custom', '/@gmail\.com$/'],
                'message' => 'Email must end with "@gmail.com"'
            ]);

        $validator
            ->notEmptyString('password', 'Password cannot be empty')//mutilple rule per field
            ->add('password', 'length', [
                'rule' => ['minLength', 8],
                'message' => 'Password must be at least 8 characters long'
            ])
            ->add('password', 'upperCase', [
                'rule' => function ($value) {
                    return (bool)preg_match('/[A-Z]/', $value);
                },
                'message' => 'Password must contain at least one uppercase letter'
            ])
            ->add('password', 'lowerCase', [
                'rule' => function ($value) {
                    return (bool) preg_match('/[a-z]/', $value);
                },
                'message' => 'Password must contain at least one lowercase letter'
            ])
            ->add('password', 'digit', [
                'rule' => function ($value) {
                    return (bool)preg_match('/\d/', $value);
                },
                'message' => 'Password must contain at least one digit'
            ]);

        $validator
            ->scalar('first_name')
            ->maxLength('first_name', 100)
            ->requirePresence('first_name', 'create')
            ->notEmptyString('first_name');

        $validator
            ->notEmptyString('last_name','Last Name Must');

        $validator
            ->scalar('address')//custom rule for validation
            ->requirePresence('address', 'create')
            ->notEmptyString('address')
            ->add('address', 'customValidation', [
                'rule' => [$this, 'validateAddress'],
                'message' => 'Invalid address format & length should be more than 10 characters'
            ]);

        $validator
            ->date('birthday')
            ->allowEmptyDate('birthday');

        $validator
            ->notEmptyArray('user_type', 'Please select at least one user type');

        $validator
            ->requirePresence('terms', 'create', 'Please accept the terms and conditions');

        return $validator;
    }

    public function validateAddress($value, $context)
    {
        if (strlen($value) < 10) {
            return false; 
        }
        return true; 
    }

}
