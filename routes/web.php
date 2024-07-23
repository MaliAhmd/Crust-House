<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\KitchenController;
use App\Http\Controllers\OwnerController;
use App\Http\Controllers\SalesmanController;
use Illuminate\Support\Facades\Route;

/* 
|---------------------------------------------------------------|
|======================= Owner's Routes ========================|
|---------------------------------------------------------------|
*/

Route::get('/', function () {
    return view('index');
})->name('welcome');

Route::get('/login',[AuthController::class, 'loginIndex'])->name('viewLoginPage');
Route::get('/viewRegisterPage',[AuthController::class, 'registrationIndex'])->name('viewRegisterPage');

Route::post('/storeRegistrationData',[AuthController::class, 'register'])->name('storeRegistrationData');
Route::post('/login',[AuthController::class, 'login'])->name('login');
Route::get('/logout',[AuthController::class, 'logout'])->name('logout');

/*
|---------------------------------------------------------------|
|======================= Owner's Routes ========================|
|---------------------------------------------------------------|
*/ 

Route::get('/dashboard', [OwnerController::class, 'viewOwnerDashboard'])->name('dashboard');
Route::get('/branchDashboard/{branch_id}', [OwnerController::class, 'branchDashboard'])->name('branchDashboard');
Route::get('/showReports', [OwnerController::class, 'viewReports'])->name('showReports');
Route::get('/viewReportPage/{branch_id}', [OwnerController::class, 'viewReportPage'])->name('viewReportPage');

/*
|---------------------------------------------------------------|
|======================= Branch Routes =========================|
|---------------------------------------------------------------|
*/ 

Route::get('/branches', [OwnerController::class, 'viewBranches'])->name('branches');
Route::post('/storeNewBranchData',[OwnerController::class,'newBranch'])->name('storeNewBranchData'); 
Route::get('/deleteBranch/{branch_id}', [OwnerController::class, 'deleteBranch'])->name('deleteBranch');
Route::post('/updateBranches', [OwnerController::class, 'updateBranches'])->name('updateBranches');

/*
|---------------------------------------------------------------|
|========================= Staff Routes ========================|
|---------------------------------------------------------------|
*/ 

Route::get('/mystaff', [OwnerController::class, 'viewAddStaff'])->name('staff');
Route::post('/updateStaffData', [OwnerController::class,'updateStaffData'])->name('updateStaffData');
Route::get('/deleteStaffData/{id}', [OwnerController::class,'deleteStaffData'])->name('deleteStaffData');



Route::post('/addNewUser',[OwnerController::class,'newUser'])->name('addNewUser'); 
Route::get('/addnewbranch', [OwnerController ::class, 'addNewBranchIndex'])->name('addNewBranch');
Route::get('/addnewbranch1', function() { return view('Owner.AddNewBranch1'); });
Route::get('/addnewbranch2', function(){ return view('Owner.AddNewBranch2'); });
Route::get('/addnewbranch3', function(){ return view('Owner.AddNewBranch3'); });
Route::get('/onlineorders', function(){ return view('Owner.OnlineOrder'); })->name('onlineorders');
Route::get('/diningtable', function(){ return view('Owner.DiningTable'); })->name('diningtable');


/*
|---------------------------------------------------------------|
|======================= Admin's Routes ========================|
|---------------------------------------------------------------|
*/

Route::get('/admindashboard/{id}/{branch_id}',[AdminController::class,'viewAdminDashboard'])->name('admindashboard');
Route::get('/readNotification/{user_id}/{branch_id}/{id}',[AdminController::class,'readNotification'])->name('readNotification');
Route::get('/deleteNotification/{user_id}/{branch_id}/{id}',[AdminController::class,'deleteNotification'])->name('deleteNotification');
Route::get('/redirectNotification/{user_id}/{branch_id}/{id}',[AdminController::class,'redirectNotification'])->name('redirectNotification');

/*
|---------------------------------------------------------------|
|======================= Categories Routes =====================|
|---------------------------------------------------------------|
*/

Route::get('/viewCategoryPage/{id}/{branch_id}',[AdminController::class,'viewCategoryPage'])->name('viewCategoryPage');
Route::post('/createCategory',[AdminController::class,'createCategory'])->name('createCategory');
Route::post('/updateCategory',[AdminController::class,'updateCategory'])->name('updateCategory');
Route::get('/deleteCategory/{id}',[AdminController::class,'deleteCategory'])->name('deleteCategory');

/*
|---------------------------------------------------------------|
|======================= Products Routes =======================|
|---------------------------------------------------------------|
*/

Route::get('/viewProductPage/{id}/{branch_id}', [AdminController::class,'viewProductPage'])->name('viewProductPage');
Route::post('/createProduct', [AdminController::class,'createProduct'])->name('createProduct');
Route::post('/updateProduct',[AdminController::class,'updateProduct'])->name('updateProduct');
Route::get('/deleteProduct/{id}',[AdminController::class,'deleteProduct'])->name('deleteProduct');

/*
|---------------------------------------------------------------|
|========================== Deals Routes =======================|
|---------------------------------------------------------------|
*/

Route::get('/viewDealPage/{id}/{branch_id}', [AdminController::class,'viewDealPage'])->name('viewDealPage');
Route::post('/createDeal', [AdminController::class,'createDeal'])->name('createDeal');
Route::get('/viewDealProductsPage/{branch_id}', [AdminController::class,'viewDealProductsPage'])->name('viewDealProductsPage');
Route::post('/createDealProducts', [AdminController::class,'createDealProducts'])->name('createDealProducts');
Route::post('/updateDeal',[AdminController::class,'updateDeal'])->name('updateDeal');
Route::get('/viewUpdateDealProductsPage/{id}/{branch_id}', [AdminController::class,'viewUpdateDealProductsPage'])->name('viewUpdateDealProductsPage');
Route::post('/addDealProduct',[AdminController::class,'addDealProduct'])->name('addDealProduct');
Route::get('/deleteDeal/{id}',[AdminController::class,'deleteDeal'])->name('deleteDeal');
Route::get('/deleteDealProduct/{id}/{dId}/{user_id}/{branch_id}',[AdminController::class,'deleteDealProduct'])->name('deleteDealProduct');

/*
|---------------------------------------------------------------|
|========================= Stock Routes ========================|
|---------------------------------------------------------------|
*/

Route::get('/viewStockPage/{id}/{branch_id}', [AdminController::class,'viewStockPage'])->name('viewStockPage');
Route::post('/createStock', [AdminController::class,'createStock'])->name('createStock');
Route::post('/updateStock',[AdminController::class,'updateStock'])->name('updateStock');
Route::get('/deleteStock/{id}',[AdminController::class,'deleteStock'])->name('deleteStock');
Route::get('/viewStockHistory/{branch_id}',[AdminController::class,'stockHistory'])->name('viewStockHistory');

/*
|---------------------------------------------------------------|
|========================= Recipe Routes =======================|
|---------------------------------------------------------------|
*/

Route::get('/viewRecipePage/{id}/{branch_id}', [AdminController::class,'viewRecipePage'])->name('viewRecipePage');
Route::post('/createRecipe', [AdminController::class,'createRecipe'])->name('createRecipe');
Route::post('/editProductRecipe', [AdminController::class,'editProductRecipe'])->name('editProductRecipe');
Route::get('/viewProductRecipe/{category_id}/{product_id}/{user_id}/{branch_id}', [AdminController::class,'viewProductRecipe'])->name('viewProductRecipe');
Route::get('/deleteStockFromRecipe/{id}/{cid}/{pId}', [AdminController::class, 'deleteStockFromRecipe'])->name('deleteStockFromRecipe');
Route::get('/showCategoryProducts/{category_id}/{branch_id}/{user_id}', [AdminController::class, 'showCategoryProducts'])->name('showCategoryProducts');

/*
|---------------------------------------------------------------|
|==================== Orders And Staff Routes ==================|
|---------------------------------------------------------------|
*/
 
Route::get('/viewOrdersPage/{id}/{branch_id}', [AdminController::class,'viewOrdersPage'])->name('viewOrdersPage');
Route::get('/viewOrderProducts/{order_id}', [AdminController::class,'viewOrderProducts'])->name('viewOrderProducts');
Route::get('/printrecipt/{order_id}', [AdminController::class,'printRecipt'])->name('printrecipt');
Route::get('/cancelorder/{order_id}', [AdminController::class,'cancelOrder'])->name('cancelorder');

Route::get('/viewStaffPage/{id}/{branch_id}', [AdminController::class,'viewStaffPage'])->name('viewStaffPage');
Route::post('/updateStaff', [AdminController::class,'updateStaff'])->name('updateStaff');
Route::get('/deleteStaff/{id}', [AdminController::class,'deleteStaff'])->name('deleteStaff');

Route::get('/download-pdf/{filename}', [SalesmanController::class, 'downloadPdf'])->name('downloadPdf');

/*
|---------------------------------------------------------------|
|======================= Settings Routes =======================|
|---------------------------------------------------------------|
*/

Route::get('/viewSettingsPage/{id}/{branch_id}', [AdminController::class,'viewSettingsPage'])->name('viewSettingsPage');

Route::post('/createTax', [AdminController::class,'createTax'])->name('createTax');
Route::post('/updateTax', [AdminController::class,'updateTax'])->name('updateTax');
Route::get('/deleteTax/{id}', [AdminController::class,'deleteTax'])->name('deleteTax');

Route::post('/createDiscount', [AdminController::class,'createDiscount'])->name('createDiscount');
Route::post('/updateDiscount', [AdminController::class,'updateDiscount'])->name('updateDiscount');
Route::get('/deleteDiscount/{id}', [AdminController::class,'deleteDiscount'])->name('deleteDiscount');

Route::post('/createReceipt', [AdminController::class,'createReceipt'])->name('createReceipt');
Route::post('/updateReceipt', [AdminController::class,'updateReceipt'])->name('updateReceipt');
Route::get('/deleteReceipt/{id}', [AdminController::class,'deleteReceipt'])->name('deleteReceipt');

/*
|---------------------------------------------------------------|
|======================= Reports Routes ========================|
|---------------------------------------------------------------|
*/ 

Route::get('/report/{branch_id}', [AdminController::class,'viewReportPage'])->name('report');
Route::get('/todayTotalSales/{branch_id}', [AdminController::class,'todayTotalSales'])->name('todayTotalSales');

Route::post('/dayFullTransactionReport', [AdminController::class,'dayFullTransactionReport'])->name('dayFullTransactionReport');
Route::get('/printDailyReport/{branch_id}/{salesman_id}/{selectedDate}', [AdminController::class, 'printDailyFullTransactionReport'])->name('printDailyReport');

Route::post('/salesAssistantTotalSalesReport', [AdminController::class,'salesAssistantTotalSalesReport'])->name('salesAssistantTotalSalesReport');
Route::get('/printSalesReport/{branch_id}/{start_date}/{end_date}', [AdminController::class, 'printSalesReport'])->name('printSalesReport');

Route::post('/tillReconcilationFigureByDate', [AdminController::class,'tillReconcilationFigureByDate'])->name('tillReconcilationFigureByDate');
Route::get('/printSalesmanReconcilationReport/{branch_id}/{start_date}/{end_date}/{salesman_id}', [AdminController::class, 'printSalesmanReconcilationReport'])->name('printSalesmanReconcilationReport');

Route::post('/soldProductsReport', [AdminController::class,'soldProductsReport'])->name('soldProductsReport');
Route::get('/printSoldProductsReport/{branch_id}/{start_date}/{end_date}', [AdminController::class, 'printSoldProductsReport'])->name('printSoldProductsReport');

Route::get('/stockHistoryReport/{branch_id}', [AdminController::class,'stockHistoryReport'])->name('stockHistoryReport');

Route::post('/productsRefundReport', [AdminController::class,'productsRefundReport'])->name('productsRefundReport');
Route::get('/printProductsRefundReport/{branch_id}/{start_date}/{end_date}', [AdminController::class, 'printProductsRefundReport'])->name('printProductsRefundReport');

Route::post('/refundReport', [AdminController::class,'refundReport'])->name('refundReport');
Route::get('/printRefundReport/{branch_id}/{start_date}/{end_date}', [AdminController::class, 'printRefundReport'])->name('printRefundReport');

Route::post('/taxReportByDate', [AdminController::class,'taxReportByDate'])->name('taxReportByDate');
Route::get('/printTaxReportByDate/{branch_id}/{start_date}/{end_date}', [AdminController::class, 'printTaxReportByDate'])->name('printTaxReportByDate');

Route::post('/dailyTransactionTaxReport', [AdminController::class,'dailyTransactionTaxReport'])->name('dailyTransactionTaxReport');
Route::get('/printDailyTransactionTaxReport/{branch_id}/{start_date}/{end_date}', [AdminController::class, 'printDailyTransactionTaxReport'])->name('printDailyTransactionTaxReport');

Route::post('/salesmanTaxReportByDate', [AdminController::class,'salesmanTaxReportByDate'])->name('salesmanTaxReportByDate');
Route::get('/printSalesmanTaxReportByDate/{branch_id}/{salesman_id}/{transaction_date}', [AdminController::class, 'printSalesmanTaxReportByDate'])->name('printSalesmanTaxReportByDate');

Route::post('/salesAndDiscountReportByDate', [AdminController::class,'salesAndDiscountReportByDate'])->name('salesAndDiscountReportByDate');
Route::get('/printSalesAndDiscountReportByDate/{branch_id}/{salesman_id}/{transaction_date}', [AdminController::class, 'printSalesAndDiscountReportByDate'])->name('printSalesAndDiscountReportByDate');

Route::get('/deleteReportPDF/{file_name}', [AdminController::class, 'deleteReportPDF'])->name('deleteReportPDF');

/*
|---------------------------------------------------------------|
|==================== Sales Man Routes =========================|
|---------------------------------------------------------------|
*/
 
Route::get('salesman/dashboard/{id}/{branch_id}', [SalesmanController::class,'viewSalesmanDashboard'])->name('salesman_dashboard');
Route::get('salesman/dashboard/{categoryName}/{id}/{branch_id}', [SalesmanController::class,'salesmanCategoryDashboard'])->name('salesman_dash');
Route::get('salesman/deals/', [SalesmanController::class,'deals'])->name('deals');
Route::post('salesman/placeOrder/{salesman_id}', [SalesmanController::class,'placeOrder'])->name('placeOrder');
Route::post('salesman/saveToCart', [SalesmanController::class,'saveToCart'])->name('saveToCart');
Route::get('salesman/clearCart/{salesman_id}', [SalesmanController::class,'clearCart'])->name('clearCart');
Route::get('salesman/removeOneProduct/{id}/{salesman_id}/{branch_id}', [SalesmanController::class,'removeOneProduct'])->name('removeOneProduct');
Route::get('salesman/increaseQuantity/{id}/{salesman_id}/{branch_id}', [SalesmanController::class,'increaseQuantity'])->name('increaseQuantity');
Route::get('salesman/decreaseQuantity/{id}/{salesman_id}/{branch_id}', [SalesmanController::class,'decreaseQuantity'])->name('decreaseQuantity');
Route::get('salesman/deleteReceiptPDF/{file_name}', [SalesmanController::class,'deleteReceiptPDF'])->name('deleteReceiptPDF');

/*
|---------------------------------------------------------------|
|====================== Kitchen Routes =========================|
|---------------------------------------------------------------|
*/

Route::get('chef/dashboard/{user_id}/{branch_id}',[KitchenController::class,'viewChefDashboard'])->name('chef_dashboard');
Route::get('chef/orderComplete/{order_id}',[KitchenController::class,'orderComplete'])->name('orderComplete');
Route::get('chef/printChefRecipt/{order_id}',[KitchenController::class,'printChefRecipt'])->name('printChefRecipt');