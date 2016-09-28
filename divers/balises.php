<?php

function lien($link, $texte, $attributes=array()) {
    $html = "<a href='$link'";
    
    foreach($attributes as $type=>$data){
        $html .= ' '.$type.'="'.$data.'"';
    }
    
    $html .= ">$texte</a>";
    return $html;
}

function item($contenu, $attributes=array()) {
    $html = "<li";
    
    foreach($attributes as $type=>$data){
        $html .= ' '.$type.'="'.$data.'"';
    }
    
    $html .= ">$contenu</li>";
    return $html;
}

function table($table) {
    
    $html = "";
    
    foreach( $table as $ligne ) {
        $html .= "<tr>";
        
        foreach ( $ligne as $type=>$data) {
            
            $html .= "<td>$data</td>";
                
        }
        
        $html .= "</tr>";
    }
    
    return $html;
}

function input($type, $name, $attributes=array()) {
    $html = "<input type='$type' name='$name'";
    
    foreach($attributes as $type=>$data){
        $html .= ' '.$type.'="'.$data.'"';
    }
    
    $html .= " />";
    return $html;
}

function select($name, $tab) {
    
    $html = "<select name='$name'>";
    
    foreach($tab as $type=>$data){
        $html .= ' <option value='.$type;        
        $html .= ">$data</option>";
    }
    
    $html .= "</select>";
    return $html;    
}

function renderArray($array) {
    echo '<pre>';
    print_r($array);
    echo '</pre>';
}

?>