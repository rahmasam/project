<?php

function confirm_query($result,$query){
    global $dbc;
    if (!$result){
        die('Query {$query} \n<br> MYSQL Error: '.mysqli_error($dbc));
    }
}

function validate_id($id){
    if (isset($id)&& filter_var($id,FILTER_VALIDATE_INT,array('min_array' => 1))) {
        $val_id = $id;
        return $val_id;
    }else{
        return NULL;
    }
}

function has_permission($account,$permission){
    global $dbc;
    $q = "SELECT * FROM users JOIN roles USING (role_id) WHERE user_account = '{$account}'";
    $r = mysqli_query($dbc,$q);
    if (mysqli_num_rows($r) >= 1){
        return true;
    }else{
        return false;
    }
}

function Clean($input){

    return  trim(strip_tags(stripslashes($input)));
}
function Validate($input,$flag,$length = 6){

    $status = true;

     switch ($flag) {
         case 1:
             # code...
             if (empty($input)) {
                $status = false;
             }
             break;
      
        case 2: 
         # code .... 
         if (!filter_var($input, FILTER_VALIDATE_EMAIL)){
            $status = false;
         } 
          break;


        case 3: 
           #code .... 
           if (strlen($input) < $length){
               $status = false;
           }  
           break;
 

        case 4: 
         # code .... 
         if (!filter_var($input, FILTER_VALIDATE_INT)){
            $status = false;
         } 
          break;    



          case 5: 
           #code .... 
           if(!preg_match('/^01[0-2,5][0-9]{8}$/',$input)){
               $status = false;
           }  
           break;  




           case 6: 
              #code .... 
              if(!preg_match('/^[a-zA-Z\s]*$/',$input)){
                 $status = false;
              }
              break;


            case 7: 
            # Code ....
            $allowedExt = ['png','jpg']; 
                 if(!in_array($input,$allowedExt)){
                    $status = false;
                 }
            break;

     }

     return $status;

  }


?>