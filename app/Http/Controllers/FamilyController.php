<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Family;
use App\Member;
use App\Http\Requests\FamilyRequest;
use Image;


class FamilyController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }


    // List all Families in Admin dashboard
    public function admin(Request $request)
    {
        // If sorting by user (a get from the request)
        if ($request->sort_by) {

            $sort_by = $request->sort_by;
            $direction = $request->direction;

            $families = Family::orderBy($sort_by, $direction)->get();

        // Else, default sort by most recently updated
        } else {

            $families = Family::latest('updated_at')->get();

        }

        return view('directory.admin', compact('families'));
    }


    public function index()
    {

        $families = Family::where('status_id', 1)->get();

        $families = $families->sortBy('name');

        return view('directory.index', compact('families'));
    }


    public function show($slug)
    {
        //$family = Family::find($id);

        $family = Family::whereSlug($slug)->firstOrFail();

        $family->load('members');

        return view('directory.show', compact('family'));
    }


    // Return form to create a new Family
    public function create()
    {
        $statuses = ['Active' => 1, 'Closed' => 2];

        return view('directory.create', compact('statuses'));
    }


    // Add/store a new Family
    public function store(FamilyRequest $request)
    {
        // $family = Family::create($request->all());

        // $family->save();

        $family = $this->addFamily($request);

        flash()->success('The family was added.');

        // pass the new 'family' session data to the Member create form to autofill some data...
        return redirect('members/create')->with(compact('family'));
    }



    // Edit a family
    public function edit($slug)
    {
        $family = Family::whereSlug($slug)->firstOrFail();

        $statuses = ['Active' => 1, 'Closed' => 2];

        $members = Member::where('family_id', '=', $family->id)->get();

        return view('directory.edit', compact('family', 'statuses', 'members'));
    }


    // Update a family
    public function update(FamilyRequest $request, Family $family)
    {
        $this->updateFamily($request, $family);

        flash()->success('The family was updated.');

        return redirect('admin');
    }


    // Delete a family and its members
    public function destroy(Family $family)
    {
        $family->members()->delete();
        $family->delete();

        flash()->success('The family and members were deleted.');

        return redirect('admin');
    }



    // Build up new Family, sluggify, and create thumbnail
    private function addFamily(FamilyRequest $request)
    {

        $family = new Family;

        $family->name = $request->name;
        //$family->user_id = Auth::user()->id;
        $family->status_id = $request->status_id;
        $family->slug = Family::checkSlug($request->slug);
        $family->address = $request->address;
        $family->city = $request->city;
        $family->state = $request->state;
        $family->zip = $request->zip;
        $family->anniversary = $request->anniversary;
        $family->phone = $request->phone;

        // Photo...
        if($request->file('photo'))
        {
            $file = time() . '_' . $request->file('photo')->getClientOriginalName();
            $path = 'public/directory/';
            $thb_path = storage_path('app/public/directory/thb/');

            // Make thumbnail
            $img = Image::make($request->file('photo'));
            $img->resize(320, 240);
            $img->save($thb_path . 'thb_' . $file);

            // Save thumbnail size photo
            $family->thumbnail = 'thb_' . $file;

            // Store the original photo in /storage/app/{path}
            $request->file('photo')->storeAs($path, $file);

            // Save original size photo
            $family->photo = $file;
        }

        // Save all family data from request...
        $family->save();

        return $family;
    }



    // Update a Family, sluggify, and create thumbnail
    private function updateFamily(FamilyRequest $request, $fam)
    {

        $family = Family::where('id', '=', $fam->id)->firstOrFail();

        $family->name = $request->name;
        //$family->user_id = Auth::user()->id;
        $family->status_id = $request->status_id;
        $family->slug = Family::checkSlug($request->slug, $fam->id);
        $family->address = $request->address;
        $family->city = $request->city;
        $family->state = $request->state;
        $family->zip = $request->zip;
        $family->anniversary = $request->anniversary;
        $family->phone = $request->phone;

        if($request->photo) {
            // Photo...
            $file = time() . '_' . $request->file('photo')->getClientOriginalName();
            $path = 'public/directory/';
            $thb_path = storage_path('app/public/directory/thb/');

            // Make thumbnail
            $img = Image::make($request->file('photo'));
            $img->resize(320, 240);
            $img->save($thb_path . 'thb_' . $file);

            // Save thumbnail size photo
            $family->thumbnail = 'thb_' . $file;

            // Store the original photo in /storage/app/{path}
            $request->file('photo')->storeAs($path, $file);

            // Save original size photo
            $family->photo = $file;
        }

        // Save all family data from request...
        $family->save();

        return $family;
    }
}
