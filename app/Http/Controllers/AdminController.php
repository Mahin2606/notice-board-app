<?php

namespace App\Http\Controllers;

use App\Models\Story;
use App\Enums\StoryStatus;

use App\Services\StoryService;
use App\Http\Requests\StoryRequest;

use Illuminate\Support\Str;
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
        $stories = Story::paginate(5)->onEachSide(0);
        return view('admin.dashboard', compact('stories'));
    }

    public function createStory(StoryRequest $request)
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
            return redirect()->route('admin.dashboard')->withErrors(['error' => __("Oops! Something went wrong. Please try again after sometimes.")]);
        }
    }

    public function aprroveStory(Request $request)
    {
        if (!$request->filled('token')) {
            return redirect()->route('admin.dashboard')->withErrors(['error' => __('The approval link is invalid.')]);
        }

        $stortyID = $this->getStoryID($request);
        $story = Story::find($stortyID);
        if (empty($story)) {
            return redirect()->route('admin.dashboard')->withErrors(['error' => __('Story Approve failed! The token is invalid.')]);
        }

        if ($story->status == StoryStatus::APPROVED) {
            return redirect()->route('admin.dashboard')->withErrors(['info' => __('The story is already approved.')]);
        }

        $story = $this->storyService->approveStory($story);
        if ($story) {
            // event(new StoryStatusUpdated($story));
            return redirect()->route('admin.dashboard')->with(['success' => __("Story has been approved successfully!")]);
        } else {
            return redirect()->route('admin.dashboard')->withErrors(['error' => __("Oops! Something went wrong. Please try again after sometimes.")]);
        }
    }

    private function getStoryID($request)
    {
        $token = $request->get('token');
        $email  = substr($token, -32);
        $id = Str::replaceLast($email, '', $token);
        return $id ?? 0;
    }
}
