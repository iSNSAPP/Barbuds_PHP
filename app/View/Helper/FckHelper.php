<?php
App::import('Vendor', 'fckeditor');

class FckHelper extends AppHelper { 
               
    /**
    * creates an fckeditor textarea
    * 
    * @param array $namepair - used to build textarea name for views, array('Model', 'fieldname')
    * @param stirng $basepath - base path of project/system
    * @param string $content
    */
    public function fckeditor($namepair = array(), $basepath = '', $content = '',$width='100%',$height='200'){
        $editor_name = 'data';
        foreach ($namepair as $name){
            $editor_name .= "[" . $name . "]";
        }

        $oFCKeditor = new FCKeditor($editor_name) ;
        $oFCKeditor->BasePath = $basepath . '/js/fckeditor/' ;
        $oFCKeditor->Value = $content ;
       
		
		///code by praveen
		$oFCKeditor->Height = $height;
		$oFCKeditor->Width = $width;      
		
		$oFCKeditor->Create() ;      
    }      
}  
?>