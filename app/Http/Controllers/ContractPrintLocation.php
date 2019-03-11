<?php

namespace App\Http\Controllers;
use App\Events;
use App\TypeEvents;
use Illuminate\Http\Request;
use PhpOffice\PhpWord\Element\field;
use PhpOffice\PhpWord\Element\Table;
use PhpOffice\PhpWord\Element\TextRun;
use PhpOffice\PhpWord\SimpleType\TblWidth;

class contractPrintLocation extends Controller
{
    public function show($id){
        // Template processor instance creation
        $event=Events::findOrFail($id);
        //echo date('H:i:s'), ' Creating new TemplateProcessor instance...';
        $templateProcessor = new \PhpOffice\PhpWord\TemplateProcessor(storage_path('Template.docx'));
        $name = new TextRun();
        $name->addText($event->name.' '.$event->firstname, array('bold' => true,  'color' => 'black'));
        $templateProcessor->setComplexValue('name', $name);
        $organisation = new TextRun();
        $organisation->addText($event->user->organisation->name, array('bold' => true,  'color' => 'black'));
        $templateProcessor->setComplexValue('Organisation', $organisation);
        $Adresse = new TextRun();
        $Adresse->addText($event->user->street.' '.$event->user->streetNum.' - '.$event->user->city->zipCode.' '.$event->user->city->name, array('bold' => true,  'color' => 'black'));
        $templateProcessor->setComplexValue('Adresse', $Adresse);
        $phone = new TextRun();
        $phone->addText($event->user->phone, array('bold' => true,  'color' => 'black'));
        $templateProcessor->setComplexValue('phone', $phone);
        $mail = new TextRun();
        $mail->addText($event->user->email, array('bold' => true,  'color' => 'black'));
        $templateProcessor->setComplexValue('mail', $mail);
        $date = new TextRun();
        $date->addText($event->start_date.' - '.$event->end_date, array('bold' => true,  'color' => 'black'));
        $templateProcessor->setComplexValue('date', $date);
        $horaire = new TextRun();
        $horaire->addText($event->startime.' - '.$event->endtime, array('bold' => true,  'color' => 'black'));
        $templateProcessor->setComplexValue('horaire', $horaire);
        $type = new TextRun();
        $type->addText($event->type->name, array('bold' => true,  'color' => 'black'));
        $templateProcessor->setComplexValue('type', $type);
        $people = new TextRun();
        $people->addText($event->numPeopleExp, array('bold' => true,  'color' => 'black'));
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
