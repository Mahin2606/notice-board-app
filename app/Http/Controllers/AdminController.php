<?php

namespace App\Http\Controllers;

use App\Models\Story;
use App\Enums\StoryStatus;

use App\Services\StoryService;
use App\Http\Requests\StoryRequest;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    private $storyService;

    public function __construct(StoryService $storyService)
    {
        $this->storyService = $storyService;
    }

    public function index()
    {
        $stories = Story::paginate(10)->onEachSide(0);
        return view('admin.dashboard', compact('stories'));
    }

    public function createStory(Request $request)
    {
        $data = [
            'user_id' => auth()->id(),
            'title' => $request->get('title'),
            'description' => $request->get('description'),
            'status' => StoryStatus::PENDING
        ];

        $story = $this->storyService->createStory($data);
        
        if ($story) {
            return redirect()->route('admin.dashboard')->with(['success' => __("Story Added successfully! An approval link has been sent to your email. Please check your email.")]);
        } else {
            return redirect()->route('admin.dashboard')->withErrors(['msg' => __("Oops! Something went wrong. Please try again after sometimes.")]);
        }
    }
}
