<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Widget;
use App\User;
use Illuminate\Support\Facades\Auth;
use DB;
use Illuminate\Support\Str;
class WidgetController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $userIDReffered = DB::table('users')->where('uuid',$request->uuid)->pluck('id')->first();
        
        $app_id = 1;
        $user_id = Auth::user()->id;
        $name = $request->widgetName;
        
       
        $token = Str::uuid()->toString();

        
        $url ='';
        $createdWidget = Widget::create([
            'app_id' => $app_id,
            'user_id' => $user_id,
            'name' => $name,
            'user_id_referred'=> $userIDReffered,
            'url'=>$url,
            'token'=>$token
        ]);

        $script='<!--Start of Ventonic.com Script-->
        <script type="text/javascript">
        var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
        (function(){
        var
        s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
        s1.async=true;
        s1.src="https://embed.ventonic.com/'.$token.'/default";
        s1.charset="UTF-8";
        s1.setAttribute("crossorigin","*");
        s0.parentNode.insertBefore(s1,s0);
        })();
        </script>
        <!--End of Ventonic.com Script-->';
        
        return response()->json(['script'=>$script], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function widgetsData(){
        $data = Widget::join('widget_data','widget.id','=','widget_data.widget_id')
        ->join('seller_profiles','seller_profiles.user_id','=','widget.user_id_referred')
        ->join('users','users.id','=','seller_profiles.user_id')
        ->selectRaw("widget_data.created_at,widget_data.origin as url,seller_profiles.phone_mobil,users.name,'product' as product")->get();
       
        return view('widget_data.widget-data',['data'=>$data]);
    }

    public function updateWidgetStatus(Request $request){
       
        $update = Widget::where('id',$request->widgetID)->update([
            'status'=>$request->widgetStatus
        ]);

        return response()->json($update, 200);

    }
}
