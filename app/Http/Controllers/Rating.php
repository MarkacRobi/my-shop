<?php

namespace App\Http\Controllers;

use App\Item;
use Illuminate\Http\Request;

class Rating extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request, $id)
    {
        //preveri ce je stranka
        if(!auth()->user()->role == 'STRANKA'){
            return redirect('/')->with('error', 'Samo stranka lahko ocenjuje artikle!');
        }

        $this->validate($request, [
            'rating' => ['required','numeric','min:0','max:5']
        ]);

        $item = Item::find($id);
        $rating = $item->rating;
        $rating->rating = ($rating->rating * $rating->counter + $request->input('rating')) / ($rating->counter + 1);
        $rating->counter += 1;
        $rating->save();
        return redirect()->secure('/')->with('success', 'Artikel '.$item->title.'uspesno ocenjen z oceno '.$request->input('rating'));
    }
}
