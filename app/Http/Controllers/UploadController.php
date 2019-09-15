<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Upload;

class UploadController extends Controller
{
    public function delete(Request $request, $id)
    {
        $upload = $request->user()->uploads()->findOrFail($id);

        $upload->delete();

        return redirect()->back()
            ->withMessage('Deleted.
                <a href="' . route('uploads.restore', $upload) . '">Undo.</a>');
    }

    public function restore(Request $request, $id)
    {
        $upload = $request->user()->uploads()->withTrashed()->findOrFail($id)->restore();

        return redirect()->back()
            ->withMessage('Restored.');
    }
}
