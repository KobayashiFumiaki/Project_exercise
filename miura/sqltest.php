<html><head><meta charset="utf-8" /><title>SQLテスト</title></head>
    <body bgcolor ="#f0f0f0"><?php
    //SQLの表示フォームを表示
    $query = iseet($_GET["query"]) ? $_GET["query"] : "";
    $q_html = htmlspecialchars($query);
    echo <<<__FORM__
   <form><div>SQLを以下に記述:</div>
   <textarea name="query" rows="5" cols="70">{$q_html}</textarea>
   <div><in
    
    
   ;
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

