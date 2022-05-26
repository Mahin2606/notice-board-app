<?php

namespace App\Services;

use App\Models\Story;

class StoryService
{
    public function createStory($data)
    {
        $story = new Story();
        $story->fill($data);
        $story->save();

        return $story->fresh();
    }
}
