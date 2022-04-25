<?php

namespace App\Models;

use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categories extends Controller
{
    use HasFactory;
   
   
   
   public function children ()
   {
       return $this->hasMany(Categories::class, 'parent_id');
   }

   public function post ()
   {
       return $this->hasMany(post::class);
   }

   public function up()
   {
       Schema::create('categories', function (Blueprint $table) {
           $table->increments('id');
           $table->string('category_name');
           $table->integer('parent_id');            
           $table->timestamps();
       });
   }

}


