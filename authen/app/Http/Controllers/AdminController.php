<?php

namespace App\Http\Controllers;

use App\Model\AdminModel;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    //Hàm khỏi tạo của class được chạy ngay khi khỏi tạo đối tượng
    //Hàm này sẽ luôn được chạy trước so với các hàm khác
    public function __construct()
    {
        $this->middleware('auth.admin')->only('index');
    }


    /*
     * Phương thức trả về view khi đăng nhập thành công
     *
     */
    
    public function index(){
        return view('admin.dashboard');
    }

    /*
     * Phương thức trả về view dùng để đang kí tài khoản admin
     */
    public function create(){
        return view('admin.auth.register');
    }

    public function store(Request $request){

        //validate dữ liệu được gửi từ form đi
        $this->validate($request, array(
           'name' => 'required',
           'email' => 'required',
           'password' => 'required'
        ));

        //Khởi tạo model để lưu admin mới
        $adminModel = new AdminModel();
        $adminModel->name = $request->name;
        $adminModel->email = $request->email;
        $adminModel->password = $request->password;
        $adminModel->password = bcrypt( $request->password);
        $adminModel->save();

        return redirect()->route('admin.auth.login');

    }
}
