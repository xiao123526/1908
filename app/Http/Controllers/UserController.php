<?php
/**
 * @Author: name
 * @Date:   2020-02-11 15:24:35
 * @Last Modified by:   name
 * @Last Modified time: 2020-02-11 15:41:07
 */
namespace App\Http\Controllers;
use Illuminate\Http\Request;
class UserController extends Controller{
        public function index(){
            return view('user.add');
        }
        public function add_do(Request $request){
            $data=$request->all();
            dd($data);
        }
}