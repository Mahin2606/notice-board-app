<?php

namespace App\Http\Controllers;

use App\Models\Story;

use Illuminate\Http\Request;

class PublicController extends Controller
{
    public function index(Request $request)
    {
        $query = Story::WithApproved()->orderBy('id', 'DESC');
        $stories = $query->paginate(5)->onEachSide(0);

        if ($request->ajax()) {
            return response()->json([
                'status' => true,
                'embed' => view('stories-row', ['stories' => $stories])->render()
            ]);
        } else {
            return view('index', compact('stories'));
        }
    }
}
