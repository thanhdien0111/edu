<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use RealRashid\SweetAlert\Facades\Alert;
Use Exception;
class essayController extends Controller
{
    public function addessay(Request $request) {
        $name = $request->name;
        $address = $request->address;
        $article_title =$request->article_title;
        $essay =$request->essay;
       
        $query=false;
        $alert=false;
        $values = array('name' => $name,'address' => $address,'article_title'=>$article_title,'essay'=>$essay);
        try{
          $query=DB::table('essay')->insert($values);
        }catch(Exception)
        {
           $alert = alert()->error('Failed','Kiểm tra lại các ô nhập');
           $request->flash();
        }
        if($query)
        {
            alert()->success('Add Successed');
            return redirect()->route("home");
        }
        if($alert)
        {
            return redirect()->route('home', ['alert' => $alert]);
        }
    }
    public function deleteAllessay(Request $request){
        $id = $request->id;
        $alert;
        if($id==null)
        {
            $count = DB::table('essay')->count();
            if($count==0)
            {
                $alert = alert()->warning('Nothing to delete');
                return redirect()->route('home', ['alert' => $alert]);
            }else
            {
                DB::table('essay')->delete();
                $alert = alert()->success('Delete Successed');
                return redirect()->route('home', ['alert' => $alert]);
            }
            $alert = alert()->warning('Please select at least 1 to delete');
           return redirect()->route('home', ['alert' => $alert]);
        }else
        {
            foreach($id as $item)
            {
                $deleted = DB::table('essay')->where('id', '=', $item)->delete();
            }
            if($deleted)
        {
            alert()->success('Delete Successed');
            return redirect()->route("home");
        }
        }
    }
    public function deleteessay($id){
        $deleted = DB::table('essay')->where('id', '=', $id)->delete();
        if($deleted)
        {
            alert()->success('Delete Successed');
            return redirect()->route("home");
        }
    }
    public function updateessay(Request $request,$id){
        $name = $request->name;
        $address = $request->address;
        $article_title =$request->article_title;
        $essay =$request->essay;
       
       
        $values = array('name' => $name,'address' => $address,'article_title'=>$article_title,'essay'=>$essay );
        $query = DB::table('essay')->where('id', '=', $id)->update($values);
        if($query)
        {
            alert()->success('Update Successed');
        }
        return redirect()->route("home");
    }
    public function editessay($id){
        $data = DB::select('select * from essay where id = ?', [$id]);
        if($data)
        {
            return view("update")->with("data",$data[0]);
        }
       
    }
    public function filteressay(Request $request){
       $select = $request->select;
       $output="";
        if($select)
        {
            if($select=="Theo thứ tự giảm dần")
            {
                $data =  DB::table('essay')->orderBy('id', 'DESC')->paginate(5);
                $output="";
                foreach($data as $item)
                {
                    $output.=
                    '
                    <tr>
                    <td class="text-center align-middle"><input name="id[]" type="checkbox" id="checkItem" 
                    value='.$item->id.'>
                    <td class="align-middle"> '.$item->id.' </td>
                    <td class="align-middle"> '.$item->name.' </td>
                    <td class="align-middle"> '.$item->address.' </td>
                    <td class="align-middle"> '.$item->article_title.' </td> 
                    <td class="align-middle"> '.$item->essay.' </td>  
                                 
                    <td class="align-middle">
                    <div class="btn-group" role="group" aria-label="Basic example">
                         <a  href="/EditSer/'.$item->id.'" class="btn btn-warning">Edit</a>
                         <a id="deleteBtn" href="checkDelete/'.$item->id.'" class="btn btn-danger">Delete</a>
                    </div>
                 </td>
                    </tr>
                    ';
                }
                return response($output);
            }
            if($select=="A tới Z")
            {
                $data =  DB::table('essay')->orderBy('name', 'ASC')->paginate(5);
                $output="";
                foreach($data as $item)
                {
                    $output.=
                    '
                    <tr>
                    <td class="text-center align-middle"><input name="id[]" type="checkbox" id="checkItem" 
                    value='.$item->id.'>
                    <td class="align-middle"> '.$item->id.' </td>
                    <td class="align-middle"> '.$item->name.' </td>
                    <td class="align-middle"> '.$item->address.' </td>
                    <td class="align-middle"> '.$item->article_title.' </td>  
                    <td class="align-middle"> '.$item->essay.' </td> 
                                       
                    <td class="align-middle">
                    <div class="btn-group" role="group" aria-label="Basic example">
                         <a  href="/EditSer/'.$item->id.'" class="btn btn-warning">Edit</a>
                         <a id="deleteBtn" href="checkDelete/'.$item->id.'" class="btn btn-danger">Delete</a>
                    </div>
                 </td>
                    </tr>
                    ';
                }
                return response($output);
            }
        }
    }
    public function searchessay(Request $request){
        $data =  DB::table('essay')->where('name', 'like', '%' . $request->search . '%')->paginate(5);
        $output="";
        foreach($data as $item)
        {
            $output.=
            '
            <tr>
            <td class="text-center align-middle"><input name="id[]" type="checkbox" id="checkItem" 
            value='.$item->id.'>
            <td class="align-middle"> '.$item->id.' </td>
            <td class="align-middle"> '.$item->name.' </td>
            <td class="align-middle"> '.$item->address.' </td>
            <td class="align-middle"> '.$item->article_title.' </td> 
            <td class="align-middle"> '.$item->essay.' </td> 
                       
            <td class="align-middle">
            <div class="btn-group" role="group" aria-label="Basic example">
                 <a  href="/EditSer/'.$item->id.'" class="btn btn-warning">Edit</a>
                 <a id="deleteBtn" href="checkDelete/'.$item->id.'" class="btn btn-danger">Delete</a>
            </div>
         </td>
            </tr>
            ';
        }
        return response($output);
    }
    public function loadData(Request $request){
        
            $data = DB::table('essay')->paginate(5);
            if ($request->ajax()) {
                return view('data', compact('data'));
            }
            return view('dashboard',compact('data'));
        
    }
}
