<?php
require __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\Course;

$c = Course::whereNotNull('thumbnail')->first();
if ($c) {
    echo "DB_THUMBNAIL=" . $c->thumbnail . PHP_EOL;
} else {
    echo "NO_THUMBNAIL_IN_DB" . PHP_EOL;
}
