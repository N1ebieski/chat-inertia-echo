<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;
use Inertia\Inertia;

class ProgressController
{
    /**
     * Undocumented function
     *
     * @return void
     */
    public function __invoke()
    {
        sleep(1);

        return Inertia::render('Progress', []);
    }
}
