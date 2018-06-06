<?php

namespace App\Http\Controllers\Pages;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use GuzzleHttp\Client as GuzzleClient;

class UsersController extends Controller
{
    /**
     * Return users to the view
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $users = $this->getUsers();
        return view('pages.users', compact('users'));
    }

    /**
     * Pulls json user data from a public api (https://jsonplaceholder.typicode.com/users)
     *
     * @return mixed
     */
    public function getUsers()
    {
        $guzzleClient = new GuzzleClient();
        $response = $guzzleClient->request('GET', 'https://jsonplaceholder.typicode.com/users');
        $users = json_decode($response->getBody());
        $userArray = [];

        foreach ($users as $index => $user) {
            $nameParts = explode(' ', $user->name);
            $userArray[] = [
                'first_name'=> $nameParts[0],
                'last_name' => $nameParts[1],
                'email'     => $user->email,
                'website'   => $user->website
            ];
        }

        return $userArray;
    }

    /**
     * Sort any array by the specified column
     *
     * @param Request $request
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function sort(Request $request)
    {
        $column = $request->get('column');
        $users = $this->getUsers();
        usort($users, function ($a, $b) use ($column) {
            return $a[$column] <=> $b[$column];
        });
        return view('pages.users', compact('users'));
    }
}
