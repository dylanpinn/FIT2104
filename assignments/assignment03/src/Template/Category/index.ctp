<?php
/**
 * @var AppView $this
 * @var Category[]|CollectionInterface $categories
 */

use App\Model\Entity\Category;
use App\View\AppView;
use Cake\Collection\CollectionInterface; ?>
<nav class="w-full xl:w-auto xl:flex-initial p-4">
    <ul class="px-8 py-6 leading-relaxed bg-gray-400 rounded shadow">
        <li class="text-xl font-bold leading-relaxed tracking-wide text-gray-900 mb-1"><?= __('Actions') ?></li>
        <li class="text-blue-700 hover:text-blue-500 font-bold tracking-wide"><?= $this->Html->link(__('New Category'), ['action' => 'add']) ?></li>
    </ul>
</nav>

<section class="w-full xl:w-auto xl:flex-1 xl:mt-4 py-0 px-4 container mx-auto">
    <h3 class="text-2xl font-bold relative tracking-wide text-gray-800 mb-2"><?= __('Categories') ?></h3>
    <div class="flex overflow-x-auto mt-8 bg-gray-200 rounded">
        <table class="table-auto overflow-x-auto text-gray-900">
            <thead>
            <tr>
                <th class="px-4 py-2" scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th class="px-4 py-2" scope="col"><?= $this->Paginator->sort('name') ?></th>
                <th class="px-4 py-2" scope="col"><?= __('Actions') ?></th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($categories as $category): ?>
                <tr>
                    <td class="border px-4 py-2"><?= $this->Number->format($category->id) ?></td>
                    <td class="border px-4 py-2"><?= h($category->name) ?></td>
                    <td class="border px-4 py-2 font-bold tracking-wide">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $category->id], ["class" => "text-blue-700 hover:text-blue-500"]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $category->id], ["class" => "text-blue-700 hover:text-blue-500"]) ?>
                        <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $category->id], ['confirm' => __('Are you sure you want to delete # {0}?', $category->id), "class" => "text-blue-700 hover:text-blue-500"]) ?>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <div class="my-4">
        <ul class="flex list-reset border border-grey-light rounded w-auto justify-center items-center mb-4">
            <?= $this->Paginator->first('<< ' . __('first'), ["class" => "block hover:text-white hover:bg-blue text-blue border-r border-grey-light px-3 py-2"]) ?>
            <?= $this->Paginator->prev('< ' . __('previous'), ["class" => "block hover:text-white hover:bg-blue text-blue border-r border-grey-light px-3 py-2"]) ?>
            <?= $this->Paginator->numbers(["class" => "block hover:text-white hover:bg-blue text-blue border-r border-grey-light px-3 py-2"]) ?>
            <?= $this->Paginator->next(__('next') . ' >', ["class" => "block hover:text-white hover:bg-blue text-blue border-r border-grey-light px-3 py-2"]) ?>
            <?= $this->Paginator->last(__('last') . ' >>', ["class" => "block hover:text-white hover:bg-blue text-blue border-r border-grey-light px-3 py-2"]) ?>
        </ul>
        <p class="text-center"><?= $this->Paginator->counter(['format' => __('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')]) ?></p>
    </div>
</section>
