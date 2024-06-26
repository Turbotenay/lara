<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class PageController extends Controller
{
    public function index()
    {
        $files = File::files(resource_path('views/pages'));

        $pages = [];
        foreach ($files as $file) {
            $pages[] = pathinfo($file)['filename'];
        }

        return view('pages.index', compact('pages'));
    }
}
