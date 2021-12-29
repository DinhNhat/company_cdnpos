<?php


namespace App\Helpers;


use App\Models\Company;

class Helper
{
    public static function usersDisplay($users, Company $company) : string {
        $html = '';
        foreach($users as $key => $user) {

            $html .= <<<EOT
                <div class="form-check">
                    <input type="checkbox" class="form-check-input" id="user-$key" name="$key">
                    <label class="form-check-label" for="user-$key">$user->name
                        <span class="badge bg-primary float-md-right">$company->hasAnyUser($key)</span>
                    </label>
                </div>
            EOT;
        }
        return $html;
    }


    public static function companyHasUser($userId, $company) {
        if (!$company->users->count() > 0) return '';
        $company->users->contains(function($value, $key) {
            return $value->id > 5;
        });
    }
}
