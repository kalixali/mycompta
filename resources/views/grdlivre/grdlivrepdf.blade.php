<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Ma Comptabilité - GRD LIVRE</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="mstyl.css">
  </head> 
<body>
  
 <div class="container">
    <div class="card">
  <div class="card-header spolice"><u>GRD LIVRE COMPTABLE</u></div>
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
                <th>Compte</th>
                <th>Libellé</th>
                <th>MDebit</th>
                <th>MCredit</th>
                <th>Solde</th>
            </tr>
        </thead>
        <tbody>
        @for($i=0;$i<$ncpt;$i++)
            @foreach($journal[$i] as $items[$i])
                <tr >
                    <td>{{ $items[$i]->compte }}</td>
                    <td>{{ $items[$i]->libellé }}</td>
                    <td>{{ $items[$i]->Mdebit }}</td>
                    <td>{{ $items[$i]->Mcredit }}</td>
                    <td>{{ $items[$i]->Solde}}</td>
                </tr>
            @endforeach
            @foreach($jtotal[$i] as $ite[$i])
                <tr>
                    <th></th>
                    <th></th>
                    <th>{{ $ite[$i]->Tdebit }}</th>
                    <th>{{ $ite[$i]->Tcredit }}</th>
                    <th>{{ $ite[$i]->solde }}</th>
                </tr>
            @endforeach
        @endfor
        @foreach($totjournal as $iten)
            <tr>
                <th></th>
                <th></th>
                <th>{{ $iten->Sdebit }}</th>
                <th>{{ $iten->Scredit }}</th>
                <th>{{ $iten->Tsolde }}</th>
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

    