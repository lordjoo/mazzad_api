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

    public function getAuctionByCategory($category_id)
    {
        if(!(Auction::find($category_id))){
            throw new \Exception("THERE_IS_NO_AUCTIONS");
        }
        return Auction::where('category_id', $category_id)->get();
    }

    public function create(array $data)
    {
        return Auction::create($data);
    }

    public function edit($id, array $newData)
    {
        $result = Auction::find($id);
        if(!$result){
            throw new \Exception("INVALID_CATEGORY_ID");
        }
        return Auction::where('id', $id)->update($newData);
    }

    public function delete($auctionId)
    {
        Auction::where('id', $auctionId)->delete();
    }

}
