<?php
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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

//User Dashboard
Route::get('/dashboard', 'DashboardController@dashboard')->middleware('is_user');

//user Profile
Route::get('/myprofile', 'ProfileController@index');  //Profile
Route::put('store', 'ProfileController@store')->name('store');   //image update
Route::put('/update', 'ProfileController@update')->name('update'); // Edit profile
Route::post('/guarantor', 'ProfileController@Guarantor')->name('guarantor');   //Create loan
Route::put('storeDoc', 'ProfileController@storeDoc')->name('storeDoc');   //document update
Route::put('password', 'ProfileController@password')->name('password'); // Change Password

//user Loan
Route::get('/usercreateloan', 'CreateloanController@usercreateloan')->name('createloan')->middleware('is_user');;   //Create loan
Route::get('/calculateloan', 'CreateloanController@calculateloan')->name('calculateloan');
Route::post('submitloan', 'CreateloanController@submitloan')->name('submitloan'); //Submit Loan Application
Route::post('viewloan', 'LoanrecordsController@viewloan')->middleware('auth'); //View Created Loan
Route::post('calculate', 'CreateloanController@calculate'); //Create Loan Session
Route::get('loanrecords', 'LoanrecordsController@loanrecords')->middleware('is_user');  //Loan records
Route::get('/loanmanage', 'CreateloanController@manageloan')->middleware('is_user');
Route::post('DeleteLoan', 'CreateloanController@DeleteLoan')->name('DeleteLoan');//Deleting the Loan
Route::get('manageloan', 'LoanrecordsController@manageloan')->name('manageloan')->middleware('is_user'); //Manage Loan

//user Savings
Route::get('/createsavings', 'CreatesavingController@index')->middleware('is_user');  //Create Savings
Route::post('submitsaving', 'CreatesavingController@submitsaving')->name('submitsaving');//submit savings
Route::get('/savingsaccount', 'SavingsaccountController@savingsaccount')->middleware('is_user');   //Create Savings Account
Route::post('viewsavings', 'SavingsaccountController@viewsavings')->name('viewsavings');
Route::post('DeleteSavings', 'CreatesavingController@DeleteSavings')->name('DeleteSavings');//Delete the Savings
Route::put('/updatesavings', 'SavingsaccountController@updatesavings')->name('updatesavings')->middleware('auth'); // Edit Savings
Route::get('/viewsavings', 'SavingsaccountController@viewsavings')->middleware('auth');
Route::get('managesavings', 'SavingsaccountController@managesavings')->name('managesavings')->middleware('is_user');

//user Investment
Route::get('/createinvestment', 'CreateinvestmentController@index')->middleware('is_user'); //Create Investment
Route::post('calculateInvest', 'CreateinvestmentController@calculateInvest')->name('calculateInvest'); //Calculate Invest&Session
Route::post('submit', 'CreateinvestmentController@submitInvestment')->name('submit'); //Submit Investment
Route::post('viewinvestment', 'InvestmentorderController@viewinvestment')->middleware('auth');  //Investment Order
Route::get('/investmentorders', 'InvestmentorderController@investmentorder')->middleware('is_user'); //Investment Order
Route::post('DeleteInvestment', 'InvestmentorderController@DeleteInvestment')->name('DeleteInvestment');//Deleting the Savings
Route::put('/updateinvestment', 'InvestmentorderController@updateinvestment')->name('updateinvestment')->middleware('auth'); // Edit Savings
Route::get('manageinvestment', 'InvestmentorderController@manageinvestment')->name('manageinvestment')->middleware('is_user');

//Registration And Login
Route::post('/register', 'RegController@Registration')->name('Registration');   //Registration
Route::post('/adminregister', 'AdminRegController@adminRegistration')->name('adminregister');   //Registration
Route::get('/adminregister', 'AdminRegController@adminview');  // Display Page
Route::post('/login', 'LoginController@loginAdmin')->name('loginAdmin');   //Registration
Route::get('logout', '\App\Http\Controllers\Auth\LoginController@logout');  //Logout

//Admin
Route::get('/admindashboard', 'AdminController@index')->middleware('is_admin');  //Admin dashboard

//admin clients pages
Route::get('/clients', 'ClientsController@viewclients')->middleware('is_admin');
Route::get('/newclient', 'ClientsController@addnewclient')->middleware('is_admin');
Route::get('/groupclient', 'ClientsController@clientsgroup')->middleware('is_admin');
Route::get('/viewclientprofile', 'ClientsController@viewclientprofile')->name('clientprofile')->middleware('is_admin');
Route::post('/viewclientdetails', 'ClientsController@viewclientdetails')->middleware('is_admin');
Route::post('/adminGuarantor', 'ClientsController@adminGuarantor')->middleware('is_admin');
Route::get('/smsclients', 'ClientsController@smsclients')->middleware('is_admin');
Route::get('/emailclients', 'ClientsController@emailclients')->middleware('is_admin');
Route::post('/clientprofile', 'ClientsController@viewclientprofile')->name('viewclientprofile')->middleware('is_admin');
Route::post('adminstore', 'ClientsController@adminstore')->name('adminstore');   //document update for user
Route::post('AddnewUser', 'newClientController@AddnewUser')->name('AddnewUser');   //document update for user
Route::post('/showuserfields', 'ClientsController@showuserfields');
Route::get('/displayclients', 'SearchClientController@displayclients')->middleware('is_admin');
Route::post( '/updateclient','ClientsController@updateclientinfo');
Route::post( '/deleteclient','ClientsController@deleteclient');
Route::post( '/clearalltransac','ClientsController@clearalltransac');
Route::post('/send-email', 'MailController@send');
Route::post('/sendsinglemail', 'MailController@sendsingle');
Route::post( '/groupclient','clientGroupController@search');
Route::post( 'addtogroup','clientGroupController@addtogroup');
Route::post( 'addgroup','clientGroupController@addgroup');

//admin manageloan pages
Route::get('/loansetup', 'manageloanController@loansetup')->name('loansetup')->middleware('is_admin');
Route::post('/showproducts', 'manageloanController@showproducts')->name('showproducts');
Route::post('/showfields', 'manageloanController@showfields')->name('showfields');
Route::put('/updateloan', 'manageloanController@updateloan')->name('updateloan');// Admin  Edit Loan Setup
Route::post('/createloansetup', 'manageloanController@createloansetup');// Admin Add New Product
Route::post('/search', 'AdminCreateloanController@search');// Admin Add New loan
Route::post('/adminsubmitloan', 'AdminCreateloanController@adminsubmitloan');
Route::post('/searchform', 'AdminCreateloanController@searchform')->name('searchform');// Admin Add New loan
Route::get('/activateloan', 'AdminCreateloanController@activateloan')->name('admincreateloan')->middleware('is_admin');
Route::post('/calculator', 'AdminCreateloanController@calculator')->name('calculator');
Route::get('/loanapplications', 'AdminCreateloanController@loanapplications')->name('loanapplications')->middleware('is_admin');
Route::post('/ViewUserLoan', 'AdminCreateloanController@ViewUserLoan')->name('ViewUserLoan');
Route::put('/Editloan', 'AdminCreateloanController@Editloan');
Route::put('/Editloan2', 'AdminCreateloanController@Editloan2');
Route::put('/Updateloanref', 'AdminCreateloanController@Updateloanref');
Route::post('/GoToTransaction', 'AdminCreateloanController@GoToTransaction');
Route::get('/transaction', 'AdminCreateloanController@transaction')->name('transactionedit')->middleware('is_admin');
Route::post('DelLoan', 'AdminCreateloanController@DelLoan');//Deleting the Loan
Route::put('/ApproveLoan', 'AdminCreateloanController@ApproveLoan');
Route::put('/ConfirmProfee', 'AdminCreateloanController@ConfirmProfee');
Route::put('/ConfirmDisburse', 'AdminCreateloanController@ConfirmDisburse');
Route::put('/ReceivePayment', 'AdminCreateloanController@ReceivePayment');
Route::get('/loanmanaging', 'AdminCreateloanController@loanmanaging')->name('adminmanageloan')->middleware('is_admin');
Route::get('/loanapproved', 'AdminCreateloanController@loanapproved')->name('loanapproved')->middleware('is_admin');
Route::get('/loanprocessing', 'AdminCreateloanController@loanprocessing')->name('loanprocessing')->middleware('is_admin');
Route::get('/loandisbursed', 'AdminCreateloanController@loandisbursed')->name('loandisbursed')->middleware('is_admin');
Route::get('/loanterminated', 'AdminCreateloanController@loanterminated')->middleware('is_admin');
Route::get('/loantranches', 'AdminCreateloanController@loantranches')->middleware('is_admin');
Route::get('/repaymenttoday', 'AdminCreateloanController@repaymenttoday')->middleware('is_admin');

//admin managesavings pages
Route::get('/savingssetup', 'ManageSavingsController@viewmanagesavings')->middleware('is_admin');
Route::post( 'savingssetup','ManageSavingsController@savingsinformation');
Route::post( '/addnewsavingsproduct','ManageSavingsController@newProduct');
Route::post('/showsavingsfields', 'ManageSavingsController@showsavingsfields')->name('showsavingsfields');
Route::put('/updatesavings', 'ManageSavingsController@updatesavings')->name('updatesavings');// Admin  Edit savings Setup
//Route::get('/admincreatesavings', 'AdminCreateSavingsController@createsavings')->middleware('is_admin');
Route::get('/activatesavings', 'AdminCreateSavingsController@activatesavings')->name('admincreatesavings')->middleware('is_admin');
Route::post( '/searchsavings','AdminCreateSavingsController@searchsavings')->name('searchsavings');
Route::post( '/searchsavingsform','AdminCreateSavingsController@searchsavingsform')->name('searchsavingsform');
Route::post('/ViewUserSavings', 'AdminCreateSavingsController@ViewUserSavings')->name('ViewUserSavings');
Route::post('/submitsavings', 'AdminCreateSavingsController@submitsavings');
Route::get('/savingsmanaging', 'AdminCreateSavingsController@savingsmanaging')->name('adminmanagesavings')->middleware('is_admin');
Route::get('/inactivesavingsaccount', 'AdminCreateSavingsController@inactivesavings')->middleware('is_admin');
Route::post('/ViewSavingsDetails', 'AdminCreateSavingsController@ViewSavingsDetails')->name('ViewSavingsDetails');
Route::get('/adminsavingsaccount', 'AdminCreateSavingsController@adminsavingsaccount')->middleware('is_admin');
Route::get('/expiredsavingsaccount', 'AdminCreateSavingsController@expiredsavingsaccount')->middleware('is_admin');
Route::get('/savingsdeposits', 'AdminCreateSavingsController@savingsdeposits')->middleware('is_admin');
Route::post('/sessionmonth', 'AdminCreateSavingsController@getmy');
Route::post('DelSaving', 'AdminCreateSavingsController@DelSaving');//Deleting Savings
Route::put('EditSavings', 'AdminCreateSavingsController@EditSavings');//Edit Savings
Route::put('MakePayment', 'AdminCreateSavingsController@MakePayment');//Make Payment
Route::post('/SavingsPayment', 'AdminCreateSavingsController@SavingsPayment'); //Saving Payment
Route::put('Liquidate1', 'AdminCreateSavingsController@Liquidate1');//Complete Liquidation
Route::put('Liquidate2', 'AdminCreateSavingsController@Liquidate2');//Partial Liquidation

//admin manageinvestment pages
Route::get('/investmentsetup', 'ManageInvestmentController@viewmanageinvestment')->middleware('is_admin');
Route::post('investmentsetup','ManageInvestmentController@investmentinformation');
Route::post('/ViewInvestDetails', 'AdminCreateInvestmentController@ViewInvestDetails')->name('ViewInvestDetails');
Route::get('/investmentmanaging', 'AdminCreateInvestmentController@investmentmanaging')->name('adminmanageinv')->middleware('is_admin');
Route::post('Deleteinv', 'AdminCreateInvestmentController@Deleteinv');//Deleting Investment
Route::put('Approveinv', 'AdminCreateInvestmentController@Approveinv');//Approve Investment
Route::put('EditInv', 'AdminCreateInvestmentController@EditInv');//Edit Investment
Route::post('/MakeInvPayment', 'AdminCreateInvestmentController@MakeInvPayment'); //Investment Payment
Route::put('LiquidateInv1', 'AdminCreateInvestmentController@LiquidateInv1');//Complete Liquidation
Route::put('LiquidateInv2', 'AdminCreateInvestmentController@LiquidateInv2');//Partial Liquidation
Route::get('/activateinvestment', 'AdminCreateInvestmentController@activateinvestment')->name('admincreateinvestment')->middleware('is_admin');
Route::post('/addnewproduct','ManageInvestmentController@newProduct');
Route::post('/showinvestmentfields', 'ManageInvestmentController@showinvestmentfields')->name('showinvestmentfields');
Route::put('/updateinvestment', 'ManageInvestmentController@updateinvestment')->name('updateinvestment');
Route::get('/investmentorder', 'AdminCreateInvestmentController@viewinvestmentorder')->middleware('is_admin');
Route::post('/searchinvform', 'AdminCreateInvestmentController@searchform')->name('searchform');// Admin Add New loan
Route::post('/ViewUserInvestment', 'AdminCreateInvestmentController@ViewUserInvestment')->name('ViewUserInvestment');
Route::post('/calculateinv', 'AdminCreateInvestmentController@calculator')->name('calculateinv');
Route::post('/adminsubmitinvestment', 'AdminCreateInvestmentController@adminsubmitinvestment');
Route::get('/investmentpending', 'AdminCreateInvestmentController@investmentpending')->middleware('is_admin');
Route::get('/investmentexpired', 'AdminCreateInvestmentController@investmentexpired')->middleware('is_admin');
Route::get('/investmentdeposits', 'AdminCreateInvestmentController@invdeposits')->middleware('is_admin');
Route::get('/investmentactive', 'AdminCreateInvestmentController@activeinvestment')->middleware('is_admin');

//Manage Expenses
Route::get('/manageexpense', 'ManageexpensesController@manageexpense')->name('expenses')->middleware('is_admin');
Route::get('/expensesummary', 'ManageexpensesController@summary')->name('expensesummary')->middleware('is_admin');
Route::post('/addexpenses', 'ManageexpensesController@addexpenses');
Route::post('/addcategory', 'ManageexpensesController@addcategory');
Route::post('/sessionexpense', 'ManageexpensesController@getmy');
Route::post('/Details', 'ManageexpensesController@Details');
Route::post('/expense', 'ManageexpensesController@expense');
Route::put('/Updatedetails', 'ManageexpensesController@Updatedetails');
Route::post('/fetchyear', 'ManageexpensesController@fetchyear');

//financial reports
Route::get('/operationalcredit', 'FinancialReports@operationcredit')->middleware('is_admin');
Route::post('/getdetails', 'FinancialReports@getdetails')->middleware('is_admin');
Route::get('/operationaldebit', 'FinancialReports@operationdebit')->middleware('is_admin');
Route::get('/expectedrepayment', 'FinancialReports@expectedrepayment')->middleware('is_admin');
Route::post('/fetchyearr', 'FinancialReports@fetchyearr');
Route::get('/accountsummary', 'FinancialReports@accountsummary')->middleware('is_admin');
Route::get('/accountsummaryq', 'FinancialReports@accountsummaryq')->middleware('is_admin');
Route::post('/fetchmonth', 'FinancialReports@fetchmonth');
Route::get('/operationaltransaction', 'FinancialReports@operationaltransaction')->middleware('is_admin');
Route::post('/fetchtransact', 'FinancialReports@fetchtransact');

//System Setup
Route::get('/systemsetup', 'SystemSetupController@viewsystemsetup')->middleware('is_admin');
Route::post('/showsetup', 'SystemSetupController@showsetup')->middleware('is_admin');
Route::put('/updatesetup', 'SystemSetupController@update')->middleware('is_admin');
Route::get('/systemadmin', 'SystemSetupController@viewsystemadmin')->middleware('is_admin');
Route::get('/createadmin', 'SystemSetupController@addadmin')->middleware('is_admin');
Route::post('/manageadmin', 'SystemSetupController@manageadmin');
Route::put('/setpermission', 'SystemSetupController@systemP');
Route::post('/deleteadmin', 'SystemSetupController@deleteadmin');
Route::post('/addAdmin', 'SystemSetupController@addnewAdmin');
Route::post('/searchadmin', 'SystemSetupController@searchadmin');
Route::post('/sendsmstoallusers', 'SmsController@sendsms');


//Paystack
//Route::post('/pay', 'PaymentController@redirectToGateway')->name('pay');
Route::post('/linkcards', 'PayController@LinkNewCard');
//Route::get('/payment/callback', 'PaymentController@handleGatewayCallback');
Route::get('/paymentmethod', 'PaymentController@showcards')->middleware('is_user');
//Route::post('/getreadytopay', 'PaymentController@getAmount');

Route::post('/paynew', 'PayController@paywithpaystack')->name('paynew');
Route::post('/walletfunding', 'PayController@paywithpaystack');
Route::post('/repayloan', 'PayController@paywithpaystack');
Route::get('/payment/callback', 'PayController@handleGatewayCallback');
Route::post('/getreadytopay', 'PayController@getAmount');

//Route::post('/senduserloan', 'AdminPayController@paywithpaystack')->name('senduserloan');

Route::get('/staffs', 'StaffsController@viewstaffsetup')->middleware('is_admin');
Route::post('/searchstaffs', 'StaffsController@searchstaffs');
Route::post('/addstaffs', 'StaffsController@addStaffs');
Route::post('/reset', 'StaffsController@reset');
Route::get('/allstaffs', 'StaffsController@allstaffs')->middleware('is_admin');
Route::post('/managestaffs', 'StaffsController@managestaffs');
Route::post('/updatestaffdetails', 'StaffsController@update');
Route::post('/deletestaff', 'StaffsController@delete');
Route::post('/deactivatestaff', 'StaffsController@deactivate');
Route::post('/activatestaff', 'StaffsController@activate');
Route::post('/fetchpaydetails', 'StaffsController@fetchpaydetails');
Route::post('/forgotpassword', 'MailController@forgotpassword');
Route::get('/resetpassword/{userid}', 'forgotPasswordController@resetpage');
Route::post('/resetpass', 'forgotPasswordController@resetpassword');
Route::get('/userverification/{userid}', 'newClientController@verification');
Route::post('/userverify', 'newClientController@verify');
Route::post('/delcards', 'PayController@DelCard');
Route::get('/finreports', 'FinancialReports@reportssetup');
Route::post('/addfinreports', 'FinancialReports@addfinreport');
Route::post('/activatereport', 'FinancialReports@activatereport');
Route::post('/deactivatereport', 'FinancialReports@deactivatereport');
Route::post('/editreport', 'FinancialReports@editreport');
