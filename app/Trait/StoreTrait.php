<?php
namespace App\Traits;

trait StoreTrait{

public function res($message, $code, $status){
    if($status == true){
        return response()->json(['success'=>"successful", 'message'=>$message], $code);
    }else{
        return response()->json(['success'=>"error", 'message'=>$message], $code);

    }
}


}


?>
