<?php
/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link          https://cakephp.org CakePHP(tm) Project
 * @since         0.10.0
 * @license       https://opensource.org/licenses/mit-license.php MIT License
 */

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        Famox | <?= $this->fetch('title') ?>
    </title>
    <?= $this->Html->meta('icon') ?>

    <?= $this->Html->css('main.css') ?>
    <?= $this->Html->script('main.js') ?>

    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
    <?= $this->fetch('script') ?>
</head>
<body class="font-sans leading-normal tracking-normal antialiased">
    <div class="flex bg-teal-500 shadow">
        <nav class="flex items-center justify-between flex-wrap p-6 container mx-auto" data-topbar role="navigation">
            <div class="flex items-center flex-shrink-0 text-white mr-6">
                <?= $this->Html->link('Famox', ["controller" => "Pages", "action" => "home"], ["class" => "font-semibold text-xl tracking-light"]); ?>
            </div>
            <div class="block lg:hidden">
                <button
                    data-behaviour="mobile-nav--btn"
                    class="flex items-center px-3 py-2 border rounded text-teal-200 border-teal-400 hover:text-white hover:border-white">
                    <svg class="fill-current h-3 w-3" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <title>Menu</title>
                        <path d="M0 3h20v2H0V3zm0 6h20v2H0V9zm0 6h20v2H0v-2z"/>
                    </svg>
                </button>
            </div>
            <div class="hidden w-full block flex-grow lg:flex lg:items-center lg:w-auto" data-behaviour="mobile-nav--content">
                <div class="text-md font-semibold tracking-wide lg:flex-grow">
                    <?= $this->Html->link('Products', ["controller" => "Product", "action" => "index"], ["class" => "block mt-4 lg:inline-block lg:mt-0 text-teal-200 hover:text-white mr-4"]); ?>
                    <?= $this->Html->link('Categories', ["controller" => "Category", "action" => "index"], ["class" => "block mt-4 lg:inline-block lg:mt-0 text-teal-200 hover:text-white mr-4"]); ?>
                </div>
            </div>
        </nav>
    </div>
    <?= $this->Flash->render() ?>
    <main class="flex flex-wrap bg-grey-100">
        <?= $this->fetch('content') ?>
    </main>
    <footer class="mt-6"></footer>
</body>
</html>
