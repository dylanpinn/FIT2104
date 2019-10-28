<?php
/**
 * @var AppView $this
 * @var Category $category
 * @var Product[] $products
 */

use App\Model\Entity\Category;
use App\Model\Entity\Product;
use App\View\AppView; ?>

<nav class="w-full xl:w-auto xl:flex-initial p-4">
    <ul class="px-8 py-6 leading-relaxed bg-gray-400 rounded shadow">
        <li class="text-xl font-bold leading-relaxed tracking-wide text-gray-900 mb-1"><?= __('Actions') ?></li>
        <li class="text-blue-700 hover:text-blue-500 font-bold tracking-wide"><?= $this->Html->link(__('List Categories'), ['action' => 'index']) ?> </li>
    </ul>
</nav>

<section class="w-full xl:w-auto xl:flex-1 xl:mt-4 py-0 px-4 container mx-auto">
    <h3 class="text-2xl font-bold relative tracking-wide text-gray-800 mb-2"><?= __('Add Category') ?></h3>

    <div class="px-8 py-6 bg-gray-300 rounded shadow lg:max-w-4xl">
        <?php $myTemplates = [
            'inputContainer' => '<div class="form-control">{{content}}</div>',
        ];
        $this->Form->setTemplates($myTemplates);
        ?>
        <?= $this->Form->create($category) ?>
        <fieldset>
            <?php
            echo $this->Form->control('name', ["class" => "form-input"]);
            echo $this->Form->control('product._ids', ['options' => $products, "class" => "form-input"]);
            ?>
        </fieldset>
        <?= $this->Form->button(__('Submit'), ["type" => "submit", "class" => "btn"]) ?>
        <?= $this->Form->end() ?>
    </div>
</div>
