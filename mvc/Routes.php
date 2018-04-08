<?php

Route::set('index.php', function() {
    Index::CreateView('Index');
});

Route::set('about-us', function() {
    AboutUs::CreateView('AboutUs');
   // AboutUs::test();
    AboutUs::printUsers();
});

Route::set('contact-us', function() {
    ContactUs::CreateView('ContactUs');
});

Route::set('test', function() {
    echo "test";
});

// Adding new user
Route::set('user', function() {
    UserImpl::listUsers();
    //User::addUser();
});

Route::set('addUser', function() {
    //User::listUsers();
    UserImpl::CreateView('AddUser');
    //User::addUser();
});

Route::set('newUser', function() {
    //User::listUsers();
    //$_POST["userName"];

    //This method prints extra confirmation
UserImpl::addUser($_POST["userName"], $_POST["password"], $_POST["role"]);
    UserImpl::CreateView('newUser');
});

// Adding new work order

Route::set('addWorkorder', function() {

    WorkorderImpl::CreateView('AddWorkorder');

});
Route::set('newWorkorder', function() {

    WorkorderImpl::addWorkorder($_POST["description"], $_POST["estimate"], $_POST["location"], $_POST["received"], $_POST["scheduled"], $_POST["compleated"], $_POST["location_id"]);

    WorkorderImpl::CreateView('newWorkorder');
});

// Display all work orders

Route::set('listWorkorders', function() {

    WorkorderImpl::CreateView('ShowWorkorders');

});

// Basic authentication
Route::set('login', function() {

    LoginImpl::CreateView('LoginView');

});

// Authorization
Route::set('loginAuth', function() {

    LoginImpl::loginAuth($_POST["userName"], $_POST["password"]);

});

// Log out
Route::set('logout', function() {

    LoginImpl::logoutSession();

});

// Test authentication
Route::set('loginTest', function() {

    //LoginImpl::loginTest();
    LoginImpl::CreateView('session_test');


});

// Dashboard
Route::set('dashboard', function() {

    LoginImpl::CreateView('Dashboard');

});














?>
