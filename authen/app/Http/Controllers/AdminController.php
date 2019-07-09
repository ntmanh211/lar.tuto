<?php
namespace App\Http\Controllers;
use App\Model\AdminModel;
use Illuminate\Http\Request;
class AdminController extends Controller
{
    public function __construct()
    {
        $this ->middleware('auth:admin')->only('index');
    }
    // tạo controller bằng câu lệnh php artisan make:controller namecontroller
    public function index(){
        //phương thức trả về view đăng nhập thành công
        return view('admin.dashboard');
    }
    //phương thức trả về thành công khi đăng kí admin
    public function create(){
        return view('admin.auth.register');
    }
    public function store(Request $request){
        //validate dữ liệu form đi
        $this ->validate($request,array(
            'name' =>'required',
            'email' =>'required',
            'password'=>'required'
        ));
        //khởi tạo mode để lưu admin mới
        $adminmodel = new AdminModel();
        $adminmodel->name =$request->name;
        $adminmodel->email = $request->email;
        $adminmodel->password = bcrypt($request->password); //ham để mã hóa mật khẩu
        return redirect()->route('admin.auth.login');
    }
}