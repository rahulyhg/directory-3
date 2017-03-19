<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Response;


class StaticFileController extends Controller
{
    /*
     * Show Storage Photos
     */
    public function show($dir, $file)
    {
        $storagePath = storage_path('app/public/' . $dir . '/' . $file);

        if( ! \File::exists($storagePath)){
            abort(404);
        }

        $mimeType = mime_content_type($storagePath);

        $headers = array(
            'Content-Type' => $mimeType,
            'Content-Disposition' => 'inline; filename="' . $file . '"'
        );

        return Response::make(file_get_contents($storagePath), 200, $headers);
    }


    /*
     * Show Storage Thumbnail Photos
     */
    public function showThb($dir, $file)
    {
        $storagePath = storage_path('app/public/' . $dir . '/thb/' . $file);

        if( ! \File::exists($storagePath)){
            abort(404);
        }

        $mimeType = mime_content_type($storagePath);

        $headers = array(
            'Content-Type' => $mimeType,
            'Content-Disposition' => 'inline; filename="' . $file . '"'
        );

        return Response::make(file_get_contents($storagePath), 200, $headers);
    }
}
