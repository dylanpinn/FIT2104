<?php
/**
 * @var AppView $this
 * @var Product[]|CollectionInterface $products
 */

use App\Model\Entity\Product;
use App\View\AppView;
use Cake\Collection\CollectionInterface; ?>

<nav class="w-full xl:w-auto xl:flex-initial p-4">
    <ul class="px-8 py-6 leading-relaxed bg-gray-400 rounded shadow">
        <li class="text-xl font-bold leading-relaxed tracking-wide text-gray-900 mb-1"><?= __('Actions') ?></li>
        <li class="text-blue-700 hover:text-blue-500 font-bold tracking-wide"><?= $this->Html->link(__('Search Products'), ['action' => 'search']) ?> </li>
        <li class="text-blue-700 hover:text-blue-500 font-bold tracking-wide"><?= $this->Html->link(__('New Product'), ['action' => 'add']) ?></li>
    </ul>
</nav>
<section class="w-full xl:w-auto xl:flex-1 xl:mt-4 py-0 px-4 container mx-auto">
    <h3 class="text-2xl font-bold relative tracking-wide text-gray-800 mb-2"><?= __('Products') ?></h3>

    <?= $this->element('product_table', ['products' => $products]) ?>
</section>
