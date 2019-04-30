@extends('adminlte::page')

@section('title', 'appCentrePlacet')

@section('content_header')
    <h1>Informations pratiques :</h1>
@stop

@section('content')
   {{-- @if ((Auth::user()->phone=='none' )|| (Auth::user()->street=='none')|| (Auth::user()->streetNum=='none'))
        @lang('app.uncompletProfiel')
    @else
        @lang('app.welkom')
    @endif--}}

   <h2>La salle :</h2>


   <ul class="list-unstyled">

       <li>Superficie : 218m2 + sanitaires et cuisine</li>

       <li> Matériel : bancs, chaises et tables en suffisance pour 218 personnes</li>
       <li>Cuisine : 2 frigos, 4 taques de cuisson électriques, 1 four, 1 évier, 1 plan de travail, 1 bar</li>
       <li>Nombre maximum de personnes : 218</li>
       <li>Modalités de réservation :

           <ul>

               <li>Consultez l’agenda des disponibilités</li>

               <li>Créez un compte pour effectuer une demande de réservation</li>
               <li>Vous recevez une proposition tarifaire et un contrat de location par mail</li>
               <li>Contrat signé et renvoyé = plage horaire bloquée à votre nom</li>
               <li>Paiement est effectué = réservation et location validée</li>

           </ul>

   </ul>
    <br>
   <p>Envie de visiter la salle ? Faire une réservation sur place ?</p>
   <p>Contactez le gestionnaire de la salle :</p>
   <a href="mailto:e.marquebreucq@students.ephec.be?subject=Feedback">Baptiste.mertens@placet.be</a>

   010/ 47 91 99

@stop