<?php

namespace App\Http\Controllers;

use App\Http\Middleware\ProdajalecMiddleware;
use Illuminate\Http\Request;

use App\Item;
use App\User;
use DB;
use Illuminate\Support\Facades\Storage;


class ItemsController extends Controller
{
    /**
     * Blokira pot ce nisi prijavljen
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(ProdajalecMiddleware::class)->except(['index','show']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items = Item::where('active', '1')->orderBy('created_at', 'desc')->paginate(12);
        return view('items.index')->with('items', $items);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('items.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //validacija
        $this->validate($request, [
            'title' => ['required', 'string'],
            'body' => ['required', 'string'],
            'price' => ['required','numeric'],
            'cover_image' => 'image|nullable|max:1999'
        ]);

        // Handle file upload
        if($request->hasFile('item_image')){
            //Get filename with the extension
            $filenamewithExt = $request->file('item_image')->getClientOriginalName();

            //Get just filename
            $filename = pathinfo($filenamewithExt,PATHINFO_FILENAME);

            //Get just ext
            $extension = $request->file('item_image')->guessClientExtension();

            //FileName to store
            $fileNameToStore = $filename.'_'.time().'.'.$extension;

            //Upload Image   !!! mores naret php artisan storage:link da imas dostop do storage v public
            $path = $request->file('item_image')->storeAs('public/item_images',$fileNameToStore);
        }
        else {
            $fileNameToStore = 'no-image.png';
        }

        //Create Item
        $item = new Item;
        $item->title = $request->input('title');
        $item->body = $request->input('body');
        $item->price = $request->input('price');
        $item->user_id = auth()->user()->id;
        $item->item_image = $fileNameToStore;
        $item->save();
        return redirect('/') -> with('success', 'Item Created');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $item = Item::find($id);
        return view('items.show')->with('item', $item);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $item = Item::find($id);

        return view('items.edit')->with('item', $item);
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
        //validacija
        $this->validate($request, [
            'title' => 'required',
            'body' => 'required',
            'price' => ['required','numeric'],
            'cover_image' => 'image|nullable|max:1999'
        ]);

        // Handle file upload
        if($request->hasFile('item_image')){
            //Get filename with the extension
            $filenamewithExt = $request->file('item_image')->getClientOriginalName();

            //Get just filename
            $filename = pathinfo($filenamewithExt,PATHINFO_FILENAME);

            //Get just ext
            $extension = $request->file('item_image')->guessClientExtension();

            //FileName to store
            $fileNameToStore = $filename.'_'.time().'.'.$extension;

            //Upload Image   !!! mores naret php artisan storage:link da imas dostop do storage v public
            $path = $request->file('item_image')->storeAs('public/item_images',$fileNameToStore);
        }

        //Update item
        $item = Item::find($id);
        $item->title = $request->input('title');
        $item->body = $request->input('body');
        $item->price = $request->input('price');
        if($request->hasFile('item_image')){
            $item->item_image = $fileNameToStore;
        }

        $item->save();
        return redirect('/') -> with('success', 'Item Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item = Item::find($id);


        if($item->item_image != 'no-image.png'){
            //Delete Image
            Storage::delete('public/item_images'.$item->item_image);
        }

        $item->delete();
        return redirect('/')->with('success', 'Item Removed');
    }
}
