<?php

namespace App\Controller;

use App\Model\Entity\Category;
use App\Model\Table\CategoryTable;
use Cake\Datasource\Exception\RecordNotFoundException;
use Cake\Datasource\ResultSetInterface;
use Cake\Http\Response;

/**
 * Category Controller
 *
 * @property CategoryTable $Category
 *
 * @method Category[]|ResultSetInterface paginate($object = null, array $settings = [])
 */
class CategoryController extends AppController
{
    /**
     * Index method
     *
     * @return void
     */
    public function index()
    {
        $categories = $this->paginate($this->Category);

        $this->set(compact('categories'));
    }

    /**
     * View method
     *
     * @param string|null $id Category id.
     * @return void
     */
    public function view($id = null)
    {
        $category = $this->Category->get($id, [
            'contain' => ['Product']
        ]);

        $this->set('category', $category);
    }

    /**
     * Add method
     *
     * @return Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $category = $this->Category->newEntity();
        if ($this->request->is('post')) {
            $category = $this->Category->patchEntity($category, $this->request->getData());
            if ($this->Category->save($category)) {
                $this->Flash->success(__('The category has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The category could not be saved. Please, try again.'));
        }
        $products = $this->Category->Product->find('list', ['limit' => 200]);
        $this->set(compact('category', 'products'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Category id.
     * @return Response|void Redirects on successful edit, renders view otherwise.
     * @throws RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $category = $this->Category->get($id, [
            'contain' => ['Product']
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $category = $this->Category->patchEntity($category, $this->request->getData());
            if ($this->Category->save($category)) {
                $this->Flash->success(__('The category has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The category could not be saved. Please, try again.'));
        }
        $products = $this->Category->Product->find('list', ['limit' => 200]);
        $this->set(compact('category', 'products'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Category id.
     * @return Response|null Redirects to index.
     * @throws RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $category = $this->Category->get($id);
        if ($this->Category->delete($category)) {
            $this->Flash->success(__('The category has been deleted.'));
        } else {
            $this->Flash->error(__('The category could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
