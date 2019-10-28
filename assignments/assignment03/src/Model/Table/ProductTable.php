<?php

namespace App\Model\Table;

use App\Model\Entity\Product;
use Cake\Datasource\EntityInterface;
use Cake\ORM\Association\BelongsToMany;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Product Model
 *
 * @property CategoryTable&BelongsToMany $Category
 *
 * @method Product get($primaryKey, $options = [])
 * @method Product newEntity($data = null, array $options = [])
 * @method Product[] newEntities(array $data, array $options = [])
 * @method Product|false save(EntityInterface $entity, $options = [])
 * @method Product saveOrFail(EntityInterface $entity, $options = [])
 * @method Product patchEntity(EntityInterface $entity, array $data, array $options = [])
 * @method Product[] patchEntities($entities, array $data, array $options = [])
 * @method Product findOrCreate($search, callable $callback = null, $options = [])
 */
class ProductTable extends Table
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

        $this->setTable('product');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->belongsToMany('Category', [
            'foreignKey' => 'product_id',
            'targetForeignKey' => 'category_id',
            'joinTable' => 'product_category'
        ]);
    }

    /**
     * Default validation rules.
     *
     * @param Validator $validator Validator instance.
     * @return Validator
     */
    public function validationDefault(Validator $validator)
    {
        $validator
            ->integer('id')
            ->allowEmptyString('id', null, 'create');

        $validator
            ->scalar('name')
            ->maxLength('name', 30)
            ->allowEmptyString('name');

        $validator
            ->scalar('country_of_origin')
            ->maxLength('country_of_origin', 40)
            ->allowEmptyString('country_of_origin');

        $validator
            ->decimal('purchase_price')
            ->allowEmptyString('purchase_price');

        $validator
            ->decimal('sale_price')
            ->allowEmptyString('sale_price');

        $validator
            ->scalar('description')
            ->maxLength('description', 50)
            ->allowEmptyString('description');

        return $validator;
    }
}
