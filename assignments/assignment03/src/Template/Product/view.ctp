<?php
/**
 * @var AppView $this
 * @var Product $product
 */

use App\Model\Entity\Product;
use App\View\AppView; ?>

<nav class="w-full xl:w-auto xl:flex-initial p-4">
    <ul class="px-8 py-6 leading-relaxed bg-gray-400 rounded shadow">
        <li class="text-xl font-bold leading-relaxed tracking-wide text-gray-900 mb-1"><?= __('Actions') ?></li>
        <li class="text-blue-700 hover:text-blue-500 font-bold tracking-wide"><?= $this->Html->link(__('List Products'), ['action' => 'index']) ?> </li>
        <li class="text-blue-700 hover:text-blue-500 font-bold tracking-wide"><?= $this->Html->link(__('Search Products'), ['action' => 'search']) ?> </li>
        <li class="text-blue-700 hover:text-blue-500 font-bold tracking-wide"><?= $this->Html->link(__('New Product'), ['action' => 'add']) ?></li>
    </ul>
</nav>

<section class="w-full xl:w-auto xl:flex-1 xl:mt-4 py-0 px-4 container mx-auto">
    <h3 class="text-2xl font-bold relative tracking-wide text-gray-800 mb-2"><?= h($product->name) ?></h3>
    <div class="flex overflow-x-auto mt-8 bg-gray-200 rounded">
        <table class="table-auto overflow-x-auto text-gray-900">
            <tr>
                <th class="px-4 py-2 border" scope="row"><?= __('Name') ?></th>
                <td class="px-4 py-2 border"><?= h($product->name) ?></td>
            </tr>
            <tr>
                <th class="px-4 py-2 border" scope="row"><?= __('Country Of Origin') ?></th>
                <td class="px-4 py-2 border"><?= h($product->country_of_origin) ?></td>
            </tr>
            <tr>
                <th class="px-4 py-2 border" scope="row"><?= __('Description') ?></th>
                <td class="px-4 py-2 border"><?= h($product->description) ?></td>
            </tr>
            <tr>
                <th class="px-4 py-2 border" scope="row"><?= __('Id') ?></th>
                <td class="px-4 py-2 border"><?= $this->Number->format($product->id) ?></td>
            </tr>
            <tr>
                <th class="px-4 py-2 border" scope="row"><?= __('Purchase Price') ?></th>
                <td class="px-4 py-2 border"><?= $this->Number->currency($product->purchase_price, 'USD') ?></td>
            </tr>
            <tr>
                <th class="px-4 py-2 border" scope="row"><?= __('Sale Price') ?></th>
                <td class="px-4 py-2 border"><?= $this->Number->currency($product->sale_price, 'USD') ?></td>
            </tr>
        </table>
    </div>
    <div class="mt-5 bg-gray-200 rounded">
        <h4 class="text-xl font-bold relative tracking-wide text-gray-700 mb-1"><?= __('Related Categories') ?></h4>
        <?php if (!empty($product->category)): ?>
            <table class="table-auto overflow-x-auto text-gray-900">
                <tr>
                    <th class="px-4 py-2 border" scope="col"><?= __('Id') ?></th>
                    <th class="px-4 py-2 border" scope="col"><?= __('Name') ?></th>
                    <th class="px-4 py-2 border" scope="col"><?= __('Actions') ?></th>
                </tr>
                <?php foreach ($product->category as $category): ?>
                    <tr>
                        <td class="px-4 py-2 border"><?= h($category->id) ?></td>
                        <td class="px-4 py-2 border"><?= h($category->name) ?></td>
                        <td class="border px-4 py-2 font-bold tracking-wide">
                            <?= $this->Html->link(__('View'), ['controller' => 'Category', 'action' => 'view', $category->id], ["class" => "text-blue-700 hover:text-blue-500"]) ?>
                            <?= $this->Html->link(__('Edit'), ['controller' => 'Category', 'action' => 'edit', $category->id], ["class" => "text-blue-700 hover:text-blue-500"]) ?>
                            <?= $this->Form->postLink(__('Delete'), ['controller' => 'Category', 'action' => 'delete', $category->id], ['confirm' => __('Are you sure you want to delete # {0}?', $category->id), "class" => "text-blue-700 hover:text-blue-500"]) ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </table>
        <?php endif; ?>
    </div>
</section>
