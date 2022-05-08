<?php

namespace App\Services;
use App\Http\Resources\User\UserResource;
use App\Models\Auction;


Class AuctionService
{

    public function get()
    {
        return Auction::all();
    }

    public function create(array $data)
    {
        return Auction::create($data);
    }

    public function editUserAuction($id, array $newData,$user_id)
    {
        $auction = Auction::where('id',$id)->where('user_id',$user_id)->first();
        if(!$auction) {
            throw new \Exception('Auction not found');
        }
        return $auction->update($newData);
    }

    public function delete($auctionId)
    {
        Auction::where('id', $auctionId)->delete();
    }

    public function getById($id)
    {
        return Auction::findOrFail($id);
    }

}
