<?php

test('header components contain valid search modal and close triggers', function (string $header) {
    $contents = file_get_contents(resource_path("views/components/archinest/{$header}.blade.php"));

    expect($contents)
        ->toContain('searchOpen')
        ->toContain('@keydown.escape.window="searchOpen = false"');
})->with(['header-v1', 'header-v2']);
