<?php

namespace App\Helpers;

use App\Models\Application;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;

class ImageHelper
{
    static function Save(Application $application, Request $request, $field = 'image')
    {
        $image = '';

        if (!empty($request[$field]))
        {
            if (!File::exists($application->uploadThumbsDir))
            {
                File::makeDirectory($application->uploadThumbsDir, 0755, true);
            }

            $imageRequest = $request->file($field);
            $image = time() . '.' .$field. '.' . $imageRequest->getClientOriginalExtension();
            $imageRequest->move($application->uploadSourceDir, $image);
        }

        return $image;
    }

    static function Delete(Application $application, $object, $field = 'image')
    {
        if (!empty($object->$field))
        {
            if (File::exists($application->uploadSourceDir . '/' . $object->$field))
            {
                File::delete($application->uploadSourceDir . '/' . $object->$field);
            }

            if (File::exists($application->uploadThumbsDir . '/' . $object->$field))
            {
                File::delete($application->uploadThumbsDir . '/' . $object->$field);
            }
        }
    }

    static function Thumb($file, $width, $height)
    {
        $path = public_path($file);
        
        if(File::exists($path))
        {
            $thumbInfo = pathinfo($path);
            $thumbUrl = '/thumbs/'.str_replace($thumbInfo['basename'], $width.'-'.$height.'-'.$thumbInfo['basename'], $file);
            $thumbFile = public_path('thumbs/'.str_replace($thumbInfo['basename'], $width.'-'.$height.'-'.$thumbInfo['basename'], $file));

            if(!File::exists($thumbFile))
            {
                $thumbInfo = pathinfo($thumbFile);

                if(!File::exists($thumbInfo['dirname']))
                {
                    File::makeDirectory($thumbInfo['dirname'], 0755, true);
                }

                $thumb = Image::make($path);
                $org_width = Image::make($path)->width();
                $org_height = Image::make($path)->height();

                if($org_width > $org_height)
                {
                    $procent = $height / $org_height;

                    if(($org_width * $procent) < $width)
                    {
                        $thumb->widen($width);
                    }
                    else
                    {
                        $thumb->heighten($height);
                    }
                }
                else
                {
                    $procent = $width / $org_width;

                    if(($org_height * $procent) < $height)
                    {
                        $thumb->heighten($height);
                    }
                    else
                    {
                        $thumb->widen($width);
                    }
                }

                $thumb->crop($width, $height);
                $thumb->save($thumbFile);
            }

            echo $thumbUrl;
        }
    }
}
?>
