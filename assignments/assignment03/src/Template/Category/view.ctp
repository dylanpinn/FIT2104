<?php
/**
 * @var AppView $this
 * @var Category $category
 */

use App\Model\Entity\Category;
use App\View\AppView; ?>
<nav class="w-full xl:w-auto xl:flex-initial p-4">
    <ul class="px-8 py-6 leading-relaxed bg-gray-400 rounded shadow">
        <li class="text-xl font-bold leading-relaxed tracking-wide text-gray-900 mb-1"><?= __('Actions') ?></li>
        <li class="text-blue-700 hover:text-blue-500 font-bold tracking-wide"><?= $this->Html->link(__('List Categories'), ['action' => 'index']) ?> </li>
        <li class="text-blue-700 hover:text-blue-500 font-bold tracking-wide"><?= $this->Html->link(__('New Category'), ['action' => 'add']) ?></li>
    </ul>
</nav>

<section class="w-full xl:w-auto xl:flex-1 xl:mt-4 py-0 px-4 container mx-auto">
    <h3 class="text-2xl font-bold relative tracking-wide text-gray-800 mb-2"><?= h($category->name) ?></h3>

    <div class="flex overflow-x-auto mt-8 bg-gray-200 rounded">
        <table class="table-auto overflow-x-auto text-gray-900">
            <tr>
                <th class="px-4 py-2 border" scope="row"><?= __('Name') ?></th>
                <td class="px-4 py-2 border"><?= h($category->name) ?></td>
            </tr>
            <tr>
                <th class="px-4 py-2 border" scope="row"><?= __('Id') ?></th>
                <td class="px-4 py-2 border"><?= $this->Number->format($category->id) ?></td>
            </tr>
        </table>
    </div>
    <div class="mt-5 bg-gray-200 rounded p-4">
        <h4 class="text-xl font-bold relative tracking-wide text-gray-700 mb-1"><?= __('Related Products') ?></h4>
        <?php if (!empty($category->product)): ?>
            <table class="table-auto overflow-x-auto text-gray-900">
                <tr>
                    <th class="px-4 py-2 border" scope="col"><?= __('Id') ?></th>
                    <th class="px-4 py-2 border" scope="col"><?= __('Name') ?></th>
                    <th class="px-4 py-2 border" scope="col"><?= __('Country Of Origin') ?></th>
                    <th class="px-4 py-2 border" scope="col"><?= __('Purchase Price') ?></th>
                    <th class="px-4 py-2 border" scope="col"><?= __('Sale Price') ?></th>
                    <th class="px-4 py-2 border" scope="col"><?= __('Description') ?></th>
                    <th class="px-4 py-2 border" scope="col"><?= __('Actions') ?></th>
                </tr>
                <?php foreach ($category->product as $product): ?>
                    <tr>
                        <td class="px-4 py-2 border"><?= h($product->id) ?></td>
                        <td class="px-4 py-2 border"><?= h($product->name) ?></td>
                        <td class="px-4 py-2 border"><?= h($product->country_of_origin) ?></td>
                        <td class="px-4 py-2 border"><?= h($product->purchase_price) ?></td>
                        <td class="px-4 py-2 border"><?= h($product->sale_price) ?></td>
                        <td class="px-4 py-2 border"><?= h($product->description) ?></td>
                        <td class="border px-4 py-2 font-bold tracking-wide">
                            <?= $this->Html->link(__('View'), ['controller' => 'Product', 'action' => 'view', $product->id], ["class" => "text-blue-700 hover:text-blue-500"]) ?>
                            <?= $this->Html->link(__('Edit'), ['controller' => 'Product', 'action' => 'edit', $product->id], ["class" => "text-blue-700 hover:text-blue-500"]) ?>
                            <?= $this->Form->postLink(__('Delete'), ['controller' => 'Product', 'action' => 'delete', $product->id], ['confirm' => __('Are you sure you want to delete # {0}?', $product->id), "class" => "text-blue-700 hover:text-blue-500"]) ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </table>
        <?php endif; ?>
    </div>
</section>
