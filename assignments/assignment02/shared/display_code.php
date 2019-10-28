<?php

/**
 * Display the file contents for each section
 * @param string $section
 */
function display_code($section)
{
    // Display section only code first.
    switch ($section) {
        case 'category':
            output_code([
                '../category/index.php', '../category/categoryModify.php', '../category/add.php',
                '../category/partials/add_category_form.html'
            ]);
            break;
        case 'clients':
            output_code([
                '../clients/index.php', '../clients/clientModify.php', '../clients/add.php', '../clients/email.php',
                '../clients/pdf_download.php', '../clients/partials/add_client_form.html'
            ]);
            break;
        case 'images':
            output_code([
                '../images/index.php', '../images/partials/_alert_delete_success.html'
            ]);
            break;
        case 'login':
            output_code([
                '../login/index.php', '../login/_form_login.html', '../login/logout.php',
            ]);
            break;
        case 'projects':
            output_code([
                '../projects/index.php', '../projects/add.php', '../projects/projectModify.php',
                '../projects/partials/add_project_form.html'
            ]);
            break;
        case 'products':
            output_code([
                '../products/index.php', '../products/create.php', '../products/edit.php', '../products/remove.php',
                '../products/shared.php', '../shared/paginator.php', '../products/partials/_alert_create_success.html',
                '../products/partials/_alert_delete_success.html', '../products/partials/_alert_find_error.html',
                '../products/partials/_alert_update_success.html', '../products/partials/_confirm_delete.php',
                '../products/partials/_form_create.php', '../products/partials/_form_edit.php',
            ]);
            break;
        case 'update-prices':
            output_code([
                '../update-prices/index.php', '../update-prices/_alert_update_success.html'
            ]);
            break;
    }

    // Display shared code.
    output_code([
        '../shared/connection.php', '../shared/display_code.php', '../shared/head.php', '../shared/nav.php',
        '../shared/authentication.php'
    ]);

    // End output
    output_end();
}

/**
 * Display the file contents
 * @param string[] $file_array
 */
function output_code($file_array)
{
    echo '<div class="container">';
    foreach ($file_array as $file) {
        echo "<h2>" . $file . "</h2><br/>";
        echo "<pre><code>";
        $line = file_get_contents($file);
        $trans = get_html_translation_table(HTML_ENTITIES);
        $line = strtr($line, $trans);
        $line = str_replace("\t", "&nbsp;&nbsp;&nbsp;&nbsp;", $line);
        $line = str_replace("\n", "<br />", $line);
        echo $line . "<br />";
        echo "</code></pre><br/>";
    }
}

function output_end()
{
    echo '<script>hljs.initHighlightingOnLoad();</script>';
    echo '<div class="container">
                <div style="margin-top: 20px">
                    <a onclick="window.history.back()" class="btn btn-warning">Return</a>
                </div>
            </div>';
    echo '</div></body></html>';
}
