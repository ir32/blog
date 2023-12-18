<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function index() {
        return view('form-data.form');
    }
    public function get_result() {
        $posts = DB::select('SELECT * FROM posts');
        // echo "<pre>";
        // print_r($posts);
        // die("hi");
        return view('form-data.index',compact('posts'));
    }

    public function post_data(Request $request) {
        $title = $request->input('title');

        $startPos = strpos($title, 'is') + 3;
        $result = substr($title, $startPos);

        $description = $request->input('description');


        $title .= " check";

        
       $array = [
        'title' => $title,
        'description' => $description,
        ];
        $array1 = [
        'title1' => "cdfsd"
        ];
        $all_data = array_merge($array,$array1);

        $resultArray = $array1 + $array;
        // echo "<pre>";
        // print_r($resultArray);
        // die("hi");
        $result = DB::table('posts')->insert($array);
    }


    function isprime ($num) {
       
    }

    

}
