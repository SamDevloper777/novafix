<?php

use App\Http\Controllers\FranchiseController;
use App\Http\Controllers\ReceptionerController;
use App\Http\Controllers\RequestController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\SuperAdminController;
use Illuminate\Support\Facades\Storage; //This is for image upload, 


Route::controller(HomeController::class)->group(function () {
    Route::get('/', 'index')->name('home');
    Route::match(['get','post'],'/contact', 'contactUs')->name('home.contact');
    Route::get('/learn', 'learn')->name('home.learn');
    Route::get('/warranty', 'warranty')->name('home.warranty');
    Route::get('/privacyPolicy', 'privacyPolicy')->name('home.privacyPolicy');
    Route::get('/ourTeam', 'ourTeam')->name('home.ourTeam');
    Route::get('/termsAndCondition', 'termsAndCondition')->name('home.termsAndCondition');
    Route::get('/reciving/pdf/{id}', 'reciptPdf')->name('receipt.pdf');
    Route::get('/reciving/{id}', 'reciving')->name('receipt.view');
    Route::get('/view', 'view')->name('home.view');

    // Route::get('/trackRequest', 'trackStatus')->name('track.status');
    // new req
   
});


Route::controller(RequestController::class)->group(function () {
 
    Route::get('/requestForm','requestForm')->name('request.form');
    Route::post( '/requestForm', 'requestCreate')->name('request.create');
    Route::match(["post", "get"],'/trackRequest', 'trackStatus')->name('track.status');
    
});


// Route::prefix("admin")->group(function () {
//     // Route::controller(controller: AdminController::class)->group(function () {
//         //without auth middleware
//         Route::match(["post", "get"], '/login', action: 'adminlogin')->name('admin.login');

//         // routes with middleware
//         Route::middleware('auth:admin')->group(function () {
//             Route::get('/', 'index')->name('admin.panel');
//             Route::get("/staff/manage","manageStaff")->name("admin.staff.manage");
//             Route::get("/staff/create","insertStaff")->name("admin.staff.create");
           
      
//             Route::post("/staff/create","staffUpload")->name("admin.staff.store");
//             Route::get("/staff/delete/{id}","delete")->name("admin.staff.delete");
//             Route::get("/staff/Crmdelete/{id}","crmDelete")->name("admin.crm.delete");
//             Route::get("/staff/edit/{id}","editStaff")->name('admin.staff.edit');
//             Route::get("/staff/view/{id}","viewStaff")->name('admin.staff.view');
//             Route::post("/staff/update/{id}","update")->name('admin.staff.update');
            
//             Route::get('/logout', 'adminlogout')->name('admin.logout');
//             Route::get('/staff/search',"search")->name('admin.staff.search');
//             Route::get('/request/search',"searchRequest")->name(' ');
//             Route::get('/staff/status/{staff}',"status")->name('admin.staff.status');
//             Route::get("/staff/newRequest","allnewRequest")->name("admin.newRequest.manage");
//             Route::get("/request/delete/{id}","deleteRequest")->name("admin.request.delete");
//             Route::get("/request/manage","manageRequest")->name("admin.request.manageRequest");
//             Route::get("/request/filter","filterRequest")->name("admin.request.filterRequest");
//             Route::get("/request/datefilter","dateFilter")->name("admin.request.filterbydate");
//             Route::get("/request/filterbyselect","filterBySelect")->name("admin.request.filterbyselect");
//             Route::get("/request/filterbyinput","filterByInput")->name("admin.request.filterbyinput");
//             Route::get('/request/global/search/', 'globalSearch')->name('admin.request.globalSearch');
//             //show
            
//         Route::get('/listRequest/confirm','confirmedRequest')->name('admin.confirmed.req');
//         Route::get('/listRequest/pending','pendingRequest')->name('admin.pending.req');
//         Route::get('/listRequest/rejected','rejectedRequest')->name('admin.rejected.req');
//         Route::get('/listRequest/workDone','workDoneRequests')->name('admin.workDone.req');
//         Route::get('/listRequest/delivered','deliveredRequest')->name('admin.delivered.req');
//         Route::get('/listRequest/messages','messages')->name('admin.messages.req');
//         Route::get('/listRequest/{id}/readmessages','messagesRead')->name('admin.messagesRead.req');

//          // filter 
//          Route::get("/request/datefilter","dateFilter")->name("admin.request.filterbydate");
//          Route::get("/request/filterbyselect","filterBySelect")->name("admin.request.filterbyselect");
//          Route::get("/request/filterbyinput","filterByInput")->name("admin.request.filterbyinput");

//             Route::get('/Allreceptioner',[ReceptionerController::class, 'showAllreceptioner'])->name('receptioner.showAllreceptioner');
//             Route::match(['post','get'],'/AddReceptioner',[ReceptionerController::class,"AddReceptioner"])->name('receptioner.add');
//             Route::get('/EditReceptioner/{id}',[ReceptionerController::class,"EditReceptioner"])->name('receptioner.edit');
//             Route::post('/UpdateReceptioner/{id}',[ReceptionerController::class,"UpdateReceptioner"])->name('receptioner.update');
//             Route::get('/status/{receptioner}',[ReceptionerController::class,"status"])->name('receptioner.status');
//         });
//     });
// });
Route::prefix("staff")->group(function () {
    Route::controller(StaffController::class)->group(function () {
        // without auth middleware 
        Route::match(["post", "get"], '/login', 'stafflogin')->name('staff.login');

        // with middle staff login required
        Route::middleware("auth:staff")->group(function () {
            Route::get('/request/all', [RequestController::class,'allRequests'])->name('request.all');
            Route::get('/request/new', [RequestController::class,'newRequests'])->name('request.new');
            Route::get('/request/{id}/confirm', [RequestController::class,'confirmRequest'])->name('request.confirm');
            Route::get('/request/{id}/edit', [RequestController::class,'requestEdit'])->name('request.edit');
            Route::get('/request/{id}/deliver', [RequestController::class,'requestDeliver'])->name('request.Deliver');
            Route::post('/request/update/{id}', [RequestController::class,'requestUpdate'])->name('request.update');
            Route::get('/request/{id}/reject', [RequestController::class,'rejected'])->name('request.reject');
            Route::get('/request/rejectedRequests', [RequestController::class,'rejectedRequests'])->name('request.show.reject');
            Route::get('/request/deliveredRequests', [RequestController::class,'showDelivered'])->name('request.show.delivered');
            Route::get('/request/WorkProgressRequest', [RequestController::class,'showWorkprogress'])->name('request.show.workProgress');
            Route::get('/request/{id}/pending', [RequestController::class,'pending'])->name('request.pending');
            Route::get('/request/{id}/workProgress', [RequestController::class,'workProgressRequest'])->name('request.workProgress');
            Route::get('/request/{id}/deassemble', [RequestController::class,'deassemble'])->name('request.deassemble');
            Route::get('/request/{id}/repair', [RequestController::class,'repair'])->name('request.repair');
            Route::get('/request/{id}/assemble', [RequestController::class,'assemble'])->name('request.assemble');
            Route::get('/request/{id}/workDone', [RequestController::class,'workDone'])->name('request.workDone');
            Route::get('/request/pendingRequests', [RequestController::class,'pendingRequests'])->name('request.show.pending');
            Route::get('/request/workDone', [RequestController::class,'workDoneRequests'])->name('request.show.workDone');
            Route::get("/request/datefilter",[RequestController::class,"dateFilter"])->name("staff.request.filterbydate");
            Route::get("/request/filterbyselect",[RequestController::class,"filterBySelect"])->name("staff.request.filterbyselect");
            Route::get("/request/filterbyinput",[RequestController::class,"filterByInput"])->name("staff.request.filterbyinput");
            Route::get('/request/global/search/', 'globalSearch')->name('staff.request.globalSearch');

            Route::get('/', 'index')->name('staff.panel');
            Route::get('/logout', 'stafflogout')->name('staff.logout');
                
        });
    });
});
Route::prefix("crm")->group(function(){
   Route::controller(ReceptionerController::class)->group(function(){
       // without auth middleware 
       Route::match(["post", "get"], '/login', 'receptionerlogin')->name('receptioner.login');
    // with middle receptioner login required
       Route::middleware('auth:receptioner')->group(function(){
        Route::get('/', 'index')->name('receptioner.panel');
        Route::get('/listRequest', 'allnewRequest')->name('receptioner.all.request');
        Route::get('/listRequest/view/{id}', 'viewRequest')->name('receptioner.viewRequest');

        Route::get('/listRequest/confirm','confirmedRequest')->name('crm.confirmed.req');
        Route::get('/listRequest/pending','pendingRequest')->name('crm.pending.req');
        Route::get('/listRequest/rejected','rejectedRequest')->name('crm.rejected.req');
        Route::get('/listRequest/workDone','workDoneRequests')->name('crm.workDone.req');
        Route::get('/listRequest/delivered','deliveredRequest')->name('crm.delivered.req');
        Route::get('/listRequest/all','allRequest')->name('crm.all.req');

        Route::match(['post','get'],'/EditRequest/{id}', 'editRequest')->name('receptioner.request.edit');
        Route::match(['post','get'],'/receptionerRequestForm', 'requestForm')->name('receptioner.request.form');
        Route::get('/request/global/search/', [RequestController::class,'globalSearch'])->name('request.globalSearch');
        Route::get('/request/Deliver/{id}', [RequestController::class,'requestDeliver'])->name('crm.request.deliver');
        // filter 
        Route::get("/request/datefilter","dateFilter")->name("receptioner.request.filterbydate");
        Route::get("/request/filterbyselect","filterBySelect")->name("receptioner.request.filterbyselect");
        Route::get("/request/filterbyinput","filterByInput")->name("receptioner.request.filterbyinput");
        Route::get('/logout', 'receptionerlogout')->name('receptioner.logout');
       });
   });
});
Route::prefix('superadmin')->group(function () {
    Route::controller(SuperAdminController::class)->group(function () {
        Route::get('/', 'dashboard')->name('superadmin.panel');
        Route::get("/staff/manage","manageStaff")->name("franchise.staff.manage");

    });
});

Route::prefix('franchise')->group(function () {
    Route::controller(FranchiseController::class)->group(function () {
        Route::match(["post", "get"], '/login', action: 'franchiseLogin')->name('franchise.login');
        Route::middleware('auth:franchise')->group(function(){
            Route::get('/', 'index')->name('franchise.panel');
           Route::get("/staff/create","insertStaff")->name("franchise.staff.create");
            Route::post("/staff/create","staffUpload")->name("franchise.staff.store");
            Route::get("/staff/delete/{id}","delete")->name("franchise.staff.delete");
            Route::get("/staff/Crmdelete/{id}","crmDelete")->name("franchise.crm.delete");
            Route::get("/staff/edit/{id}","editStaff")->name('franchise.staff.edit');
            Route::get("/staff/view/{id}","viewStaff")->name('franchise.staff.view');
            Route::post("/staff/update/{id}","update")->name('franchise.staff.update');
            Route::get('/logout', 'franchiselogout')->name('franchise.logout');

            Route::get('/staff/search',"search")->name('franchise.staff.search');
            Route::get('/request/search',"searchRequest")->name(' ');
            Route::get('/staff/status/{staff}',"status")->name('franchise.staff.status');
            Route::get("/staff/newRequest","allnewRequest")->name("franchise.newRequest.manage");
            Route::get("/request/delete/{id}","deleteRequest")->name("franchise.request.delete");
            Route::get("/request/manage","manageRequest")->name("franchise.request.manageRequest");
            Route::get("/request/filter","filterRequest")->name("franchise.request.filterRequest");
            Route::get("/request/datefilter","dateFilter")->name("franchise.request.filterbydate");
            Route::get("/request/filterbyselect","filterBySelect")->name("franchise.request.filterbyselect");
            Route::get("/request/filterbyinput","filterByInput")->name("franchise.request.filterbyinput");
            Route::get('/request/global/search/', 'globalSearch')->name('franchise.request.globalSearch');
          //show
            
        Route::get('/listRequest/confirm','confirmedRequest')->name('franchise.confirmed.req');
        Route::get('/listRequest/pending','pendingRequest')->name('franchise.pending.req');
        Route::get('/listRequest/rejected','rejectedRequest')->name('franchise.rejected.req');
        Route::get('/listRequest/workDone','workDoneRequests')->name('franchise.workDone.req');
        Route::get('/listRequest/delivered','deliveredRequest')->name('franchise.delivered.req');
        Route::get('/listRequest/messages','messages')->name('franchise.messages.req');
        Route::get('/listRequest/{id}/readmessages','messagesRead')->name('franchise.messagesRead.req');

//          // filter 
         Route::get("/request/datefilter","dateFilter")->name("franchise.request.filterbydate");
         Route::get("/request/filterbyselect","filterBySelect")->name("franchise.request.filterbyselect");
         Route::get("/request/filterbyinput","filterByInput")->name("franchise.request.filterbyinput");

            Route::get('/Allreceptioner',[ReceptionerController::class, 'showAllreceptioner'])->name('receptioner.showAllreceptioner');
            Route::match(['post','get'],'/AddReceptioner',[ReceptionerController::class,"AddReceptioner"])->name('receptioner.add');
            Route::get('/EditReceptioner/{id}',[ReceptionerController::class,"EditReceptioner"])->name('receptioner.edit');
            Route::post('/UpdateReceptioner/{id}',[ReceptionerController::class,"UpdateReceptioner"])->name('receptioner.update');
            Route::get('/status/{receptioner}',[ReceptionerController::class,"status"])->name('receptioner.status');
        });

        Route::get('/insert-franchises', 'insertFranchises')->name('franchises.insertFranchises');
        Route::get('/manage-franchises', 'manageFranchises')->name('franchises.manageFranchises');
        Route::post('/store-franchises', 'storeFranchises')->name('franchises.store');
        Route::delete('/franchises/{id}', 'deleteFranchises')->name('franchises.delete');
        Route::get('/edit-franchises/{id}', 'editFranchises')->name('franchises.edit');
        Route::put('/update-franchises/{id}', 'updateFranchises')->name('franchises.update');
        Route::get('/view-franchises/{id}', 'viewFranchises')->name('franchises.view');
        Route::get('/Allreceptioner',[ReceptionerController::class, 'showAllreceptioner'])->name('receptioner.showAllreceptioner');
        Route::match(['post','get'],'/AddReceptioner',[ReceptionerController::class,"AddReceptioner"])->name('receptioner.add');
        Route::get('/EditReceptioner/{id}',[ReceptionerController::class,"EditReceptioner"])->name('receptioner.edit');
        Route::post('/UpdateReceptioner/{id}',[ReceptionerController::class,"UpdateReceptioner"])->name('receptioner.update');
        Route::get('/status/{receptioner}',[ReceptionerController::class,"status"])->name('receptioner.status');

        });
});
