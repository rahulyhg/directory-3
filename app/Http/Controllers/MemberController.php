<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Member;
use App\Family;
use App\FamilyRole;
use App\Http\Requests\MemberRequest;
use Session;


class MemberController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }


    public function index()
    {
        return redirect('/');
    }


    public function create()
    {
        // Grab the family session data passed back from FamilyController@store
        $family = Session::get('family');

        if (isset($family)) {
            $famId = $family->id;
            $famName = $family->name;
        } else {
            $famId = null;
            $famName = null;
        }


        // Create an associative array of families, 'id' => 'family name, head first'
        $raw_families = Family::orderBy('name', 'asc')->get();
        $families = [];
        foreach ($raw_families as $fam) {
            if ($fam->head) {
                $families[$fam->id] = $fam->name . ', ' . $fam->head->first_name;
            } else{
                $families[$fam->id] = $fam->name;
            }
        }

        // Helper arrays...
        $statuses = ['Active' => 1, 'Closed' => 2];
        $family_roles = [1 => 'Head', 2 => 'Spouse', 3 => 'Dependant'];
        $genders = ['male' => 'Male', 'female' => 'Female'];

        return view('members.create', compact('famId', 'famName', 'families', 'statuses', 'family_roles', 'genders'));
    }


    // Add/store a Member
    public function store(MemberRequest $request)
    {
        $member = Member::create($request->all());

        $member->save();

        flash()->success('The member was added.');

        return redirect('members/create');
    }


    // Edit a Member
    public function edit($id)
    {
        $member = Member::where('id', '=', $id)->firstOrFail();

        // Grab the family session data passed back from FamilyController@store
        $family = Session::get('family');

        if (isset($family)) {
            $famId = $family->id;
            $famName = $family->name;
        } else {
            $famId = null;
            $famName = null;
        }


        // Create an associative array of families, 'id' => 'family name, head first'
        $raw_families = Family::orderBy('name', 'asc')->get();
        $families = [];
        foreach ($raw_families as $fam) {
            if ($fam->head) {
                $families[$fam->id] = $fam->name . ', ' . $fam->head->first_name;
            } else{
                $families[$fam->id] = $fam->name;
            }
        }

        // Helper arrays...
        $statuses = ['Active' => 1, 'Closed' => 2];
        $family_roles = [1 => 'Head', 2 => 'Spouse', 3 => 'Dependant'];
        $genders = ['male' => 'Male', 'female' => 'Female'];

        return view('members.edit', compact('famId', 'famName', 'families', 'member', 'statuses', 'family_roles', 'genders'));
    }


    // Update a member
    public function update(MemberRequest $request, Member $member)
    {
        $member->update($request->all());

        $member->save();

        flash()->success('The member was updated.');

        return redirect('/admin');
    }


    // Delete a member
    public function destroy(Member $member)
    {
        $member->delete();

        flash()->success('The member was deleted.');

        return redirect('/admin');
    }

}
