<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Member;
use App\Family;
use App\FamilyRole;
use App\Http\Requests\MemberRequest;


class MemberController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }


    public function index()
    {

    }

    public function create()
    {
        $statuses = ['Active' => 1, 'Closed' => 2];

        $families = Family::all();
        $families = array_pluck($families, 'name', 'id');

        $family_roles = [1 => 'Head', 2 => 'Spouse', 3 => 'Dependant'];

        $genders = ['male' => 'Male', 'female' => 'Female'];

        return view('members.create', compact('families', 'statuses', 'family_roles', 'genders'));
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

        $statuses = ['Active' => 1, 'Closed' => 2];

        $families = Family::all();
        $families = array_pluck($families, 'name', 'id');

        $family_roles = [1 => 'Head', 2 => 'Spouse', 3 => 'Dependant'];

        $genders = ['male' => 'Male', 'female' => 'Female'];

        return view('members.edit', compact('member', 'statuses', 'families', 'family_roles', 'genders'));
    }


    // Update a member
    public function update(MemberRequest $request, Member $member)
    {
        $member->update($request->all());

        $member->save();

        flash()->success('The member was updated.');

        return redirect('directory/dashboard');
    }


    // Delete a member
    public function destroy(Member $member)
    {
        $member->delete();

        flash()->success('The member was deleted.');

        return redirect('directory/dashboard');
    }

}
