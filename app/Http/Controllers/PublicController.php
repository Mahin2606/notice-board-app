<?php

namespace App\Http\Controllers;

use App\Models\Story;

class PublicController extends Controller
{
    public function index()
    {
        $query = Story::WithApproved()->orderBy('id', 'DESC');
        $stories = $query->paginate(5)->onEachSide(0);
        return view('index', compact('stories'));
    }
}
