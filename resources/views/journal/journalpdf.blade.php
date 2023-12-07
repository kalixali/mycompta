<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Ma Comptabilité - JOURNAL</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="mstyl.css">

  </head> 
<body>
 <div class="container">
    <div class="card">
  <div class="card-header spolice"><u>JOURNAL COMPTABLE</u></div>
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
          <td class="">Num CC : <span style="padding-right:80px;"> </span></td>
              <td class="" ><span style="padding-left:80px;"> </span> {{$entreprise->numCC}} <span style="padding-right:80px;"> </span></td>
              <td class=""><span style="padding-left:80px;"> </span>  Num RC : <span style="padding-right:80px;"> </span></td>
              <td class=""> {{$entreprise->numRC}} <span style="padding-right:140px;"></span></td>
              <td class=""><span style="padding-left:80px;"> </span> Contact : <span style="padding-right:80px;"></span></td>
              <td class="" colspan="2">{{$entreprise->contact1}}</td>
        </tr>
        <br/>
        <tr >
          <td colspan="10">PERIODE : {{$period}}</td>
        </tr>
        <br/>
        <tr >
          <td colspan="10">DATE : {{$dat}}</td>
        </tr>
        <br/>
        <tr>
          <th>Date</th>
          <th>Code J.</th>
          <th>Num. pièce</th>
          <th>Compte</th>
          <th>Libellé</th>
          <th>MDebit</th>
          <th>MCredit</th>
        </tr>
        </thead>
        <tbody>
        @foreach($journal as $item)
          <tr>
            <td>{{ date('d/m/Y', strtotime($item->Date)) }}</td>
            <td>{{ $item->codejournal }}</td>
            <td>{{ $item->numpiece }}</td>
            <td>{{ $item->compte }}</td>
            <td>{{ $item->libellé }}</td>
            <td>{{ $item->Mdebit }}</td>
            <td>{{ $item->Mcredit }}</td>
          </tr>
        @endforeach
        @foreach($totjournal as $iten)
          <tr>
              <th></th>
              <th></th>
              <th></th>
              <th></th>
              <th></th>
              <th>{{ $iten->Sdebit }}</th>
              <th>{{ $iten->Scredit }}</th>
          </tr>
        @endforeach
        </tbody>
        </table>
        </div>

        </div>
        </div>
    
    </div>
    </body class="pbreak">
    </html>

    