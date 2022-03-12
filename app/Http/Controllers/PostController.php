<?php


namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Posts;
use Illuminate\Support\Facades\Session;
class PostController extends Controller
{
    public function index()
    {
        $getData_all = posts::all();
        $getData = DB::table('profiles')->paginate(5);
        return view('post.list')->with('listpost',$getData_all)->with('listpost_pagination',$getData);
    }
    public function details($id)
    {
        $getData = posts::where('id','=', $id)->get();
        return view('post.detail')->with('post',$getData);
    }
    public function edit($id)
    {
    
        $getData = posts::where('id',$id)->get();
        return view('post.edit')->with('getpostById',$getData);
    }
public function update(Request $request)
{	
 
	DB::table('post')->where('id', $request->id)->update([
		'name' => $request->name,
        'date_of_birth'=> $request->date_of_birth,
        'nickname'=> $request->nickname,
        'username'=> $request->username,
        'email'=> $request->email,
        'description'=> $request->description,
        'avatar'=> $request->avatar,
        'address'=> $request->address,
        'phone_number'=> $request->phone_number,
		'updated_at' => date('Y-m-d H:i:s')
	]);
	
	return redirect('post');
}
public function destroy($id)
{
	$deleteData = DB::table('posts')->where('id', '=', $id)->delete();
	
	return redirect('post');
}
}
