<?php

/*
*   load wp-core functions
*/
require_once("../../../../wp-load.php");




function myAjaxFunc() {


        /*
        *   vars
        */
        $page_id = json_decode($_POST['postID']);
        $page_object = get_page( $page_id );
        $content = $page_object->post_content;
        $content = apply_filters('the_content', $content);
        
        
        /*
        *   remove characters to get correct number of words count
        */
        // remove &nbsp; from content string
        $content = preg_replace("/&#?[a-z0-9]{2,8};/i","",$content);
        // remove whitespaces after html tags from content string
        $content = str_replace('> ', '', $content);
        
        
        // return post content in json format
        if ( !empty( $page_object ) ){
            
            header("Content-type: application/json"); 
            echo json_encode( array('content' =>  $content) );
            
            return true;
            
        } else{
            
            return false;
            
        }
    
}




myAjaxFunc();