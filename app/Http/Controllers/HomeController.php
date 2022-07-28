<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Application;
use App\Models\ApplicationType;

/*
 * HomeController for Public Interface
 */

class HomeController extends Controller {

    public function homePage() {
        $applicationTypes = ApplicationType::orderBy('name', 'ASC')->get();
        return view('welcome', compact('applicationTypes'));
    }

    /**
     * Load Image from NFS
     *
     * @param  $image
     * @return mix
     */
    public function loadImage($image) {
        header('Content-Type: image/png');
        $imageName = imageNameDecode($image);
        readfile($imageName);
    }

    /**
     * Load PDF from NFS
     *
     * @param  $pdf
     * @return mix
     */
    public function loadPdf($pdf) {
        header('Content-Type: application/pdf');
        $image_name = imageNameDecode($pdf);
        readfile($image_name);
    }

    /**
     * Image Name Decode
     *
     * @param  $fileName
     * @return mix
     */
    function imageNameDecode($fileName)
    {
        $firstStr = str_replace("twiiiyui=", "==", $fileName);
        $secondStr = base64_decode($firstStr);
        return str_replace('rootidr', "", $secondStr);
    }

}
