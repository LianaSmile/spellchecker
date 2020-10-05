<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class AllWordsFromTable extends Model
{
    use HasFactory;

    public static function gettingAllWordsFromTable() {

        return DB::table("words")->select("word")->get()->toArray();

    }

}
