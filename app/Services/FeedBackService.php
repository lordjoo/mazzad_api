<?php

namespace App\Services;
use App\Http\Resources\User\UserResource;
use App\Models\Auction;
use App\Models\Category;
use App\Models\FeedBack;


Class FeedBackService
{
    public function createFeedBack(array $data)
    {
        return FeedBack::create($data);
    }
}
