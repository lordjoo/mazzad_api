<?php

namespace App\Services;
use App\Http\Resources\User\UserResource;
use App\Models\Auction;
use App\Models\Category;


Class AuctionService
{

    public function get()
    {
        return Auction::all();
    }

    public function getAuctionByCategory($category_id)
    {
        $category = Category::findOrFail($category_id);
        return $category->auctions()->get();
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

    public function searchForAuction($name)
    {
        return Auction::where('name', 'LIKE', "%".$name."%")->get();
    }
}
