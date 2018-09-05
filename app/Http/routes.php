<?php


use App\Product;
use App\Staff;
use App\Photo;

Route::get('/', function () {
    return view('welcome');
});

// create by STUFF
Route::get('/create', function (){
   $staff = Staff::find(1);

   $staff->photos()->create(['path'=>'image3.jpeg']);
});

// create by STUFF
Route::get('/create1', function (){
    $product = Product::find(2);

    $product->photos()->create(['path'=>'image2.jpeg']);
});

Route::get('/read', function (){
   $stuff = Staff::find(1);

   foreach ($stuff->photos as $p){
       echo $p->path . "<br>";
   }
});

Route::get('/update', function (){
   $product = Product::find(2); // this value shoud satisfy the existing value @PRODUCT table & PHOTOS as well

   foreach ($product->photos as $p){
       $p->where('id',4)->update(['path'=>"Shit1.jpeg"]); // this ID should consist type of MODEL (as above)^
   }
});

// same update 2
Route::get('/update1', function (){
   $staff = Staff::findOrFail(1);

   $photo = $staff->photos()->whereid(1)->first();

   $photo->path = "updated.jpeg";

   $photo->save();
});

Route::get('/delete', function (){
    //$product = Product::find(1); // Belongs to Product table :: (id 1 :: type App\Product)

    //$product->photos()->whereid(3)->delete(); // it will not work bcz ID 3 has a type of App\Staff

    $product = Product::find(2); // Belongs to Product table :: (id 2 :: type App\Product)

    $product->photos()->whereid(4)->delete();
});

// SPECIAL TECHNIQUES
Route::get('/assigner', function (){
    $stuff = Staff::find(2); // Pick Stuff

    $photo = Photo::find(5); // find id to assign

    $stuff->photos()->save($photo); // assign

});

Route::get('/de-assigner', function (){
    $stuff = Staff::find(2); // Pick Stuff

    $stuff->photos()->whereid(5)->update(['path'=>'', 'imageable_id'=>'', 'imageable_type'=>'', 'created_at'=>'', 'updated_at'=>'']);

});
