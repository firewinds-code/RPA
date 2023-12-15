<?php

function generateCategoryOptions()
{
    $categories = [
        'croma' => 'Croma',
        'generic' => 'GenericFormat',

    ];

    $options = '';

    foreach ($categories as $value => $label) {
        $options .= "<option value='$value'>$label</option>";
    }

    return $options;
}