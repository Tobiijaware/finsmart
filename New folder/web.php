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

//User
Route::get('/dashboard', 'DashboardController@dashboard')->middleware('is_user');
//Profile
Route::get('/myprofile', 'ProfileController@index')->middleware('is_user');  //Profile
Route::put('store', 'ProfileController@store')->name('store');   //image update
Route::put('/update', 'ProfileController@update')->name('update')->middleware('auth'); // Edit profile
Route::post('/guarantor', 'ProfileController@Guarantor')->name('guarantor');   //Create loan
Route::put('storeDoc', 'ProfileController@storeDoc')->name('storeDoc');   //document update
Route::put('password', 'ProfileController@password')->name('password'); // Change Password
//Loan
Route::get('/createloan', 'CreateloanController@createloan')->middleware('is_user');   //Create loan
Route::get('/calculateloan', 'CreateloanController@calculateloan')->name('calculateloan');
Route::post('submitloan', 'CreateloanController@submitloan')->name('submitloan'); //Submit Loan Application
Route::post('viewloan', 'LoanrecordsController@viewloan')->middleware('auth'); //View Created Loan 
Route::post('calculate', 'CreateloanController@calculate')->name('calculate'); //Create Loan Session
Route::get('loanrecords', 'LoanrecordsController@loanrecords')->middleware('is_user');  //Loan records
Route::get('/loanmanage', 'CreateloanController@manageloan')->middleware('is_user'); 
Route::post('DeleteLoan', 'CreateloanController@DeleteLoan')->name('DeleteLoan');//Deleting the Loan
Route::get('manageloan', 'LoanrecordsController@manageloan')->name('manageloan')->middleware('is_user'); //Manage Loan
//Savings 
Route::get('/createsavings', 'CreatesavingController@index')->middleware('is_user');  //Create Savings
Route::post('submitsavings', 'CreatesavingController@submitsavings')->name('submitsavings');  //submit savings
Route::get('/savingsaccount', 'SavingsaccountController@savingsaccount')->middleware('is_user');   //Create Savings Account
Route::post('viewsavings', 'SavingsaccountController@viewsavings')->name('viewsavings');
Route::post('DeleteSavings', 'CreatesavingController@DeleteSavings')->name('DeleteSavings');//Delete the Savings
Route::put('/updatesavings', 'SavingsaccountController@updatesavings')->name('updatesavings')->middleware('auth'); // Edit Savings
Route::get('/viewsavings', 'SavingsaccountController@viewsavings')->middleware('auth');
Route::get('managesavings', 'SavingsaccountController@managesavings')->name('managesavings')->middleware('is_user');
//Investment
Route::get('/createinvestment', 'CreateinvestmentController@index')->middleware('is_user'); //Create Investment
Route::post('calculateInvest', 'CreateinvestmentController@calculateInvest')->name('calculateInvest'); //Calculate Invest&Session
Route::post('submit', 'CreateinvestmentController@submitInvestment')->name('submit'); //Submit Investment
Route::post('viewinvestment', 'InvestmentorderController@viewinvestment')->middleware('auth');  //Investment Order
Route::get('/investmentorder', 'InvestmentorderController@investmentorder')->middleware('is_user'); //Investment Order
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
Route::get('/admin/dashboard', 'AdminController@index')->middleware('is_admin');  //Admin dashboard
//admin clients pages
Route::get('/clients', 'ClientsController@viewclients')->middleware('is_admin');  
Route::get('/newclient', 'ClientsController@addnewclient')->middleware('is_admin'); 
Route::get('/searchclient', 'ClientsController@searchclient');  
Route::get('/clientsgroup', 'ClientsController@clientsgroup');  
Route::get('/smsclients', 'ClientsController@smsclients'); 
Route::get('/emailclients', 'ClientsController@emailclients'); 
//admin manageloan pages
Route::get('/loansetup', 'manageloanController@loansetup')->name('loansetup')->middleware('is_admin');
Route::post('/showproducts', 'manageloanController@showproducts')->name('showproducts');  
Route::post('/showfields', 'manageloanController@showfields')->name('showfields');  
Route::put('/updateloan', 'manageloanController@updateloan')->name('updateloan');// Admin  Edit Loan Setup
Route::post('/createloansetup', 'manageloanController@createloansetup');// Admin Add New Product
Route::post('/search', 'SearchClientController@search')->name('search');// Admin Add New loan
Route::post('/searchform', 'AdminCreateloanController@searchform')->name('searchform');// Admin Add New loan
Route::get('/createloan', 'AdminCreateloanController@createloan')->middleware('is_admin');
Route::post('/calculator', 'AdminCreateloanController@calculator')->name('calculator');
Route::get('/loanapplications', 'AdminCreateloanController@loanapplications')->name('loanapplications')->middleware('is_admin');
Route::post('/ViewUserLoan', 'AdminCreateloanController@ViewUserLoan')->name('ViewUserLoan')->middleware('is_admin');
Route::get('/manageloan', 'AdminCreateloanController@manageloan')->middleware('is_admin'); 
Route::get('/loanapproved', 'AdminCreateloanController@loanapproved')->name('loanapproved')->middleware('is_admin'); 
Route::get('/loanprocessing', 'AdminCreateloanController@loanprocessing')->name('loanprocessing')->middleware('is_admin');  
Route::get('/loandisbursed', 'AdminCreateloanController@loandisbursed')->name('loandisbursed')->middleware('is_admin');    