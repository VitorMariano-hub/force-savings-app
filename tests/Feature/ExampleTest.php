<?php
 
use function Pest\Laravel\getJson;

it('shoul return status code 200', function () {
    getJson('/users', [
        'Accept' => 'application/json',
    ])->assertStatus(200);

});
