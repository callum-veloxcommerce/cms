<?php

namespace Statamic\Http\Controllers\CP\Utilities;

use Statamic\Facades\Search;
use Illuminate\Http\Request;
use Statamic\Http\Controllers\CP\CpController;

class UpdateSearchController extends CpController
{
    public function index()
    {
        return view('statamic::utilities.search', [
            'indexes' => Search::indexes()
        ]);
    }

    public function update(Request $request)
    {
        $indexes = collect($request->validate([
            'indexes' => 'required',
        ])['indexes']);

        $indexes->each(function ($index) {
            Search::index($index)->update();
        });

        return back()->withSuccess('Indexes successfully updated.');
    }
}