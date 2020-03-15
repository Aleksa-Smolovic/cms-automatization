<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use App\Stats;

class StatsController extends Controller
{
    
    public function index(){
        $objects = Stats::orderBy("id", "DESC")->get();
        return view("admin.stats.index",  compact("objects"));
    }
    
    public function destroy($id){
        $object = Stats::find($id);
        if($object)
            $object->delete();
        return back()->with("success", "Element uspješno obrisan!");
    }
    
    public function deleted()
	{
        return view("admin.stats.deleted")->withObjects( Stats::onlyTrashed()->get());
    }
    
    public function restore($id){
        Stats::where("id", $id)->restore();
		return back()->with("success", "Objekat uspješno aktiviran.");
    }
    
    
    public function store(Request $request){
        $data = $request->validate([
            'date_published' => 'required|date_format:d/m/Y',
            'infected_montenegro' => 'required|max:191',
            'infected_global' => 'required|max:191',
            'under_watch' => 'required|max:191',
            'tested' => 'required|max:191',
        ],
        [
            'date_published.required' => 'Morate unijeti datum objave!',
            'date_published.date_format' => 'Datum objave mora biti dormata d/m/y!',
            'infected_montenegro.required'=> 'Morate unijeti broj zaraženih u crnoj gori!',
            'infected_montenegro.max'=> 'Broj zaraženih u Crnoj Gori može sadržati najviše 191 karaktera!',
            'infected_global.required'=> 'Morate unijeti broj zaraženih u crnoj gori!',
            'infected_global.max'=> 'Broj zaraženih u Crnoj Gori može sadržati najviše 191 karaktera!',
            'under_watch.required'=> 'Morate unijeti broj osoba pod nadzorom!',
            'under_watch.max'=> 'Broj osoba pod nadzorom može sadržati najviše 191 karaktera!',
            'tested.required'=> 'Morate unijeti broj zaraženih u crnoj gori!',
            'tested.max'=> 'Broj zaraženih u Crnoj Gori može sadržati najviše 191 karaktera!',
        ]);

        $data["create_user_id"] = Auth::user()->id;

        Stats::create($data);

        return "Done";
         
    }
    
    public function edit(Request $request){
        $data = $request->validate([
            "id" => "required",
            'date_published' => 'required|date_format:d/m/Y',
            'infected_montenegro' => 'required|max:191',
            'infected_global' => 'required|max:191',
            'under_watch' => 'required|max:191',
            'tested' => 'required|max:191',
        ],
        [
            'date_published.required' => 'Morate unijeti datum objave!',
            'date_published.date_format' => 'Datum objave mora biti dormata d/m/y!',
            'infected_montenegro.required'=> 'Morate unijeti broj zaraženih u crnoj gori!',
            'infected_montenegro.max'=> 'Broj zaraženih u Crnoj Gori može sadržati najviše 191 karaktera!',
            'infected_global.required'=> 'Morate unijeti broj zaraženih u crnoj gori!',
            'infected_global.max'=> 'Broj zaraženih u Crnoj Gori može sadržati najviše 191 karaktera!',
            'under_watch.required'=> 'Morate unijeti broj osoba pod nadzorom!',
            'under_watch.max'=> 'Broj osoba pod nadzorom može sadržati najviše 191 karaktera!',
            'tested.required'=> 'Morate unijeti broj zaraženih u crnoj gori!',
            'tested.max'=> 'Broj zaraženih u Crnoj Gori može sadržati najviše 191 karaktera!',
        ]);

        $object = Stats::find($data["id"]);
        $data["update_user_id"] = Auth::user()->id;

        $object->fill($data);
        $object->save();
       
        return "Done";
         
    }
}
