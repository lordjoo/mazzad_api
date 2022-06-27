<?php

namespace App\Services;

use App\Models\UserAction;
use Illuminate\Support\Facades\Auth;

class UserActionService
{

    public function recordAction($auction_id, $action)
    {
        $user_action = new UserAction();
        $user_action->user_id = Auth::user()->id;
        $user_action->auction_id = $auction_id;
        $user_action->action = $action;
        $user_action->score = UserAction::$ACTIONS[$action];
        $user_action->save();
    }
}
