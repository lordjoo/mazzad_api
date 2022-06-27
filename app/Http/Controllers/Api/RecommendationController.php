<?php

namespace App\Http\Controllers\Api;

use App\Helpers\ApiResponse;
use App\Http\Controllers\Controller;
use App\Models\Auction;

class RecommendationController extends Controller
{

    public function __construct(ApiResponse $apiResponse)
    {
        $this->apiResponse = $apiResponse;
    }

    public function get($auction_id = null)
    {
        // get similar auctions from the database
        if ($auction_id) {
            $auction = Auction::find($auction_id);
            $recommendations = $this->similarTo($auction)->get();
        } else {
            if (auth()->user()) {
            }
            $recommendations = Auction::where('end_date', '>=', now())
                ->orderBy('end_date', 'asc')
                ->limit(10)->inRandomOrder()
                ->get();
            dd($recommendations);
        }
        return $this->apiResponse->success("RECOMMENDATIONS_FETCHED", $recommendations)->return();
    }

    private function similarTo(Auction $auction,$limit = 5) {
        $results = Auction::where('id',"!=",$auction->id)
            ->where('end_date', '>', now())
            ->whereHas("category", function($query) use ($auction) {
                $query->where("id", $auction->category->id)
                    ->orWhere("name","LIKE", "%{$auction->category->name}%");
            })->where(function($query) use ($auction) {
                $query = $query->where("name","LIKE", "%{$auction->name}%")
                    ->orWhere("description","LIKE", "%{$auction->description}%");
                foreach (array_slice($auction->keywords,-2) as $tag) {
                    $query = $query->orWhereJsonContains("keywords", $tag);
                }
                return $query;
            })
            ->orderBy('end_date', 'asc')
            ->inRandomOrder()->limit($limit);
        return $results;
    }


}
