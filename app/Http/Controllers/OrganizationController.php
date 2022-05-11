<?php

namespace App\Http\Controllers;

use Yajra\DataTables\DataTables;
use App\Models\Organization;
use Illuminate\Http\Request;

class OrganizationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('organizations.index');
    }
    public function indexAjax(Request $request, Organization $organization)
    {
        //yajra datatable ajax call
        $data = Organization::query();
        return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('show', function ($row) {
                return '<a href="/organizations/' . $row->id . '" class="btn btn-primary">Show</a>';
            })
            ->addColumn('edit', function ($row) {
                return '<a href="/organizations/' . $row->id . '/edit" class="btn btn-warning">Edit</a>';
            })
            ->addColumn('delete', function ($row) {
                return '<a id="' . $row->id . '" class="btn btn-danger action-btn deleteCat" data-toggle="modal" title="Delete" data-target="#deleteModal" data-original-title="Delete">Delete</a>';
            })
            ->rawColumns(['show', 'edit', 'delete'])->make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //redirect to create form of organizations.
        return view('organizations.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //add validation and store data into database.
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'year' => 'required',
            'phonenumber' => 'required',
            'address' => 'required',
            'website' => 'required',
        ]);
        Organization::create($request->all());
        return redirect()->route('organizations.index')
            ->with('success', 'Organization created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Organization  $organization
     * @return \Illuminate\Http\Response
     */
    public function show(Organization $organization)
    {
        //show perticular record form the table with use of id.
        return view('organizations.show', compact('organization'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Organization  $organization
     * @return \Illuminate\Http\Response
     */
    public function edit(Organization $organization)
    {
        //redirect to edit form.
        return view('organizations.edit', compact('organization'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Organization  $organization
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Organization $organization)
    {
        //update organization with validations.
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'year' => 'required',
            'phonenumber' => 'required',
            'address' => 'required',
            'website' => 'required',
        ]);

        $organization->update($request->all());
        return redirect()->route('organizations.index')
            ->with('success', 'organization updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Organization  $organization
     * @return \Illuminate\Http\Response
     */
    public function destroy(Organization $organization)
    {
        //delete organization with the specific id.
        $organization->delete();
        return redirect()->route('organizations.index')
            ->with('success', 'organization deleted successfully');
    }
}
