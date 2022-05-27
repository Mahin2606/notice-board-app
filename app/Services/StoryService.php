<?php

namespace App\Services;

use App\Models\Story;
use App\Enums\StoryStatus;

class StoryService
{
    public function createStory($data)
    {
        $story = new Story();
        $story->fill($data);
        $story->save();

        return $story->fresh();
    }

    public function approveStory(Story $story)
    {
        $story->status = StoryStatus::APPROVED;
        $story->save();
        return $story->fresh();
    }
}
