<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\JournalController;
use App\Http\Controllers\CodesjournauxController;
use App\Http\Controllers\plancpteController;
use App\Http\Controllers\EntstockController;
use App\Http\Controllers\SortistockController;
use App\Http\Controllers\StocksController;
use App\Http\Controllers\BalanceController;
use App\Http\Controllers\grdlivreController;
use App\Http\Controllers\EmployeController;
use App\Http\Controllers\SalbrutimpController;
use App\Http\Controllers\EntController;
use App\Http\Controllers\BulletinController;
use App\Http\Controllers\CpteResultController;
use App\Http\Controllers\BilanController;
use App\Http\Controllers\SalaireController;
use App\Http\Controllers\CotsocpatController;
use App\Http\Controllers\CotficpatController;
use App\Http\Controllers\ProduitController;
use App\Http\Controllers\AchatsController;
use App\Http\Controllers\VentesController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\FournisseurController;
use App\Http\Controllers\ChartController;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

//use App\Http\Middleware\myhtmlminifier;
/*
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|


Route::get('/', function () {
    return view('welcome');
});

*/

Route::middleware(['myhtmlminifier'])->group(static function()  { 

Route::get('/', function () {
    return view('index');
});

// Route::get('/scan', function () {
//     return QrCode::generate('https://techvblogs.com/blog/generate-qr-code-laravel-8');
// });

Route::resource("/produit", ProduitController::class);
/* Route::GET('/scan', [ProduitController::class, function scan() {
    return QrCode::generate('https://techvblogs.com/blog/generate-qr-code-laravel-8';)
}]); */
// Route::GET('/editionprod/{id}', [ProduitController::class,'editionprod'])->name('editionprod');
Route::GET('/scan', [ProduitController::class,'scan']);
Route::resource("/fournisseurs", FournisseurController::class);
Route::resource("/clients", ClientController::class);
Route::resource("/achats", AchatsController::class);
Route::GET('/achatscan', [AchatsController::class,'achatscan']);
Route::GET('/searchfactach', [AchatsController::class,'searchfactach'])->name('searchfactach');
Route::GET('/searchfactach1', [AchatsController::class,'searchfactach1'])->name('searchfactach1');
Route::GET('/searchach1', [AchatsController::class,'searchach1'])->name('searchach1');
Route::GET('/searchach2', [AchatsController::class,'searchach2'])->name('searchach2');
Route::GET('/searchach3', [AchatsController::class,'searchach3'])->name('searchach3');
Route::POST('/searchach', [AchatsController::class,'searchach']);
Route::POST('/getachats', [AchatsController::class,'getachats']);
Route::POST('/downloadach', [AchatsController::class,'downloadach']);
Route::POST('/downloadfactach', [AchatsController::class,'downloadfactach']);
Route::resource("/ventes", VentesController::class);
Route::GET('/ventescan', [VentesController::class,'ventescan']);
Route::GET('/searchvte1', [VentesController::class,'searchvte1'])->name('searchvte1');
Route::GET('/searchvte2', [VentesController::class,'searchvte2'])->name('searchvte2');
Route::POST('/searchvte', [VentesController::class,'searchvte']);
Route::POST('/getventes', [VentesController::class,'getventes']);
Route::POST('/downloadvte', [VentesController::class,'downloadvte']);
Route::POST('/downloadfactvte', [VentesController::class,'downloadfactvte']);
Route::GET('/searchfactvte', [VentesController::class,'searchfactvte'])->name('searchfactvte');
Route::GET('/searchfactvte1', [VentesController::class,'searchfactvte1'])->name('searchfactvte1');
Route::resource("/journal", JournalController::class);
Route::GET('/searchcpte1', [JournalController::class,'searchcpte1'])->name('searchcpte1');
Route::GET('/searchcodejournal', [JournalController::class,'searchcodejournal'])->name('searchcodejournal');
Route::POST('/getjournal', [JournalController::class,'getjournal']);
Route::POST('/downloadjournal', [JournalController::class,'downloadjournal']);
Route::resource("/codesjournaux", CodesjournauxController::class);
Route::resource("/plancpte", plancpteController::class);
Route::resource("/entstock", EntstockController::class);
Route::GET('/searchent1', [EntstockController::class,'searchent1'])->name('searchent1');
Route::POST('/searchentstock', [EntstockController::class,'searchentstock']);
Route::POST('/getentstock', [EntstockController::class,'getentstock']);
Route::resource("/sortistock", SortistockController::class);
Route::GET('/searchsort1', [SortistockController::class,'searchsort1'])->name('searchsort1');
Route::POST('/searchsortistock', [SortistockController::class,'searchsortistock']);
Route::POST('/getsortistock', [SortistockController::class,'getsortistock']);
Route::resource("/stockactu", StocksController::class);
Route::resource("/Balance", BalanceController::class);
Route::POST('/getBalance', [BalanceController::class,'getBalance']);
Route::POST('/downloadbalance', [BalanceController::class,'downloadbalance']);
Route::resource("/grdlivre", grdlivreController::class);
Route::POST('/getlivre', [grdlivreController::class,'getlivre']);
Route::GET('/searchfromcpte', [grdlivreController::class,'searchfromcpte'])->name('searchfromcpte');
Route::GET('/searchtocpte', [grdlivreController::class,'searchtocpte'])->name('searchtocpte');
Route::POST('/downloadgrdlivre', [grdlivreController::class,'downloadgrdlivre']);

Route::POST('/EmployesPDF2', [EmployeController::class,'EmployesPDF2']);
Route::resource("/employes", EmployeController::class);
Route::resource("/entreprise", EntController::class);
Route::resource("/bulletin", BulletinController::class);
Route::POST('/downloadPDF2',[BulletinController::class,'downloadPDF2']);
Route::GET('/searchfromat', [BulletinController::class,'searchfromat'])->name('searchfromat');
Route::GET('/searchtomat', [BulletinController::class,'searchtomat'])->name('searchtomat');


Route::resource("/cpteresultat", CpteResultController::class);
Route::POST('/getcpteresultat', [CpteResultController::class,'getcpteresultat']);
Route::POST('/downloadPDFcpteresultat',[CpteResultController::class,'downloadPDFcpteresultat']);
Route::resource("/bilan", BilanController::class);
Route::POST('/getbilan', [BilanController::class,'getbilan']);
Route::POST('/downloadPDFbilan',[BilanController::class,'downloadPDFbilan']);

Route::GET('/comptasalaire', [SalaireController::class,'comptasalaire']);
Route::POST('/comptasal', [SalaireController::class,'comptasal']);
Route::GET('/comptapatron', [SalaireController::class,'comptapatron']);
Route::POST('/comptapatronal', [SalaireController::class,'comptapatronal']);
Route::resource("/salaire", SalaireController::class);
Route::POST('/searchsal', [SalaireController::class,'searchsal']);
Route::POST('/downloadPDFsal',[SalaireController::class,'downloadPDFsal']);
Route::POST('/getsalaire', [SalaireController::class,'getsalaire']);
Route::GET('/searchmat', [SalaireController::class,'searchmat'])->name('searchmat');

Route::resource("/salbrutimp", SalbrutimpController::class);
Route::POST('/search', [SalbrutimpController::class,'search']);
Route::POST('/downloadPDF',[SalbrutimpController::class,'downloadPDF']);

Route::resource("/cotsocpat", CotsocpatController::class);
Route::POST('/getcotsocpat', [CotsocpatController::class,'getcotsocpat']);
Route::resource("/cotficpat", CotficpatController::class);
Route::POST('/getcotficpat', [CotficpatController::class,'getcotficpat']);

Route::POST('/getsalbrutimp', [SalbrutimpController::class,'getsalbrutimp']);
Route::POST('/search1', [CotsocempController::class,'search1']);
Route::POST('/search2', [CotficempController::class,'search2']);
Route::POST('/search4', [CotsocpatController::class,'search4']);
Route::POST('/search3', [CotficpatController::class,'search3']);

Route::resource("/loadchart", ChartController::class);
Route::GET('/loadchart1', [ChartController::class,'loadchart1']);
Route::GET('/loadchart2', [ChartController::class,'loadchart2']);

//Route::POST('/store', [SalbrutimpController::class,'store']);

});