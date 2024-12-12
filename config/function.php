<?php

function redirectToRoute($route){
    http_response_code(303);
    header("location: {$route}");
    exit;
}