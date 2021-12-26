<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CompanyController extends Controller
{
    public function index() {
        return view('companies.index', [
            'title' => 'Companies list',
            'companies' => Company::all()
        ]);
    }

    public function create()
    {
        return view('companies.add', [
            'title' => 'Add company',
        ]);
    }

    public function store(Request $request) {
        $request->validate([
            'name' => ['required']
        ]);

        try {
            Company::create([
                'name' => (string) $request->input('name'),
            ]);
            Session::flash('success', 'Create a company successfully');
        } catch(\Exception $error) {
            Session::flash('error', $error->getMessage());
        }

        return redirect()->back();
    }

    public function addUsersShow(Request $request, Company $company) {
//        dd($company->users()->orderBy('name')->get()->count());
        $users = $company->users()->orderBy('name')->get();
        return view('companies.add-users', [
            'title' => 'Add company users',
            'company' => $company,
            'users' => $users
        ]);
    }

    public function addUsersStore(Request $request, Company $company) {
        dd($request->all());
    }

    public function show($id) {

    }

    public function edit(Company $company) {
        return view('companies.edit', [
            'title' => 'Edit company',
            'company' => $company
        ]);
    }

    public function update(Request $request, Company $company) {
        $request->validate([
            'name' => ['required']
        ]);
        try {
            $company = Company::find($company->id);
            $company->name = $request->input('name');
            $company->save();
            Session::flash('success', 'Update company successfully!');
        } catch(\Exception $error) {
            Session::flash('error', 'Update company failed. Please try again!!!');
            return redirect('/companies');
        }

        return redirect('/companies/' . $company->id . '/edit');
    }

    public function destroy(Request $request) {
        $company = Company::where('id', $request->input('id'))->first();

        if ($company) {
            $company->delete();
            return response()->json([
                'error' => false,
                'message' => 'Delete company successfully!'
            ]);
        }

        return response()->json([ 'error' => true ]);
    }
}
