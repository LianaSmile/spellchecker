<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;



class StudViewController extends Controller {
    public function index() {
        return DB::table("words")->select("word")->get()->toArray();

    }
    public function contactUs(Request $request) {
        $request->validate([
            'message' => 'required|string',
        ]);
        $typedText=$request->input("message");

        $typedText = mb_convert_case(trim($typedText), MB_CASE_LOWER, "UTF-8");

        $arrayText = explode(" ", $typedText);
        $finalText='';
        $onlyWords=[];
        $allWords=$this->index();
        foreach ($allWords as $word){
            $onlyWords[]=$word->word;
        }

        for($i=0;$i<count($arrayText);$i++){
            if(!is_numeric($arrayText[$i])){
                if(!in_array($arrayText[$i],$onlyWords)){

                    $output=$arrayText[$i];
                    $input = $onlyWords;
                    $similar=[];

                    foreach($input as $word) {
                        similar_text($word,$output,  $percent);
                        if ($percent>70) {
                            $similar[]= $word;
                        }
                    }

                    sort($similar);
                    $finalText.= "<span class='wrong' id='id$i'> ";
                    $finalText.= ''.$arrayText[$i].'';
                    $finalText.= '<div class="box" style="border: 2px solid #1a202c; border-radius: 5px;  background-color: #718096; width: auto;height: auto; padding: 30px; display: none;">
                      <select style="font-size: 10px; padding: 2px; background-color: #1a202c; color: #a0aec0;" name="cars" class="options">';
                        if(count($similar)>0):
                        foreach ($similar as $word) :
                            $finalText.= '<option value="'.$word.'">'.$word.'</option>';
                        endforeach;
                        endif;
                        if(count($similar)==0):
                            $finalText.= '<option value="volvo">Նման բառ չի գտնվել :(</option>';
                        endif;
                   $finalText.= " </select>
                     <button style='font-size: 15px; padding: 6px; background-color: #1a202c; color: #a0aec0; font-weight: bold;' class='id$i' type='button'>Ընտրել</button>
                     </div></span>"." ";



                }
                else{
                    $finalText.=$arrayText[$i].' ';
                }
            }
            else{
                $finalText.=$arrayText[$i].' ';
            }

        }

        return response()->json([$finalText]);
    }
}


