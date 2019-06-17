<?php

namespace App\Http\Controllers;
use App\Events;
use App\Booking;
use Illuminate\Http\Request;
use PhpOffice\PhpWord\Element\field;
use PhpOffice\PhpWord\Element\Table;
use PhpOffice\PhpWord\Element\TextRun;
use PhpOffice\PhpWord\SimpleType\TblWidth;

class contractPrintLocation extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:print-event');
    }
    public function show($id){
        $event=Events::findOrFail($id);
        return view('contrat.create',compact('event'));
    }
    public function store(Request $request){
        // Template processor instance creation
//        $event=Events::findOrFail($id);
//        $types=$event->description;
//        foreach ($event->type as $type){
//            $types.=$type->name;
//        }
        //echo date('H:i:s'), ' Creating new TemplateProcessor instance...';
        $booking=new Booking;
        $booking->eventId=$request['id'];
        $booking->organisationId=$request['organisationid'];
        $booking->total=$request['montant']+$request['guarantie'];
        $booking->save();
        $templateProcessor = new \PhpOffice\PhpWord\TemplateProcessor(storage_path('contrat location.docx'));
        $name = new TextRun();
        $name->addText($request->name, array('bold' => true,  'color' => 'black'));
        $templateProcessor->setComplexValue('name', $name);
        $organisation = new TextRun();
        $organisation->addText($request->organisation, array('bold' => true,  'color' => 'black'));
        $templateProcessor->setComplexValue('Organisation', $organisation);
        $Adresse = new TextRun();
        $Adresse->addText($request->address, array('bold' => true,  'color' => 'black'));
        $templateProcessor->setComplexValue('Adresse', $Adresse);
        $phone = new TextRun();
        $phone->addText($request->phone, array('bold' => true,  'color' => 'black'));
        $templateProcessor->setComplexValue('phone', $phone);
        $mail = new TextRun();
        $mail->addText($request->mail, array('bold' => true,  'color' => 'black'));
        $templateProcessor->setComplexValue('mail', $mail);
        $date = new TextRun();
        $date->addText($request->date, array('bold' => true,  'color' => 'black'));
        $templateProcessor->setComplexValue('date', $date);


        $horaire = new TextRun();
        $horaire->addText($request->schedule, array('bold' => true,  'color' => 'black'));
        $templateProcessor->setComplexValue('horaire', $horaire);
        $type = new TextRun();
        $type->addText($request->activity, array('bold' => true,  'color' => 'black'));
        $templateProcessor->setComplexValue('type', $type);
        $people = new TextRun();
        $people->addText($request->people, array('bold' => true,  'color' => 'black'));
        $templateProcessor->setComplexValue('people', $people);
        $montant = new TextRun();
        $montant->addText($request->montant, array('bold' => true,  'color' => 'black'));
        $templateProcessor->setComplexValue('montant', $montant);
        $garantie = new TextRun();
        $garantie->addText($request->guarantie, array('bold' => true,  'color' => 'black'));
        $templateProcessor->setComplexValue('garantie', $garantie);
        $total = new TextRun();
        $total->addText($request->montant+$request->guarantie, array('bold' => true,  'color' => 'black'));
        $templateProcessor->setComplexValue('total', $total);



        echo date('H:i:s'), ' Saving the result document...';
        $templateProcessor->saveAs(storage_path('testtemplate.docx'));
//        $templateProcessor->saveAs("helloWorld.docx");
        return Response()->download(storage_path('testtemplate.docx'));

    }


}
