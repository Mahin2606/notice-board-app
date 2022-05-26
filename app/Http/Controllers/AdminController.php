<?php

namespace App\Http\Controllers;

use App\Models\Story;
use App\Enums\StoryStatus;

use App\Services\StoryService;
use App\Http\Requests\StoryRequest;

class AdminController extends Controller
{
    private $storyService;

    public function __construct(StoryService $storyService)
    {
        $this->storyService = $storyService;
    }

    public function index()
    {
        $stories = Story::WithApproved()->paginate(10)->onEachSide(0);
        return view('admin.dashboard', compact('stories'));
    }

    private function sanitizeInput($input)
    {
        $input = filter_var($input, FILTER_SANITIZE_SPECIAL_CHARS);
        $input = filter_var($input, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        return $input;
    }

    public function createStory(StoryRequest $request)
    {
        $title = $this->sanitizeInput($request->get('title'));
        $description = $this->sanitizeInput($request->get('description'));

        $data = [
            'user_id' => auth()->id(),
            'title' => $title,
            'description' => $description,
            'status' => StoryStatus::PENDING
        ];

        $story = $this->storyService->createStory($data);
        try {
            
        } catch (\Exception $e) {
            
        }
        
        if ($story) {
            return redirect()->route('admin.dashboard')->with(['success' => __("Story Added successfully!")]);
        } else {
            return redirect()->route('admin.dashboard')->withErrors(['msg' => __("Oops! Something went wrong. Please try again after sometimes.")]);
        }
    }
}
