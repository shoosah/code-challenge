<?php

namespace App\Http\Controllers\Pages;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use GuzzleHttp\Client as GuzzleClient;
use GuzzleHttp\Exception\RequestException as GuzzleRequestException;

class UsersController extends Controller
{
    public function index()
    {
        $guzzleClient = new GuzzleClient();
        try {
            $response = $guzzleClient->request('GET', 'https://jsonplaceholder.typicode.com/users');
        } catch (GuzzleRequestException $e) {
            throw $e;
        }

        $users = json_decode($response->getBody());

        return view('pages.users', compact('users'));
    }
}