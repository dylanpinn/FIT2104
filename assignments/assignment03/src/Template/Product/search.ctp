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
        <li class="text-blue-700 hover:text-blue-500 font-bold tracking-wide"><?= $this->Html->link(__('List Products'), ['action' => 'index']) ?> </li>
        <li class="text-blue-700 hover:text-blue-500 font-bold tracking-wide"><?= $this->Html->link(__('New Product'), ['action' => 'add']) ?></li>
    </ul>
</nav>
<section class="w-full xl:w-auto xl:flex-1 xl:mt-4 py-0 px-4 container mx-auto">
    <h3 class="text-2xl font-bold relative tracking-wide text-gray-800 mb-2"><?= __('Product Search') ?></h3>

    <div class="px-8 py-6 bg-gray-300 rounded shadow lg:max-w-4xl">
        <?php $myTemplates = [
            'inputContainer' => '<div class="form-control">{{content}}</div>',
        ];
        $this->Form->setTemplates($myTemplates);
        ?>
        <?= $this->Form->create(null, ['type' => 'get']) ?>
        <?= $this->Form->control('country_of_origin', ['class' => 'form-input', "value" => $this->request->getQuery('country_of_origin', "")]) ?>
        <?= $this->Form->control('sale_price', ['label' => 'Maximum Sale Price ($)', 'type' => 'number', 'min' => '-1', 'step' => '0.01', "class" => "form-input", "value" => $this->request->getQuery("sale_price", "")]) ?>
        <?= $this->Form->control('category', ["class" => "form-input", "value" => $this->request->getQuery("category", "")]) ?>
        <?= $this->Form->button(__('Search'), ["type" => "submit", "class" => "btn"]) ?>
        <?= $this->Form->end() ?>
    </div>

    <?= $this->element('product_table', ['products' => $products]) ?>
</section>
