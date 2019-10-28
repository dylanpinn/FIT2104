<?php
/**
 * @var AppView $this
 * @var Product[]|CollectionInterface $products
 */

use App\Model\Entity\Product;
use App\View\AppView;
use Cake\Collection\CollectionInterface; ?>

<!--suppress HtmlDeprecatedAttribute -->
<div class="flex overflow-x-auto mt-8 bg-gray-200 rounded">
    <table class="table-auto overflow-x-auto text-gray-900">
        <thead>
            <tr>
                <th class="px-4 py-2"><?= $this->Paginator->sort('id') ?></th>
                <th class="px-4 py-2"><?= $this->Paginator->sort('name') ?></th>
                <th class="px-4 py-2"><?= $this->Paginator->sort('category') ?></th>
                <th class="px-4 py-2"><?= $this->Paginator->sort('country_of_origin') ?></th>
                <th class="px-4 py-2"><?= $this->Paginator->sort('purchase_price') ?></th>
                <th class="px-4 py-2"><?= $this->Paginator->sort('sale_price') ?></th>
                <th class="px-4 py-2"><?= $this->Paginator->sort('description') ?></th>
                <th class="px-4 py-2"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
        <?php foreach ($products as $product): ?>
            <tr>
                <td class="border px-4 py-2"><?= $this->Number->format($product->id) ?></td>
                <td class="border px-4 py-2"><?= h($product->name) ?></td>
                <td class="border px-4 py-2">
                    <?php if ($product->category) {
                        foreach ($product->category as $category) {
                            echo $this->Html->link(__($category->name), ['controller' => 'Category', 'action' => 'view', $category->id]);
                            echo "<br />";
                        }
                    } ?>
                </td>
                <td class="border px-4 py-2"><?= h($product->country_of_origin) ?></td>
                <td class="border px-4 py-2"><?= $this->Number->currency($product->purchase_price, 'USD') ?></td>
                <td class="border px-4 py-2"><?= $this->Number->currency($product->sale_price, 'USD') ?></td>
                <td class="border px-4 py-2"><?= h($product->description) ?></td>
                <td class="border px-4 py-2 font-bold tracking-wide">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $product->id], ["class" => "text-blue-700 hover:text-blue-500"]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $product->id], ["class" => "text-blue-700 hover:text-blue-500"]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $product->id], ['confirm' => __('Are you sure you want to delete # {0}?', $product->id), "class" => "text-blue-700 hover:text-blue-500"]) ?>
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
