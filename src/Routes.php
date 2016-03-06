<?php

return [
    ['GET', '/', ['Example\Controllers\Homepage', 'show']],
    ['GET', '/{slug}', ['Example\Controllers\Page', 'show']],
    // ['GET', '/another-route', function () {
    //     echo 'This works too';
    // }],
];


?>
