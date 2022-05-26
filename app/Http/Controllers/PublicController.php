<?php

namespace App\Http\Controllers;

use App\Models\Story;

class PublicController extends Controller
{
    public function index()
    {
        $stories = Story::WithApproved()->paginate(10)->onEachSide(0);
        return view('index', compact('stories'));
    }
}
