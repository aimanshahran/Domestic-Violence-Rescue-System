<?php

namespace App\Http\Controllers;

use App\Models\Emergency;
use App\Models\Statistic;
use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class StatisticController extends Controller
{

    public function index()
    {
        $statistic = Statistic::all();
        $year = array_values($statistic->pluck('year')->toArray());
        $data = array_values($statistic->pluck('data')->toArray());
        $DVyear = array_values(Emergency::select(DB::raw("EXTRACT(year FROM created_at) AS year"))
            ->groupBy(DB::raw("EXTRACT(year FROM created_at)"))
            ->pluck('year')
            ->toArray());
        $DVdata = array_values(Emergency::select(DB::raw("COUNT(id) as data"))
            ->groupBy(DB::raw("EXTRACT(year FROM created_at)"))
            ->pluck('data')
            ->toArray());
        return view('statistic.index', compact('year', 'data', 'DVyear', 'DVdata'));
    }

    public function create()
    {
        return view('statistic.create');
    }

    public function store(Request $request)
    {
        //Validate data
        $request->validate([
            'year' => 'required|digits:4|integer|unique:dv_statistics|min:1900|max:'.(date('Y')),
            'data' => ['required', 'numeric', 'min:1']
        ]);

        $request->request->add(['user_id' => Auth::user()->id]);

        /*SAVE TO DATABASE*/
        $insert = Statistic::create($request->only('user_id', 'year', 'data'));

        /*DISPLAY SUCCESS AND ERROR MESSAGE*/
        if ($insert){
            return redirect()->back()->with('success','Data insert successfully');
        }

        return redirect()->back()->with('unsuccessful','There is an error occurred. Please contact administrator');

    }

    public function show()
    {
        $stats = Statistic::orderBy('year', 'DESC')
                ->paginate(4);

        if (!$stats) {
            abort(404);
        }
        return view('statistic.show', compact('stats'));
    }

    public function edit(Statistic $stat, $id)
    {
        $stat = $stat->find($id);
        return view('statistic.edit', compact('stat'));
    }

    public function update(Request $request, Statistic $stat, $id)
    {
        //Validate data
        $request->validate([
            'year' => ['required','digits:4','integer',Rule::unique('dv_statistics')->ignore($id),'min:1900','max:'.(date('Y'))],
            'data' => ['required', 'numeric', 'min:1']
        ]);

        $stat = $stat->find($id);
        $request->request->add(['id' => $id]);
        $request->request->add(['user_id' => Auth::user()->id]);

        $update = $stat->fill($request->post())->save();

        if ($update){
            return redirect()->back()->with('success','Data updated successfully');
        }

        return redirect()->back()->with('unsuccessful','There is an error occurred. Please contact administrator');

    }

    public function destroy($id)
    {
        $delete = Statistic::find($id)->delete();

        if ($delete){
            return redirect()->back()->with('success','Data has been removed.');
        }

        return redirect()->back()->with('unsuccessful','There is an error occurred. Please contact administrator');
    }
}
