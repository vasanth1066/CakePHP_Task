<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query\SelectQuery;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Publishers Model
 *
 * @property \App\Model\Table\BooksTable&\Cake\ORM\Association\HasMany $Books
 *
 * @method \App\Model\Entity\Publisher newEmptyEntity()
 * @method \App\Model\Entity\Publisher newEntity(array $data, array $options = [])
 * @method array<\App\Model\Entity\Publisher> newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Publisher get(mixed $primaryKey, array|string $finder = 'all', \Psr\SimpleCache\CacheInterface|string|null $cache = null, \Closure|string|null $cacheKey = null, mixed ...$args)
 * @method \App\Model\Entity\Publisher findOrCreate($search, ?callable $callback = null, array $options = [])
 * @method \App\Model\Entity\Publisher patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method array<\App\Model\Entity\Publisher> patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Publisher|false save(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method \App\Model\Entity\Publisher saveOrFail(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method iterable<\App\Model\Entity\Publisher>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Publisher>|false saveMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Publisher>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Publisher> saveManyOrFail(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Publisher>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Publisher>|false deleteMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Publisher>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Publisher> deleteManyOrFail(iterable $entities, array $options = [])
 */
class PublishersTable extends Table
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

        $this->setTable('publishers');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->hasMany('Books', [
            'foreignKey' => 'publisher_id',
        ]);
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
            ->scalar('name')
            ->maxLength('name', 255)
            ->requirePresence('name', 'create')
            ->notEmptyString('name');

        $validator
            ->scalar('website')
            ->maxLength('website', 255)
            ->allowEmptyString('website');

        $validator
            ->dateTime('created_at')
            ->allowEmptyDateTime('created_at');

        $validator
            ->dateTime('updated_at')
            ->allowEmptyDateTime('updated_at');

        return $validator;
    }
}
