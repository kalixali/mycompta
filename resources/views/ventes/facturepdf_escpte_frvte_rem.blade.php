<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Ma Comptabilité - VENTES</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="mstyl.css">
  </head> 
<body>
  
 <div class="container">
    <div class="card">
  <div class="card-header spolice"><u>FACTURE DE VENTES N° {{ $nfact }}</u></div>
  <div class="card-body">
  <br/>
<div class="table-responsive">
    <table class="table">
        <thead>
        <tr >
          <td class="spolice" colspan="10">{{$entreprise->sigle}}</td>
          </tr>
          <tr >
              <td class="uppercase" colspan="10">{{$entreprise->nom_complet}}</td>
          </tr>
          <tr>
              <td class="">Num CC : <span style="padding-right:30px;"> </span></td>
              <td class="" ><span style="padding-left:30px;"> </span> {{$entreprise->numCC}} <span style="padding-right:30px;"> </span></td>
              <td class=""><span style="padding-left:30px;"> </span>  Num RC : <span style="padding-right:30px;"> </span></td>
              <td class=""> {{$entreprise->numRC}} <span style="padding-right:30px;"></span></td>
              <td class=""><span style="padding-left:30px;"> </span> Contact : <span style="padding-right:30px;"></span></td>
              <td class="" colspan="2">{{$entreprise->contact1}}</td>
        </tr>
        <br/>
        <tr >
          <td colspan="10">DATE DE FACTURATION : {{$dat}}</td>
        </tr>
        <br/>
        <tr>
            <th>Réf. Article</th>
            <th>Article</th>
            <th>Qtite</th>
            <th>PU</th>
            <th>Montant HT</th>
            <th>Taux TVA</th>
            <th>Montant TVA</th>
            <th>Montant TTC</th>
            <th>CLIENT</th>
            
            </tr>
        </thead>
        <tbody>
        @foreach($fact as $item)
            <tr>
                <td>{{ $item->refprod }}</td>
                <td>{{ $item->prod }}</td>
                <td>{{ $item->qtite }}</td>
                <td>{{ $item->pu }}</td>
                <td>{{ $item->netfcier }}</td>
                <td>{{ $item->ttva }}</td>
                <td>{{ $item->mtva }}</td>
                <td>{{ $item->mttc }}</td>
                <td>{{ $item->sigleclt }}</td>
            
            </tr>
        @endforeach
        <tr>
            <th colspan="3">MONTANT VENTE</th>
            <th colspan="2">{{ $totfact[0]->Tmont }}</th>
        </tr>
        <tr>
            <th colspan="3">REMISE</th>
            <th colspan="2">{{ $totfact[0]->Tremise }}</th>
        </tr>
        <tr>
            <th colspan="3">NET COMMERCIAL</th>
            <th colspan="2">{{ $totfact[0]->Tmontht }}</th>
        </tr>
        <tr>
            <th colspan="3">ESCOMPTE</th>
            <th colspan="2">{{ $totfact[0]->Tescpte }}</th>
        </tr>
        <tr>
            <th colspan="3">NET FINANCIER</th>
            <th colspan="2">{{ $totfact[0]->Tnetfcier }}</th>
        </tr>
       <tr>
            <th colspan="3">TVA</th>
            <th colspan="2">{{ $totfact[0]->Tmtva }}</th>
        </tr>
        <tr>
            <th colspan="3">TOTAL TTC</th>
            <th colspan="2">{{ $totfact[0]->Tvmttc }}</th>
        </tr> 
        <tr>
            <th colspan="3">Port et autres frais facturés</th>
            <th colspan="2">{{ $totfact[0]->Tfr_vte }}</th>
        </tr> 
        <tr>
            <th colspan="3">NET A PAYER</th>
            <th colspan="2">{{ $totfact[0]->Tnetpay }}</th>
        </tr>        
        </tbody>
        </table>
        </div>

        </div>
        </div>
    
    </div>
    </body class="pbreak">
    </html>

    