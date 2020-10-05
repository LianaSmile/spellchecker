<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\AllWordsFromTable;


class ProcessingUserInputtedText extends Controller {

    public function sendDataToView() {

        $allWordsFromTable = AllWordsFromTable::gettingAllWordsFromTable();

        return $allWordsFromTable;
    }

    public function checkingInputtedWords(Request $request) {

        $request->validate([

            'message' => 'required|string',

        ]);

        $receivingUserTypedText = $request->input("message");

        $typedText = mb_convert_case(trim($receivingUserTypedText), MB_CASE_LOWER, "UTF-8");

        $turningUserTextToArray = explode(" ", $receivingUserTypedText);

        $whatUserGets = '';

        $allWordsFromTable = $this->sendDataToView();

        $wordsFromTableAsArray = [];

        foreach ( $allWordsFromTable as $word){

            $wordsFromTableAsArray[] = $word->word;

        }

        for($i = 0;$i<count($turningUserTextToArray);$i++){

            if(!is_numeric($turningUserTextToArray[$i])){

                if(!in_array($turningUserTextToArray[$i],$wordsFromTableAsArray)){

                    $wordFromUsersText = $turningUserTextToArray[$i];

                    $wordFromTable = $wordsFromTableAsArray;

                    $similar = [];

                    foreach($wordFromTable as $word) {

                        similar_text($word,$wordFromUsersText,  $percent);

                        if ($percent > 70) {

                            $similar[] = $word;

                        }

                    }

                    sort($similar);

                    $whatUserGets.= "<span class='wrong' id='id$i'> ";

                    $whatUserGets.= ''.$turningUserTextToArray[$i].'';

                    $whatUserGets.= '<div class="box">

                      <select class="options">';

                        if(count($similar) > 0):

                        foreach ($similar as $word) :

                            $whatUserGets.= '<option value="'.$word.'">'.$word.'</option>';

                        endforeach;

                        endif;

                        if(count($similar) == 0):

                            $whatUserGets.= '<option value="'.$word.'">Նման բառ չի գտնվել :(</option>';

                        endif;

                   $whatUserGets.= " </select>

                     <button class='id$i choose' type='button'>Ընտրել</button>

                     </div></span>"." ";

                }
                else{

                    $whatUserGets.= $turningUserTextToArray[$i].' ';
                }
            }

        }

        return response()->json([$whatUserGets]);
    }

}


