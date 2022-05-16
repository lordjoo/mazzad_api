<?php

namespace App\Http\Controllers\Api\General;

use App\Helpers\ApiResponse;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class UploadFileController extends Controller
{
    /**
     * @var ApiResponse
     */
    private $apiResponse;

    public function __construct(ApiResponse $apiResponse)
    {
        $this->apiResponse = $apiResponse;
    }

    public function upload(Request $request) {
        // validate request
        // file must be image mime type
        // file size must be less than 6mb
        $request->validate([
            'file' => 'required|image|mimes:jpeg,png,jpg|max:6144',
        ]);
        // generate file name
        $filename = time().Str::random(8).'.'.$request->file->extension();
        try {
            // save ethe file with the new filename to the storage
            $file_uploaded = Storage::disk("public")->putFileAs('uploads', $request->file, $filename);
            return $this->apiResponse->success("FILE_UPLOADED",[$file_uploaded])->return();
        } catch (\Exception $e) {
            return $this->apiResponse->error("FILE_UPLOAD_FAILED",[$e->getMessage()])->return();
        }

    }

}
