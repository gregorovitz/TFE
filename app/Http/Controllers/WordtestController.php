<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WordtestController extends Controller
{
    public function createWordDocx()
    {
        $wordTest =new \PhpOffice\PhpWord\PhpWord();

        $newSection=$wordTest->addSection();

        $desc1="The Portfolio details is a very useful feature of the web page. you can establish your archived details and the works to the entire web community. It was outlined to bring in extra clients, get you selected based on this details.";

        $desc2 ="Using this example we can also display selected images list as a gallery for user-friendly view pages. The 3D impression gives image gallery extended beautiful and produces a better UI View. In this post, we will learn how to make a 3-Dimensionnal(3D) image gallery with help of css only on a web page ";

        $desc3=" In a real Time, many of free or paid plugins are therre to creating an image gallery. But this kind of plugins are may affect page loading speed and interrupt running scripts";

        $newSection->addText($desc1);
        $newSection->addText($desc2);
        $objectWriter= \PhpOffice\PhpWord\IOFactory::createWriter($wordTest,'Word2007');
        try{
            $objectWriter->save(storage_path('TestWordFile.docx'));
            }catch (Exception $e){
        }
        return response()->download(storage_path('TestWordFile.docx'));
    }
}
