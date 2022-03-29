<?php

use App\Http\Controllers\AccountingController;
use App\Http\Controllers\BriefProjectController;
use App\Http\Controllers\BrowseProjectController;
use App\Http\Controllers\CatagoriesController;
use App\Http\Controllers\CobaController;
use App\Http\Controllers\CodeController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\DataTotalCostController;
use App\Http\Controllers\DesainCardController;
use App\Http\Controllers\DesainListController;
use App\Http\Controllers\FeedbackBidController;
use App\Http\Controllers\FeedbackController;
use App\Http\Controllers\HandoverController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\HomepageController;
use App\Http\Controllers\JobController;
use App\Http\Controllers\ManagementAdminController;
use App\Http\Controllers\ManagementCustomerController;
use App\Http\Controllers\ManagementWebsiteController;
use App\Http\Controllers\ManagementWorkerController;
use App\Http\Controllers\NewsFeedController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\ResultProjectController;
use App\Http\Controllers\UploadFileController;
use App\Http\Controllers\ZipController;
use App\Http\Controllers\MessageHandoverController;
use App\Http\Controllers\OpsiContestController;
use App\Http\Controllers\PDFController;
use App\Http\Controllers\PerjanjianController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\ResultTestContestController;
use App\Http\Controllers\ShareController;
use App\Http\Controllers\SubCatagoriesController;
use App\Http\Controllers\WaittingpaymentController;
use App\Http\Controllers\WorkerController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//Coba Cek
Route::get('/coba',
// [DesainCardController::class,'BusinessCard']
// [CobaController::class,'coba']
// function () {

//         Telegram::sendMessage([
//             'chat_id' => 'RECIPIENT_CHAT_ID',
//             'text' => 'Hello world!'
//         ]);
//         $data = Telegram::getUserProfilePhotos();
//         dd($data);
//     [PaypalController::class, 'Cheackout']
//     \Illuminate\Support\Facades\Mail::to('customer@customer.com')->send(new \App\Mail\PembayaranProjectMail(3));
//     return view('coba');
//     $location = geoip()->getLocation($_SERVER['REMOTE_ADDR']);
//     return $location->toArray();
// }
);
Route::get('/', [HomepageController::class, 'index']);
Route::post('/', [HomepageController::class, 'store']);

Route::get('/home', [HomeController::class,'index'])->name('home');
Route::post('/feedback/users/{resultcontest}', [FeedbackController::class, 'UserFeedback']);

Route::middleware('verified')->group(function () {

    //All
    //Browse Project
    Route::get('/browseproject', [BrowseProjectController::class,'index'])->name('browseproject');
    Route::get('/browseproject/sort/{id}', [BrowseProjectController::class,'index']);
    //Brief NDA
    Route::get('/briefnda/{id}', [PerjanjianController::class,'PerjanjianShow']);
    Route::get('/briefnda/perjanjianfileconfirm/{id}', [PerjanjianController::class,'Perjanjian']);
    //Brief Project
    Route::get('/briefcontest/{project}', [BrowseProjectController::class,'BriefContestProject']);
    Route::get('/briefdirect/{project}', [BrowseProjectController::class,'BriefDirectProject']);
    //Feedback Contest
    Route::post('/feedback/{resultcontest}', [FeedbackController::class, 'GetData']);
    //Feedback Bid
    Route::post('/feedbackbid/{resultproject}', [FeedbackBidController::class, 'GetData']);
    Route::post('/feedbackbid/users/{resultproject}', [FeedbackBidController::class, 'UserFeedback']);
    //Handover
    Route::get('/handoverproject/{project}', [HandoverController::class, 'HandoverIndex']);
    //Convert ZIP
    Route::get('/convertzip/{id}', [ZipController::class, 'CreateZip']);
    Route::get('/convertzipproject/{id}', [ZipController::class, 'CreateZipProject']);
    //Convert PDF
    Route::get('/convertpdf/{winnercontest}', [PDFController::class, 'PDFConvert']);
    //Comentar
    // Route::post('/comentar', [MessageComentarController::class, 'MessageComentar'])->name('comentar');
    //Report Result Project
    Route::post('/report', [ReportController::class,'ReportCreate'])->name('reportcreate');
    //Profile Worker Public
    Route::get('/profileworker/{id}', [WorkerController::class, 'ProfileWorkerPublic']);
    //Message Handover
    Route::post('/kirimessagehandover', [MessageHandoverController::class, 'KirimFeedbackMessage'])->name('messagehandover');
    //NewsFeed
    Route::get('/newsfeed', [NewsFeedController::class, 'NewsFeed'])->name('newsfeed');
    //Desain Canvas
    Route::get('/themes', [DesainListController::class, 'DesainList'])->name('desainlist');
    Route::middleware('mobile')->group(function () {
        Route::get('/themes/businesscard/{id}', [DesainCardController::class, 'BusinessCard'])->name('businesscard');
        Route::get('/themes/emailsignature',[DesainCardController::class, 'EmailSignature'])->name('emailsignature');
        Route::get('/themes/letterheads/{id}', [DesainCardController::class, 'Letterheads'])->name('letterheads');
        Route::get('/themes/flayer/{id}', [DesainCardController::class, 'Flayer'])->name('flayer');
        Route::get('/themes/invoices/{id}', [DesainCardController::class, 'Invoices'])->name('invoices');
        Route::get('/themes/postcard/{id}', [DesainCardController::class, 'PostCard'])->name('postcard');
        Route::get('/themes/facebookcover/{id}', [DesainCardController::class, 'FacebookCover'])->name('facebookcover');
        Route::get('/themes/facebookpost/{id}', [DesainCardController::class, 'FacebookPost'])->name('facebookpost');
        Route::get('/themes/youtubebenners',[DesainCardController::class, 'YoutubeBenners'])->name('youtubebenners');
        Route::get('/themes/instagrampost/{id}', [DesainCardController::class, 'InstagramPost'])->name('instagrampost');
        Route::post('/themes/store', [DesainCardController::class, 'StoreDesainCard']);
        Route::post('/themes/update/{themesDesainCard}', [DesainCardController::class, 'UpdateDesainCard']);
        Route::post('/themes/loadthemes/{themesDesainCard}', [DesainCardController::class, 'LoadThemes']);
    });
    //Accept And Submit Desain Card
    Route::post('/handoverproject/acceptdesaincard/{project}', [HandoverController::class,'AcceptPilihanDesain']);
    Route::post('/handoverproject/submitdesaincard/{project}', [HandoverController::class,'SubmitPilihanDesain']);

    Route::middleware('admin')->group(function () {
        //Admin
        //Confirm Payment
        Route::get('/waittingpayment', [WaittingpaymentController::class,'GetData']);
        Route::put('/waittingpayment/confirm/{project}', [WaittingpaymentController::class,'ConfirmPayment']);
        //Management Worker
        Route::get('/managementworker', [ManagementWorkerController::class,'index'])->name('managementworker');
        Route::put('/managementworker/statusaccount/{worker}', [ManagementWorkerController::class,'StatusAccount']);
        Route::post('/managementworker/viewaccount/{worker}', [ManagementWorkerController::class,'ViewAccount']);
        Route::post('/managementworker/viewproject/{project}', [ManagementWorkerController::class,'ViewProject']);
        Route::post('/managementworker/suspendaccount/{worker}', [ManagementWorkerController::class,'SuspendAccount']);
        Route::delete('/managementworker/deleteaccount/{worker}', [ManagementWorkerController::class,'DeleteAccount']);
        //Management Customer
        Route::get('/managementcustomer', [ManagementCustomerController::class,'index'])->name('managementcustomer');
        Route::delete('/managementcustomer/deleteaccount/{customer}', [ManagementCustomerController::class,'DeleteAccount']);
        //Management Website
        Route::get('/managementwebsite/catagories', [ManagementWebsiteController::class,'Catagories'])->name('catagories');
        Route::get('/managementwebsite/opsipackage', [ManagementWebsiteController::class,'OpsiPackage'])->name('opsipackage');
        Route::get('/managementwebsite/jobcatagories', [ManagementWebsiteController::class,'JobCatagories'])->name('jobcatagories');
        Route::get('/managementwebsite/code', [ManagementWebsiteController::class,'Code'])->name('code');
        Route::get('/managementwebsite/nda', [ManagementWebsiteController::class,'NDA'])->name('nda');
        //Catagories
        Route::post('/managementwebsite/catagories/create', [CatagoriesController::class,'StoreCatagories']);
        Route::post('/managementwebsite/catagories/edit', [CatagoriesController::class,'EditCatagories']);
        Route::post('/managementwebsite/catagories/update', [CatagoriesController::class,'UpdateCatagories']);
        Route::delete('/managementwebsite/catagories/delete', [CatagoriesController::class,'DeleteCatagories']);
        //Sub Catagories
        Route::post('/managementwebsite/subcatagories/create', [SubCatagoriesController::class,'StoreSubCatagories']);
        Route::post('/managementwebsite/subcatagories/edit/{subcatagories}', [SubCatagoriesController::class,'EditSubCatagories']);
        Route::post('/managementwebsite/subcatagories/update/{subcatagories}', [SubCatagoriesController::class,'UpdateSubCatagories']);
        Route::delete('/managementwebsite/subcatagories/delete/{subcatagories}', [SubCatagoriesController::class,'DeleteSubCatagories']);
        //Opsi Package
        Route::post('/managementwebsite/opsicontest/create', [OpsiContestController::class,'StoreOpsi']);
        Route::post('/managementwebsite/opsicontest/edit', [OpsiContestController::class,'EditOpsi']);
        Route::post('/managementwebsite/opsicontest/update', [OpsiContestController::class,'UpdateOpsi']);
        Route::delete('/managementwebsite/opsicontest/delete', [OpsiContestController::class,'DeleteOpsi']);
        //Job Description
        Route::post('/managementwebsite/jobdescription/create', [JobController::class,'StoreJob']);
        Route::post('/managementwebsite/jobdescription/edit/{jobcatagories}', [JobController::class,'EditJob']);
        Route::post('/managementwebsite/jobdescription/update/{jobcatagories}', [JobController::class,'UpdateJob']);
        Route::delete('/managementwebsite/jobdescription/delete/{jobcatagories}', [JobController::class,'DeleteJob']);
        //NDA
        Route::post ('/managementwebsite/nda/{uploadfileperjanjian}', [PerjanjianController::class,'UpdatePerjanjian']);
        //Accounting
        Route::get('/acconting/data', [AccountingController::class, 'GetData'])->name('accounting');
        Route::get('/acconting/data/project/{pilihanproject}', [AccountingController::class, 'GetData']);
        Route::get('/acconting/data/income/{pilihanincome}', [AccountingController::class, 'GetData']);
        Route::get('/acconting/data/worker/{pilihanworker}', [AccountingController::class, 'GetData']);
        Route::get('/acconting/data/customer/{pilihancustomer}', [AccountingController::class, 'GetData']);
        //Code Create
        Route::post('/code', [CodeController::class,'StoreCode'])->name('codeStore');
        //Test Contest
        Route::get('/resulttestcontest', [ResultTestContestController::class,'ResultTestIndex'])->name('resultcontest');
        Route::post('/resulttestcontest/viewaccount/{user_id_worker}', [ResultTestContestController::class, 'ViewAccount']);
        Route::post('/resulttestcontest/viewproject/{user_id_worker}', [ResultTestContestController::class, 'ViewProject']);
        Route::put('/resulttestcontest/updatetest/{user_id_worker}', [ResultTestContestController::class, 'UpdateTestContest']);
        Route::post('/resulttestcontest/delete/{resultTestContest}', [ResultTestContestController::class, 'DeleteResultTestContest']);
        //Management Admin
        Route::get('/managementadmin', [ManagementAdminController::class,'Admin'])->name('managementadmin');
        Route::post('/managementadmin/store', [ManagementAdminController::class,'AdminStore']);
        Route::post('/managementadmin/edit/{user}', [ManagementAdminController::class,'AdminEdit']);
        Route::post('/managementadmin/update/{user}', [ManagementAdminController::class,'AdminUpdate']);
        Route::delete('/managementadmin/delete/{user}', [ManagementAdminController::class,'AdminDelete']);
    });

    Route::middleware('admincustomer')->group(function () {
        //Contest
        Route::get('/contestproject', [ProjectController::class, 'IndexContestProject'])->name('contestproject');
        Route::post('/contestproject/store', [ProjectController::class, 'StoreContestProject']);
        //Direct
        Route::get('/directproject', [ProjectController::class, 'IndexDirectProject'])->name('directproject');
        Route::post('/directproject/store', [ProjectController::class, 'StoreDirectProject']);
        //Get Data
        Route::post('/getcubcatagories/{catagories}',[ProjectController::class,'GetCatagories']);
        //Get Discount Code
        Route::post('/code/getdata', [CodeController::class, 'GetDataCode']);
        //Eliminasi
        Route::put('/feedback/eliminasi/{resultcontest}', [FeedbackController::class, 'EliminasiPeserta']);
        Route::put('/feedbackbid/eliminasi/{resultproject}', [FeedbackBidController::class, 'EliminasiPeserta']);
        //Pick Winner
        Route::put('/feedback/choosewinner/pickwinner/{resultcontest}', [FeedbackController::class, 'StoreWinner']);
        Route::put('/feedbackbid/choosewinner/pickwinner/{resultproject}', [FeedbackBidController::class, 'StoreWinner']);
        //Get Data TotalCost
        Route::post('/getdatatotalcostupgrade', [DataTotalCostController::class, 'GetDataTotalCostUpgrade']);
        Route::post('/getdatatotalcostpack', [DataTotalCostController::class, 'GetDataTotalCostPack']);
        Route::post('/getdatatotalcostfreefee', [DataTotalCostController::class, 'GetDataTotalCostFreeFee']);
        //Brief Contest Action
        Route::delete('/deletecontest/{project}', [BriefProjectController::class, 'DeleteContest']);
        Route::put('/lockedcontest/{project}', [BriefProjectController::class, 'LockedContest']);
        Route::put('/extendeddeadlinecontest/{project}', [BriefProjectController::class, 'ExtendedContest']);
        //Brief Direct Action
        Route::delete('/deletedirect/{project}', [BriefProjectController::class, 'DeleteDirect']);
        Route::put('/lockeddirect/{project}', [BriefProjectController::class, 'LockedDirect']);
        Route::put('/extendeddeadlinedirect/{project}', [BriefProjectController::class, 'ExtendedDirect']);
        //HandoverConfirm
        Route::put('/handoverproject/confirm/{project}', [HandoverController::class, 'HandoverConfirm']);
    });

    Route::middleware('customer')->group(function () {
        //Customer
        //Nilai Rating
        Route::post('/feedback/show/nilaicontest/{resultcontest}', [FeedbackController::class, 'NilaiContest']);
        Route::post('/feedbackbid/show/nilaicontest/{resultproject}', [FeedbackBidController::class, 'NilaiContest']);
        //Profile
        Route::get('/customer/profile', [CustomerController::class, 'profileCustomers'])->name('profileCustomers');
        Route::put('/customer/profile/update/{customer}', [CustomerController::class, 'profileUpdate']);
        //Favourites
        Route::get('/favourites', [NewsFeedController::class,'Favourites'])->name('favourites');
        //Api Deadline
        Route::get('/deadline/{project}', [HomeController::class,'Deadline']);
        //Upload File
        Route::post('/fileuploadrevisi/store', [UploadFileController::class,'UploadfileRevisi']);
        Route::delete('/deletefileuploadrevisi/{uploadfile}', [UploadFileController::class,'DeleteFileUploadRevisi']);
        //Share Contest
        Route::post('/sharecontest/{project}', [ShareController::class,'ShareContest']);
    });

    Route::middleware('customerworker')->group(function () {
        //CustomerWorker
        //Feedback Contest
        Route::post('/feedback/kirim/{resultcontest}', [FeedbackController::class, 'KirimFeedback']);
        //Feedback Bid
        Route::post('/feedbackbid/kirim/{resultproject}', [FeedbackBidController::class, 'KirimFeedback']);
    });

    Route::middleware('worker')->group(function () {
        //Worker
        //Result Project
        Route::post('/resultdirect/store', [ResultProjectController::class, 'createSubmitDirect']);
        Route::post('/resultcontest/store', [ResultProjectController::class, 'createSubmitContest']);
        //Upload File
        Route::post('/fileupload/store', [UploadFileController::class,'Uploadfile']);
        Route::post('/fileupload/store/logotext/{winnercontest}', [HandoverController::class,'UploadLogoText']);
        Route::post('/fileupload/store/logo/{winnercontest}', [HandoverController::class,'UploadLogo']);
        Route::delete('/deletefileupload/{uploadfile}', [UploadFileController::class,'DeleteFileUpload']);
        //Update Font & Color
        Route::post('/updatefiles/{winnercontest}', [HandoverController::class,'UpdateFontColor']);
        Route::get('/updatefiles/delete/color/{id}', [HandoverController::class,'DeleteColor']);
        Route::get('/updatefiles/delete/font/{id}', [HandoverController::class,'DeleteFont']);
        //Profile
        Route::get('/worker/profile/setting', [WorkerController::class, 'profileWorkerSetting'])->name('profileWorkerSetting');
        Route::get('/worker/profile', [WorkerController::class,'profileWorker'])->name('profileWorker');
        Route::put('/worker/profile/showportfolio/{id}', [WorkerController::class,'showPortFolio']);
        Route::put('/worker/profile/hideportfolio/{id}', [WorkerController::class, 'hidePortFolio']);
        Route::put('/worker/setting/profile/update/{worker}', [WorkerController::class, 'profileUpdate']);
    });
});


