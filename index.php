<?php
//===============================================
// Simple HTML Encoder
// by Dan Guinn
// WARNING: NOT FOR USAGE ON A LIVE SERVER!
//===============================================

if(isset($_POST["code"])){
  //$unencoded=$_POST["code"]; //Enabled and disable the next line to display original code in textarea (not for live usage!!!)
  $unencoded="";
}else{
  $unencoded="";
}

if(isset($_POST["aggressive"]) && $_POST["aggressive"]=="on"){
  $aggressive="checked";
}else{
  $aggressive="";
}

$message="<p><small>This code was encoded with Simple HTML encoder, also written by Dan Guinn. "
."You can get it on <a href='https://github.com/nuntius-rex/simple-html-encoder'>Github</a></small></p>";

echo "<h1>Simple HMTL Encoder by Dan Guinn</h1><form method='POST'>"
."<textarea name='code' style='width:90%; height:30%'>".$unencoded."</textarea>"
."<br><small>Aggressive?</small> <input type='checkbox' name='aggressive' ".$aggressive.">"
."<br><br><input type='submit' value='Submit'/>"
."<input type='Button' value='Reload' onClick=\"window.location.href='';\"/>"
."</form>";

if(isset($_POST["code"])){
  //echo "<hr><textarea style='width:90%; height:30%'>".htmlspecialchars($_POST["code"], ENT_QUOTES, "UTF-8")."</textarea>";
  ini_set("highlight.html", "#808080");

  if(isset($_POST["aggressive"]) && $_POST["aggressive"]=="on"){
    highlight_string(aggressiveEncode(htmlspecialchars($_POST["code"]), ENT_QUOTES, "UTF-8"));
  }else{
    highlight_string(htmlspecialchars($_POST["code"], ENT_QUOTES, "UTF-8"));
  }
}

function aggressiveEncode($encode_chars) {
    $searches = array('%','(',')','{', '}'," ", "\n");
    $replacements = array("&#37;","&#40;","&#41;", "&#123;", "&#125;","&nbsp;", "<br/>" );
    $encoded = str_replace($searches, $replacements,$encode_chars);
    return $encoded;
}
?>
