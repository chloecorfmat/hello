<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Spatie\TranslationLoader\LanguageLine;

class ApiController extends Controller
{
    public function users(Request $request, $page = 1)
    {
        $current_user = \Auth::user();
        $query = User::query();

        if (!empty($request->get('search') && $request->get('search') !== "undefined")) {
            $search = $request->get('search');
            $query->orWhere('name', 'LIKE', '%' . $search . '%')
                ->orWhere('matricule', 'LIKE', '%' . $search . '%')
                ->orWhere('email', 'LIKE', '%' . $search . '%');
        }

        if (!empty($request->get('sortBy')) && !empty($request->get('orderBy'))) {
            $query->orderBy($request->get('sortBy'), $request->get('orderBy'));
        }

        $skip = ($page-1)*30;
        if (!is_null($query)) {
            $users_nb = $query->count();
            $users = $query->skip($skip)->take(30)->get();

        } else {
            $users = User::skip($skip)->take(30)->get();
            $users_nb = User::all()->count();
        }

        foreach ($users as $user) {
            $user->getRoleNames();
        }

        return response()->json([
            'current_user' => $current_user,
            'users' => $users,
            'users_nb' => $users_nb,
        ]);
    }

    public function translations(Request $request) {
        $lang = $request->cookie('lang');
        $translations = [];
        $language_lines = LanguageLine::all();

        foreach ($language_lines as $language_line) {
            $key = $language_line->group . '_' . $language_line->key;

            foreach ($language_line->text as $l => $text) {
                if ($l === $lang) {
                    $translations[$key] = $text;
                }
            }
        }

        return response()->json($translations);
    }
}
