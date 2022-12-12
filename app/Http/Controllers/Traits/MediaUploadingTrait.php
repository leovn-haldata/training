<?php

namespace App\Http\Controllers\Traits;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use File;

trait MediaUploadingTrait
{

    public function getRandomFileName($destination,$ext)
    {
        $random_file_name = Str::lower(Str::random(25));

        $file_name = $destination .'/'.$random_file_name.'.'.$ext;

        if(app('files')->exists($file_name)){
            return $this->getRandomFileName($destination,$ext);
        }
        return $random_file_name .'.'.$ext;
    }


    public function uploadFile($file,$destination,array $extra = null)
    {
        $extension = $file->getClientOriginalExtension();
        $photo_name = $this->getRandomFileName($destination,$extension);
        $path = public_path('/public') . $destination;

        try {
            if (!file_exists($path)) {
                mkdir($path, 0755, true);
            }

        } catch (\Exception $e) {
        }


        $name = uniqid() . '_' . trim($file->getClientOriginalName());
        $file->move($path ,$photo_name);
        return $destination .'/'.$photo_name;
    }
    public function uploadPublic($file, $path)
    {
        try {
            if (!file_exists(storage_path('app/public') . $path)) {
                mkdir(storage_path('app/public') . $path, 0755, true);
            }
            File::move(
                storage_path('tmp/uploads/') . $file ,
                storage_path(storage_path('app/public') . $path) . $file);
        } catch (\Exception $e) {
            report($e);

            return false;
        }

    }



    public function storeMedia(Request $request)
    {
        // Validates file size
        if (request()->has('size')) {
            $this->validate(request(), [
                'file' => 'max:' . request()->input('size') * 1024,
            ]);
        }
        // If width or height is preset - we are validating it as an image
        if (request()->has('width') || request()->has('height')) {
            $this->validate(request(), [
                'file' => sprintf(
                    'image|dimensions:max_width=%s,max_height=%s',
                    request()->input('width', 100000),
                    request()->input('height', 100000)
                ),
            ]);
        }

        $path = storage_path('tmp/uploads');

        try {
            if (!file_exists($path)) {
                mkdir($path, 0755, true);
            }
        } catch (\Exception $e) {
        }

        $file = $request->file('file');

        $name = uniqid() . '_' . trim($file->getClientOriginalName());

        $file->move($path, $name);

        return response()->json([
            'name'          => $name,
            'original_name' => $file->getClientOriginalName(),
        ]);
    }
}
