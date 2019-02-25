<?php
/**
 * Created by PhpStorm.
 * User: Marqu
 * Date: 18/02/2019
 * Time: 09:46
 */

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use PhpOffice\PhpWord\Element\field;
use PhpOffice\PhpWord\Element\Table;
use PhpOffice\PhpWord\Element\TextRun;
use PhpOffice\PhpWord\SimpleType\TblWidth;


class WordTestTemplateController
{
    public function createWordTemplateDocx()
    {
        // Template processor instance creation
        echo date('H:i:s'), ' Creating new TemplateProcessor instance...';
        $templateProcessor = new \PhpOffice\PhpWord\TemplateProcessor(storage_path('Template.docx'));
        $name = new TextRun();
        $name->addText('Marquebreucq Emmanuel ', array('bold' => true,  'color' => 'black'));
        $templateProcessor->setComplexValue('name', $name);
        $organisation = new TextRun();
        $organisation->addText('Ephec ', array('bold' => true,  'color' => 'black'));
        $templateProcessor->setComplexValue('Organisation', $organisation);
        $Adresse = new TextRun();
        $Adresse->addText('avenue du ciseau 15 -1383 louvain-la-neuve ', array('bold' => true,  'color' => 'black'));
        $templateProcessor->setComplexValue('Adresse', $Adresse);
        $phone = new TextRun();
        $phone->addText('0478956317 ', array('bold' => true,  'color' => 'black'));
        $templateProcessor->setComplexValue('phone', $phone);
        $mail = new TextRun();
        $mail->addText('marquebreucqe@outlook.be ', array('bold' => true,  'color' => 'black'));
        $templateProcessor->setComplexValue('mail', $mail);
        $date = new TextRun();
        $date->addText('mardi 19/02/2019 ', array('bold' => true,  'color' => 'black'));
        $templateProcessor->setComplexValue('date', $date);
        $horaire = new TextRun();
        $horaire->addText('13h-15h ', array('bold' => true,  'color' => 'black'));
        $templateProcessor->setComplexValue('horaire', $horaire);
        $type = new TextRun();
        $type->addText('réunion TFE', array('bold' => true,  'color' => 'black'));
        $templateProcessor->setComplexValue('type', $type);
        $people = new TextRun();
        $people->addText('10 ', array('bold' => true,  'color' => 'black'));
        $templateProcessor->setComplexValue('people', $people);
        $montant = new TextRun();
        $montant->addText('150', array('bold' => true,  'color' => 'black'));
        $templateProcessor->setComplexValue('montant', $montant);
        $garantie = new TextRun();
        $garantie->addText('100 ', array('bold' => true,  'color' => 'black'));
        $templateProcessor->setComplexValue('garantie', $garantie);
        $total = new TextRun();
        $total->addText(100+150, array('bold' => true,  'color' => 'black'));
        $templateProcessor->setComplexValue('total', $total);



        echo date('H:i:s'), ' Saving the result document...';
        $templateProcessor->saveAs(storage_path('testtemplate.docx'));
        /*echo getEndingNotes(array('Word2007' => 'docx'));*/

    }
}