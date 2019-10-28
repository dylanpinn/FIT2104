<?php

namespace App\Controller;

use App\Model\Entity\Product;
use App\Model\Table\ProductTable;
use Cake\Datasource\Exception\RecordNotFoundException;
use Cake\Datasource\ResultSetInterface;
use Cake\Http\Response;
use Cake\ORM\Query;

/**
 * Product Controller
 *
 * @property ProductTable $Product
 *
 * @method Product[]|ResultSetInterface paginate($object = null, array $settings = [])
 */
class ProductController extends AppController
{
    /**
     * Index method
     *
     * @return void
     */
    public function index()
    {
        $query = $this->Product->find('all');
        $query->contain(['Category']);
        $products = $this->paginate($query);

        $this->set(compact('products'));
    }

    /**
     * Search method
     *
     * @return void
     */
    public function search()
    {
        // Search on Country of Origin
        $where_conditions = [
            'country_of_origin LIKE' => '%' .
                $this->request->getQuery('country_of_origin') . '%',
        ];
        // Search on sale price if present.
        if ($this->request->getQuery('sale_price')) {
            $where_conditions['sale_price <='] = $this->request->getQuery('sale_price');
        }

        $query = $this->Product->find('all');
        $query->where($where_conditions);
        $query->contain(['Category']);

        // Search on Category if present.
        if ($this->request->getQuery('category')) {
            $query->matching('Category', function (Query $q) {
                return $q->where(['Category.name LIKE' => '%' . $this->request->getQuery('category') . '%']);
            });
        }

        $query->order(['Product.name' => 'asc']);
        $products = $this->paginate($query);

        $this->set(compact('products'));
    }

    /**
     * View method
     *
     * @param string|null $id Product id.
     * @return void
     */
    public function view($id = null)
    {
        $product = $this->Product->get($id, [
            'contain' => ['Category']
        ]);

        $this->set('product', $product);
    }

    /**
     * Add method
     *
     * @return Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $product = $this->Product->newEntity();
        if ($this->request->is('post')) {
            $product = $this->Product->patchEntity($product, $this->request->getData());
            if ($this->Product->save($product)) {
                $this->Flash->success(__('The product has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The product could not be saved. Please, try again.'));
        }
        $categories = $this->Product->Category->find('list', ['limit' => 200]);
        $this->set(compact('product', 'categories'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Product id.
     * @return Response|void Redirects on successful edit, renders view otherwise.
     * @throws RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $product = $this->Product->get($id, [
            'contain' => ['Category']
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $product = $this->Product->patchEntity($product, $this->request->getData());
            if ($this->Product->save($product)) {
                $this->Flash->success(__('The product has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The product could not be saved. Please, try again.'));
        }
        $categories = $this->Product->Category->find('list', ['limit' => 200]);
        $this->set(compact('product', 'categories'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Product id.
     * @return Response|null Redirects to index.
     * @throws RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $product = $this->Product->get($id);
        if ($this->Product->delete($product)) {
            $this->Flash->success(__('The product has been deleted.'));
        } else {
            $this->Flash->error(__('The product could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
