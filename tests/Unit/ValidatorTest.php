<?php


use Core\Authenticator;

test('tests that validator validates correctly', function (){
   expect(\Core\Validator::string("mohanad"))->toBeTrue();
   expect(\Core\Validator::string(false))->toBeFalse();
   expect(\Core\Validator::string(""))->toBeFalse();

});

test('tests that validator validates correctly with a minimum length', function (){
    expect(\Core\Validator::string("mohanad", 20))->toBeTrue();

});

test('validates that the email is of a correct syntax', function (){
    expect(\Core\Validator::email("mohanad2001"))->toBeFalse();
    expect(\Core\Validator::email("mohanad2001@example.com"))->toBeTrue();


});

test("the login logic of a user", function (){
   $user = [
       'email' => "mohanad2001@example.com",
       'password' => "mohanad2001"
   ];
    session_start();
    (new Authenticator)->login($user);
   expect($_SESSION['user']['email'])->toEqual("mohanad2001@example.com");
});