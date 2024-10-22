<?php

namespace App\Http\Controllers;
use App\Models\Devotional;
use Illuminate\Http\Request;
use Carbon\Carbon;

class DevotionalController extends Controller
{
    /**
     * Display a listing of the resource
     * 
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if (isset($request->search)) {
            return Devotional::where('title', 'like', '%'.$request->search.'%')->orWhere('content', 'like', '%'.$request->search.'%')->orderBy('id', 'Desc')->get(); 
        } else {
            return Devotional::orderBy('id', 'Desc')->get();
        }
        //http://localhost:8000/api/devotionals?search=sal
        
    }

    /**
     * Store a newly created resource in storage.
     * omoniyiolababygirlforlife
     * 
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            // 'title' => 'required',
            // 'content' => 'required',
            // 'audio_path' => 'sometimes|required'

            'title' => 'required|string|max:255',
            'bible_text' => 'required',
            'content' => 'required|string',
            'prayer' => 'required|string',
            'further_study' => 'required|string',
            'am_scriptures' => 'required|string',
            'pm_scriptures' => 'required|string',
            'audio_path' => 'sometimes|required',
            'audio_name' => 'sometimes|required',
            'image_url' => 'required|url',
            'custom_date' => 'required|date_format:Y-m-d|unique:devotionals,custom_date', // Ensure unique custom_date
            //'audio_path' => 'nullable|file|mimes:mp3,wav|max:10240' // Example validation for audio file 
        ]);

            // Check if a content with the same custom_date already exists
    $existingContent = Devotional::where('custom_date', $request->custom_date)->first();

    if ($existingContent) {
        return response()->json(['message' => 'Content for this date already exists.'], 403);
    }

    return Devotional::create([
        'title' => $request->title,
        'bible_text' => $request->bible_text,
        'content' => $request->content,
        'prayer' => $request->prayer,
        'further_study' => $request->further_study,
        'am_scriptures' => $request->am_scriptures,
        'pm_scriptures' => $request->pm_scriptures,
        'audio_path' => $request->audio_path,
        'audio_name' => $request->audio_name,
        'image_url' => $request->image_url,
        'custom_date' => $request->custom_date,
        'created_by' => auth()->user()->id]);
    }

    /**
     * Display the specified resource.
     * 
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Devotional::find($id);

    //     $devotional = Devotional::find($id);
    // return response()->json($devotional);
    }

    /**
     * Update the specified resource in storage.
     * 
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $devotional = Devotional::find($id);
        $devotional->update($request->all());
        $devotional->update(['updated_by'=>auth()->user()->id]);
        return $devotional;
    }


     /**
     * Remove  the specified resource from storage.
     * 
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       return Devotional::destroy($id); 
    }


         /**
     * Filter for a date.
     * 
     * @param timestamp date
     * @return \Illuminate\Http\Response
     */
    // public function filter(Request $request)
    // {
    //    //return Devotional::where('title', 'like', '%'.$request->title.'%')->get(); 
    //    return Devotional::orderBy('id', 'DESC')->whereBetween('custom_date', [Carbon::parse($request->from_date), Carbon::parse($request->end_date)])->get();
    //    //http://localhost:8000/api/devotionals/filter?from_date=2024-09-07&end_date=2024-09-08
    // }


//     public function filter(Request $request)
// {
//     // Parse and format the specific date to Y-m-d
//     $specificDate = Carbon::parse($request->date)->format('Y-m-d');

//     return Devotional::orderBy('id', 'DESC')
//         ->where('custom_date', $specificDate)
//         ->get();
// }
//http://localhost:8000/api/devotionals/filter?date=2024-09-30


//Carbon::parse($request->end_date)

public function filter(Request $request)
{
    $query = Devotional::orderBy('id', 'DESC');

    // Check for keyword parameter
    if ($request->has('keyword')) {
        $keyword = $request->keyword;

        // Assuming you want to search in multiple columns, e.g., title and content
        $query->where(function ($q) use ($keyword) {
            $q->where('title', 'like', "%{$keyword}%")
              ->orWhere('content', 'like', "%{$keyword}%")
              ->orWhere('custom_date', 'like', "%{$keyword}%"); // If you also want to search by date in text form
        });
    }
    return $query->get();
}


    public function pageview(Request $request, $id) {
        $devotional = Devotional::find($id);
        $total_views = $devotional->total_views;
        $total_views = $total_views + 1;
        $devotional->update(['total_views' => $total_views]);
    }
}

