<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\AllWordsFromTable;


class ProcessingUserInputtedText extends Controller {
    /*sendDataToView() gives an access to the word column in words table from the appropriate model method*/
    public function gettingDataFromModel() {

        $allWordsFromTable = AllWordsFromTable::gettingAllWordsFromTable();

        return $allWordsFromTable;
    }
    /*checkingInputtedWords() takes user's text via AJAX and starts comparing each word with table's words*/
    public function checkingInputtedWords(Request $request) {

        $request->validate([

            'message' => 'required|string',

        ]);

        $receivingUserTypedText = $request->input("message");

        /*Taking user's text trimming and turning to lowercase, ass all the words in the table are lowercase*/
        $userTypedText = mb_convert_case(trim($receivingUserTypedText), MB_CASE_LOWER, "UTF-8");

        /*Making an array with user's text's words*/
        $turningUserTextToArray = explode(" ", $userTypedText);

        /*This is what will be returned to the text box*/
        $whatUserGets = '';

        $allWordsFromTable = $this->gettingDataFromModel();

        $wordsFromTableAsArray = [];

        /*adding table's words from its original object as an array $wordsFromTableAsArray elements*/
        foreach ($allWordsFromTable as $word){

            $wordsFromTableAsArray[] = $word->word;

        }

        /*checking if the user's typed text's words are in our words' table or no*/
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


