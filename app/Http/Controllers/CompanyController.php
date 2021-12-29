<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\User;
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

    public function companyUsersIndex(Request $request, Company $company) {
//        dd($company->users()->orderBy('name')->get()->count());
        $users = User::orderBy('name')->get();
        return view('companies.add-users', [
            'title' => 'Add company users',
            'company' => $company,
            'users' => $users
        ]);
    }

    public function companyUsersStore(Request $request, Company $company) {
        $userIds = $request->except('_token');
        if (!count($userIds) > 0)
            return redirect()->back();

        foreach ($userIds as $key => $userId) {
            $foundUser = User::find($key); // check if this user id is valid
            $existingUser = $company->users()->find($key);
            if (isset($foundUser) && !isset($existingUser)) {
                // userId is valid and not yet saved in table
                // save the user id in company_user table
                $company->users()->save($foundUser);
            }
        }
        $company->refresh();
        return redirect()->back();
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
