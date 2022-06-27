<?php

namespace App\Services;

use App\Models\Auction;
use App\Models\AuctionBid;
use Carbon\Carbon;
use \Exception;
use Illuminate\Support\Facades\Config;

Class AuctionBidService
{
    public function placeBid(array $data)
    {
        $result = Auction::findOrFail($data['auction_id']);
        /*
         * the following condition means that if the user wants to bid
         * in an ended auction then we will throw an exception
         * we will use Carbon now class to get the current date then check with it
         */
        $todayDate = Carbon::now(); //to get the current date
        if ($todayDate > $result['end_date']) {
            throw new Exception("THE_AUCTION_HAS_BEEN_ENDED");
        }

        $data["bid_type"] = $result['type'];
        $bid = AuctionBid::create($data)->refresh();
        return $bid->toArray() + ["user"=>$bid->user];
    }

    public function getBids($auction_id)
    {
        /*
         * after we have the auction_id we will check if the auction
         * is already exists in the Auction model
         * then we will check if the auction type is live then using the relation
         * that in the Auction model to get auctionBids
         * and if the type isn't live we will return the maximum price
         */
        Config::set("database.connections.mysql.strict", false);
        return AuctionBid::query()->where('auction_id',$auction_id)
            ->select(\DB::raw('id,bid_type,auction_id,MAX(price) AS price,user_id,created_at'))
            ->groupBy('price')
            ->get();
    }

    public function getMaxBid($auction_id)
    {
        $result = Auction::findOrFail($auction_id);
        return [
            "max" => $result->auctionBids()->max("price")
        ];
    }
}
