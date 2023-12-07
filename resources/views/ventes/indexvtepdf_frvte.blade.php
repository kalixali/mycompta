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
  <div class="card-header spolice"><u>HISTORIQUE DES VENTES</u></div>
  <div class="card-body">

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
          <td colspan="10">DATE : {{$dat}}</td>
        </tr>
        <br/>
            <tr>
                <th>Réf. Article</th>
                <th>Article</th>
                <th>Qtite</th>
                <th>PU</th>
                <th>Montant Total</th>
                <th>Taux TVA</th>
                <th>Montant TVA</th>
                <th>Montant TTC</th>
                <th>Port et autres frais facturés</th>
                <th>Net à Payer</th>
                <th>CLIENT</th>
                <th>N° Facture</th>
            </tr>
        </thead>
        <tbody>
        @foreach($ventes as $item)
            <tr>
                <td>{{ $item->refprod }}</td>
                <td>{{ $item->prod }}</td>
                <td>{{ $item->qtite }}</td>
                <td>{{ $item->pu }}</td>
                <td>{{ $item->mont }}</td>
                <td>{{ $item->ttva }}</td>
                <td>{{ $item->mtva }}</td>
                <td>{{ $item->mttc }}</td>
                <td>{{ $item->fr_vte }}</td>
                <td>{{ $item->netpay }}</td>
                <td>{{ $item->sigleclt }}</td>
                <td>{{ $item->numfact }}</td>
            </tr>
        @endforeach
        @foreach($vte as $item)
        <tr>
          <th></th>
          <th></th>
          <th>{{ $item->Tqtite }}</th>
          <th></th>
          <th>{{ $item->Tmontht }}</th>
          <th></th>
          <th>{{ $item->Tmtva }}</th>
          <th>{{ $item->Tvmttc }}</th>
          <th>{{ $item->Tfr_vte }}</th>
          <th>{{ $item->Tnetpay }}</th>
          <th></th>
          <th></th>
        </tr>
        @endforeach
        <br/>
        <tr>
                <th colspan="2">TOTAL VENTES</th>
                <th>{{ $vte[0]->Tvmttc }}</th>
                <th colspan="2">TOTAL ACHATS</th>
                <th>{{ $ach[0]->Tachmttc }}</th>
                <th colspan="2">MARGE</th>
                <th>{{ $marg }}</th>
        </tr>
        
        </tbody>
        </table>
        </div>

        </div>
        </div>
    
    </div>
    </body class="pbreak">
    </html>

    