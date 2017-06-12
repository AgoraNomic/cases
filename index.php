<?php

$ckey = PREG_REPLACE("/[^0-9a-zA-Z]/i", '', array_keys($_GET)[0]);

if (!(strlen($ckey)>=1 && strlen($ckey)<=5)){
   //echo "$ckey is not a key";
   echo file_get_contents("main_table.html");
   }
else{
   //echo "$ckey is key";
   if (!file_exists("./$ckey")){echo file_get_contents("main_table.html");}
   else{
       $clist = file("out.csv", FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
       $key = array_search("$ckey", $clist); //echo "$key $ckey";
       $pk=max(0,$key-1); $next=$clist[$pk];
       $nk=min(count($clist)-1,$key+1); $prev=$clist[$nk];
       echo "
        <html><head><title>CFJ $ckey</title>
        <style>
            body {
              font-family: monospace;
            }
          table{
              font: 1em/1.2 \"Helvetica Neue\", Helvetica, Arial, Geneva, sans-serif;
              border-collapse: collapse;
              width: 550px;
          }         
         a:link     {text-decoration: none;  color: white;}
         a:visited  {text-decoration: none;  color: white;}
         td:hover {background-color: #666;}
 td {
    border: 1px solid #ddd;
    padding: 8px;
    overflow: hidden;
    font-size: 1.2em;
    text-align: center;
    background-color: #444;
    color: white;
}
.indx{text-align:left; vertical-align:bottom; font-size:100%;}
.prev{text-align:right; vertical-align:bottom; font-size:85%;}
.next{text-align:left; vertical-align:bottom; font-size:85%;}
.text{text-align:right; vertical-align:bottom; font-size:100%;}

td a{
  display: block;
  margin: -10cm;
  padding: 10cm;
}
         </style>
         </head>
         <body>
         <table><tr>
         <td class=\"indx\"><a href=\"./#$next\">Index</a></td>
         <td class=\"prev\"><a href=\"./?$prev\"><b>&larr;&nbsp;$prev</b></a></td>
         <td><a href=\"./?${ckey}\"><b>CFJ $ckey</b></a></td>
         <td class=\"next\"><a href=\"./?$next\"><b>$next&nbsp;&rarr;</b></a></td>
         <td class=\"text\"><a href=\"./${ckey}\">text</a></td>
         </tr></table>";
       echo "<pre>\n"; 
       echo file_get_contents("./$ckey");
       echo "</pre></body></html>";
   }
}

?>