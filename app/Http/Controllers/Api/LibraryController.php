<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\User;
use Illuminate\Console\View\Components\Alert;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class LibraryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $userId = $request->input('userId'); // Get the user
        $user = User::FindOrFail($userId);
        $bookId = $request->input('bookId');

        if ($user->books()->where('book_id', $bookId)->exists()) { //if book already exists in user library
            return response()->json(['message' => 'Book already exists!']);
        } else { //if doesn't exist, add to library
            $user->books()->attach($bookId, ['created_at' => now()]);
            $book = Book::where('id', $bookId);
            $book->increment('reads', 1);
            return response()->json(['message' => 'Book saved successfully']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
    }


    public function removeFromLibrary($userId, $bookId)
    {
        // Find the user
        $user = User::findOrFail($userId);

        // Find the pivot record for the user and book
        $pivotRecord = $user->books()->where('book_id', $bookId)->first()->pivot;

        // Soft delete the pivot record
        $pivotRecord->update(['deleted_at' => now()]);

        // Return a success message or response
        return response()->json(['message' => 'Book removed from library successfully']);
    }
}
