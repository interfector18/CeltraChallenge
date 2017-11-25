<?php 

/*
    tb_centura - textbox s centura kodom
    tb_javascript - textbox s javascript kodom
*/
global $tb_centura;
$tb_centura = file("input.txt");
// $fh = fopen("input.txt", "r");
// while (($redak=fgets($fh, 4096))!=false)
// {
//     $tb_centura []= $redak;
// }

// foreach($tb_centura as $l)
//     echo $l."<br>";

// fclose($fh);

global $tb_javascript; 
$tb_javascript = array();
$tb_javascript = $tb_centura;

function convert(){
    global $tb_javascript;
    global $tb_centura;
    // $tb_javascript = $tb_centura;

    ReplaceFunction('\t', "  ", '');
    foreach($tb_javascript as $l1)
    {
        echo $l1.'<br>';
    }
    echo '<br>------------------<br>';
    ReplaceFunction("Function:", "public void ", '() {\n');
    foreach($tb_javascript as $l1)
    {
        echo $l1.'<br>';
    }
    echo '<br>------------------<br>';
    ReplaceFunction("Call ", "", ";");
    foreach($tb_javascript as $l1)
    {
        echo $l1.'<br>';
    }
    echo '<br>------------------<br>';
    ReplaceFunction("FALSE", "false", "");
    foreach($tb_javascript as $l1)
    {
        echo $l1.'<br>';
    }
    echo '<br>------------------<br>';
    ReplaceFunction("TRUE", "true", "");
    foreach($tb_javascript as $l1)
    {
        echo $l1.'<br>';
    }
    echo '<br>------------------<br>';
    ReplaceFunction(" Return", " return", ";");
    foreach($tb_javascript as $l1)
    {
        echo $l1.'<br>';
    }
    echo '<br>------------------<br>';
    ReplaceFunction(" Else If", " else if {", "}");
    foreach($tb_javascript as $l1)
    {
        echo $l1.'<br>';
    }
    echo '<br>------------------<br>';
    ReplaceFunction(" Else", " else {", "");
        foreach($tb_javascript as $l1)
    {
        echo $l1.'<br>';
    }
    echo '<br>------------------<br>';
    ReplaceFunction(" Break", " break", ";");
    foreach($tb_javascript as $l1)
    {
        echo $l1.'<br>';
    }
    echo '<br>------------------<br>';
    // ReplaceFunction("Number:", "$", ";");
    // ReplaceFunction("Boolean", "$", ";");
    // ReplaceFunction("String", "$", ";");
    ReplaceFunction("Set ", "", ";");
    foreach($tb_javascript as $l1)
    {
        echo $l1.'<br>';
    }
    echo '<br>------------------<br>';
    ReplaceFunction("If ", "if (", "");
    foreach($tb_javascript as $l1)
    {
        echo $l1.'<br>';
    }
    echo '<br>------------------<br>';
    ReplaceFunction("( )", "()", "");
    foreach($tb_javascript as $l1)
    {
        echo $l1.'<br>';
    }
    echo '<br>------------------<br>';
    ReplaceFunction("(  )", "()", "");
    foreach($tb_javascript as $l1)
    {
        echo $l1.'<br>';
    }
    echo '<br>------------------<br>';
    ReplaceFunction("(   )", "()", "");
    foreach($tb_javascript as $l1)
    {
        echo $l1.'<br>';
    }
    echo '<br>------------------<br>';
    ReplaceFunction('Description', '/*\nDescription', '');
    foreach($tb_javascript as $l1)
    {
        echo $l1.'<br>';
    }
    echo '<br>------------------<br>';
    ReplaceFunction('  Actions', '  Actions\n*/', '');
    foreach($tb_javascript as $l1)
    {
        echo $l1.'<br>';
    }
    echo '<br>------------------<br>';
    ReplaceFunction("'", '"', '');
    foreach($tb_javascript as $l1)
    {
        echo $l1.'<br>';
    }
    echo '<br>------------------<br>';

    foreach($tb_javascript as $l1)
    {
        echo $l1.'<br>';
    }
    echo '<br>------------------<br>';

    IfAndOr();
    CloseFunctions();
    IfFunctionFix();
    IfFunctionsCommented();
    IfFunctionsClosing();
    ReplaceFunction(' ! ', ' // ! ', '');
    CommentingCodeFromString('SalWaitCursor');


    SelectLine();
    Klase();
    AccessingData();
    Deletelines();

    // PROTOTIP
    $path = "output.txt";
    $fh = fopen($path, "w");
    flock($fh,LOCK_EX);
    foreach($tb_javascript as $line)
        fwrite($fh, $line);
    flock($fh, LOCK_UN);
    fclose($fh);
}

function AccessingData()
{
    global $tb_centura;
    global $tb_javascript;
    $lines = array(); 
    $lines = $tb_javascript;
    for ($vv = 0; $vv < count($lines); $vv++)
    {
        $line = $lines[$vv];
        if (strpos($line, 'SELECT') && strpos($line, 'FROM'))
        {
                $indexFROM = strrpos(trim($line), 'FROM');//line.Trim().IndexOf("FROM");
                $textLength = strlen(trim($line));// $textLength = line.Trim().Length;
                $line = trim($line);//line.Trim();
                $temp = substr($line,$indexFROM, $textLength - $indexFROM);//line.Substring(indexFROM, textLength - indexFROM);
                $tempCopy = substr(trim($line),0, $indexFROM).' \n        + '.$temp.'"';//"        "+line.Trim().Substring(0, indexFROM) + "\u0022 \n        + \u0022" + temp + "\u0022";
                $lines[$vv] = $tempCopy;
                if (strpos($lines[$vv], ';'))
                {
                    $lines[$vv] = str_replace($lines[$vv],';', '');//$lines[$vv].Replace(";", "");
                }
                if (strpos($lines[$vv + 2], '}'))//.Contains("}"))
                {
                    $lines[$vv + 2] = str_replace($lines[$vv + 1],'}', '');//$lines[$vv + 1].Replace("}", "");
                }

                    for ($nn = $vv+1; $nn < count($lines); $nn++)
                    {
                        if (strpos($lines[$nn], 'AND') || strpos($lines[$nn], 'WHERE'))//$lines[$nn].Contains("AND") || $lines[$nn].Contains("WHERE"))
                        {
                            $lines[$nn] = '        +"'.trim($lines[$nn]);//$lines[$nn].Trim() ;

                            if (strpos($lines[$nn], ';'))//$lines[$nn].Contains(";"))
                            {
                                $lines[$nn] = str_replace($lines[$vv],';', '');//$lines[$vv].Replace(";", "");
                            }
                            if (strpos($lines[$nn], '}'))//$lines[$nn].Contains("}"))
                            {
                                $lines[$nn] = str_replace($lines[$vv],'}', '');//$lines[$vv].Replace("}", "");
                            }
                        }
                        if (strpos($lines[$nn], 'INTO') && !strpos($lines[$nn], 'AND') && !strpos($lines[$nn], 'WHERE'))//$lines[$nn].Contains("INTO") && !$lines[$nn].Contains("AND") && !$lines[$nn].Contains("WHERE"))
                        {
                            $lines[$nn] = '        // + "'.trim($lines[$nn]).'"';//$lines[$nn].Trim() + "\u0022";
                            $lines[$nn - 1] = $lines[$nn - 1].';';
                        
                        }
                    }
            }
        }
    $tb_javascript = $lines;
}          



function Klase()
{
    global $tb_javascript;
    $lines = array();
    $lines = $tb_javascript;
    for ($gg = 0; $gg < count($lines); $gg++)
    {
        $line = $lines[$gg];
        if (strpos($line, 'Form Window: '))//line.Contains("Form Window: "))
        {
            for ($pp = $gg+1; $pp < count($lines); $pp++)
            {
                $line1 = $lines[$pp];
                if (substr($line1, 0, 7) === 'Class: ')//line1.Trim().StartsWith("Class: "))
                {   
                    $l1 = str_replace($line,'Form Window: ', 'public class ');
                    $l2 = str_replace(trim($line),'Class: ', ' extends ');
                    $temp3 = $l1.$l2;//line.Replace("Form Window: ", "public class ") + line1.Trim().Replace("Class: ", " extends ");
                    echo $temp3.'<br>';
                    $lines[$pp] = $temp3.' {';
                    $temp4 = $lines[$pp];
                    //System.Windows.Forms.Clipboard.SetText($lines[$pp]);
                    
                    for ($ll = $pp + 1; $ll < count($lines); $ll++)
                    {
                        if (substr(trim($lines[$ll]), 0, 2) === "/*")//$lines[$ll].Trim().StartsWith("/*"))
                        {
                            $index1 = count($lines);
                            $lines[$ll] = $temp4."\n".$lines[$ll];
                            $lines[$index1 - 1] = $lines[$index1 - 1]."\n}";
                            $tb_javascript = $lines;
                            return;
                        }
                    }                          
                }
            }
        }
    }            
}

function CommentingCodeFromString($find)
{
    global $tb_javascript;
    $lines = array();
    $lines = $tb_javascript;
    for ($cc = 0; $cc < count($lines); $cc++)
    {
        $line = $lines[$cc];
        if (contains($line, $find) && !contains($line, " !"))
        {
            $line = "//".$line;
            $lines[$cc] = $line;
        }
    }
    $tb_javascript = $lines;
}

// if (and/or)
function IfAndOr()
{
    global $tb_javascript;
    $lines = array();
    $lines = $tb_javascript;
    for ($dd = 0; $dd < count($lines); $dd++)
    {
        $line = $lines[$dd];
        if (strpos($line, 'if ('))//line.Contains("if ("))
        {
            if (strpos($line, ' and '))//line.Contains(" and "))
            {
                $line = str_replace($lines[$vv], ' and ', ' && ');// line.Replace(" and ", " && ");
            }
            if (strpos($line, ' or '))//line.Contains(" or "))
            {
                $line = str_replace($lines[$vv], ' or ', ' || ');//line.Replace(" or ", " || ");
            }
            $lines[$dd] = $line;
            
        }
        $tb_javascript = $lines;
    }
}

// MOVE PUBLIC VOID UNTER COMMENTS
global $tempCount;
$tempCount = 0;
function SelectLine()
{
    global $tb_javascript;
    global $tempCount;    
    $lines = array();
    $lines = $tb_javascript;
    for ($jj = 0; $jj < count($lines); $jj++)
    {
        $line = $lines[$jj];
        if (contains($line, 'public'))//line.Contains("public"))
        {
            $temp1 = "";
            $tmp = $line;
            $temp1 = $tmp;
            $line = "";

            $lines[$jj] = $line;
            $a = array();
            $a = $lines;
            MoveLine($jj,$a,$tmp);
            $jj = $tempCount;
        }
    }
}


function MoveLine($countlines, $list, $tmp)
{
    global $tempCount;
    $lines = array();
    $lines = $list;
    for ($jj = $countlines; $jj < count($lines); $jj++)
    {
        $line = $lines[$jj];
        if (contains($line, '*/'))//line.Contains("*/"))
        {
            $line = $line.'\n'.$tmp;
            $lines[$jj] = $line;
            $tb_javascript = $lines;
            $tempCount = $jj++;
            return;
        }
        $lines[$jj] = $line;
    }
}

 //REPLACE FUNCTIONS
function ReplaceFunction($OldString, $NewString, $EndLine)
{
    global $tb_javascript;
    $lines1 = array();
    $lines1 = $tb_javascript;
    for ($ii = 0; $ii < count($lines1); $ii++ )
    {
        $line = $lines1[$ii];
        if (contains($line, $OldString)/*.Contains(OldString)*/)
        {
            $line = str_replace($line, $OldString, $NewString) /*line.Replace(OldString, NewString)*/;
            if (strlen($EndLine) > 0)
            {
                $line = $line.$EndLine;
            }
            $lines1[$ii] = $line;
        }
    }
    $tb_javascript = $lines1;
}

//CLOSING FUNCTIONS WITH "}"
function CloseFunctions()
{
    global $tb_javascript;
    $temp = 0;
    $lines1 = array();
    $lines1 = $tb_javascript;
    for ($gg = 0; $gg < count($lines1); $gg++)
    {
        $line = $lines1[$gg];
        if (contains($line, 'public void'))//line.Contains("public void"))
        {
            $temp++;
            if ($temp>=2)
            {
                $line = str_replace($line, 'public void', '\n}\npublic void');//line.Replace("public void","\n}\npublic void");
            }
            $lines1[$gg] = $line;
        }
    }
    // if(count($lines1) >= 1)
        $lines1[count($lines1) - 1] = $lines1[count($lines1) - 1].'\n}';//$lines1[$lines1.Length - 1] = $lines1[$lines1.Length - 1] + "\n}";   
    $tb_javascript = $lines1;
}

//DELETING TEXT FROM BEGGINNING
function Deletelines()
{
    global $tb_javascript;
    $lines1 = array();
    $lines1 = $tb_javascript;
    for ($jj = 0; $jj < count($lines1); $jj++)
    {
        $line = $lines1[$jj];
        if (contains($line, 'Functions'))//line.Contains("Functions"))
        {
            $line = preg_replace( '/\r|\n/', '', $line );//line.Remove(0);
            $lines1[$jj] = $line;
            $tb_javascript = $lines1;
            return;
        }
        else
        {
            $line = preg_replace( '/\r|\n/', '', $line );//line.Remove(0);
            $lines1[$jj] = $line;
        }
    }
}

//Fixing if functions
function IfFunctionFix()
{
    $lines1 = array();
    global $tb_javascript;
    $lines1 = $tb_javascript;
    for ($nn = 0; $nn < count($lines1); $nn++)
    {
        $line = $lines1[$nn];
        if (strpos($line, 'if (') && strpos($line, ' != '))//line.Contains("if ("))
        {
            $line =  str_replace($line,'//', '');//line.Replace("//", "");
            $lines1[$nn] = $line;
        }
    }
    $tb_javascript = $lines1;
}

//Commented if functions 
function IfFunctionsClosing()
{
    global $tb_javascript;
    $linesRtb = array();
    $linesRtb = $tb_javascript;
    for ($yy = 0; $yy < count($linesRtb); $yy++)
    {
        $line = $linesRtb[$yy];
        if (startsWith(trim($line), 'if'))
        {
            $tempCount = 0;
            for ($xx = 0; $xx < strlen($line); $xx++)
            {
                if ($line[$xx] == ' ')
                {
                    $tempCount++;
                }
                else { break; }
            }

            $tempCount2 = 0;
            $nextLine = $linesRtb[$yy + 1];
            for ($xx = 0; $xx < strlen($nextLine); $xx++)
            {
                if ($nextline[$xx] == ' ')
                {
                    $tempCount2++;
                }
                else { break; }
            }
            if ($tempCount2 > $tempCount && contains($linesRtb[$yy + 1], ';') && (!contains($linesRtb[$yy + 1], ';')))
            {
                $linesRtb[$yy] = $linesRtb[$yy].' '.trim($linesRtb[$yy+1]);
                $linesRtb[$yy + 1] = '';
                $yy = $yy + 1;
            }
        }
    }
    $tb_javascript = $linesRtb;
    IfFunctionsFinish();
}

function IfFunctionsFinish()
{
    global $tb_javascript;
    $linesRtb = array();
    $linesRtb = $tb_javascript;
    for ($aa = 0; $aa < count($linesRtb); $aa++)
    {
        $line = $linesRtb[$aa];
        if (startsWith(trim($line),'if'))//.Trim().StartsWith("if ("))
        {
            $linesRtb[$aa] = $linesRtb[$aa].') {';

            $tempCount = 0;
            for ($hh = 0; $hh < strlen($line)/*.Length*/; $hh++)
            {
                if ($line[$hh] == ' ')
                {
                    $tempCount++;
                }
                else { break; }
            }

            $tempCount2 = 0;
            $nextLine = $linesRtb[$aa + 1];
            for ($xx = 0; xx < $nextLine; $xx++)
            {
                if ($nextline[$xx] == ' ')
                {
                    $tempCount2++;
                }
                else { break; }
            }
            if ($tempCount2 > $tempCount )
            {
                $linesRtb[$aa + 1] = $linesRtb[$aa + 1]."\n}";
                $aa = $aa + 1;
            }
        }
        if (startsWith(trim($line),'else ')/*line.Trim().StartsWith("else ")*/)
        {
           

            $tempCount = 0;
            for ($hh = 0; $hh < strlen($line); $hh++)
            {
                if ($line[$hh] == ' ')
                {
                    $tempCount++;
                }
                else { break; }
            }

            $tempCount2 = 0;
            $nextLine = $linesRtb[$aa + 1];
            for ($xx = 0; $xx < strlen($nextLine); $xx++)
            {
                if ($nextline[$xx] == ' ')
                {
                    $tempCount2++;
                }
                else { break; }
            }
            if ($tempCount2 > $tempCount)
            {
                $linesRtb[$aa + 1] = $linesRtb[$aa + 1] + '\n}';
                $aa = $aa + 1;
            }
        }

    }
    $tb_javascript = $linesRtb;
}

function IfFunctionsCommented()
{
    $lines2 = array();
    global $tb_javascript;
    $lines2 = $tb_javascript;
    for ($nn = 0; $nn < count($lines2); $nn++)
    {
        $line = $lines2[$nn];
        if (startsWith(trim($line), '!'))//line.Trim().StartsWith("!"))
        {
            $tempCount = 0;
            for ($xx = 0; $xx < count($line); $xx++)
            {
                if ($line[$xx] === ' ')
                {
                    $tempCount++;
                }
                else { break; }
            }

            $tempCount2 = 0;
            $nextLine = $lines2[$nn + 1];
            for ($xx = 0; $xx < count($nextLine); $xx++)
            {
                if ($nextline[$xx] === ' ')
                {
                    $tempCount2++;
                }
                else { break; }
            }
            if ($tempCount2 > $tempCount)
            {
                $l1 = substr($lines2[$nn + 1], 0, $tempCount);
                $l2 = substr($lines2[$nn + 1], $tempCount, (strlen($lines2[nn + 1]) - $tempCount));
                $lines2[$nn + 1] = $l1.'//'.$l2;//$lines2[nn + 1].Substring(0, tempCount) + "//" + $lines2[nn + 1].Substring(tempCount, $lines2[nn + 1].Length - (tempCount));
                $nn = $nn + 1;
            }
        }
    }
    $tb_javascript = $lines2;
}

function startsWith($haystack, $needle) 
{
  $length = strlen($needle);
  return (substr($haystack, 0, $length) === $needle);
}

function contains($text, $word)
{
    if (strpos($text, $word) !== false) 
    {
        return false;
    } 
    else
    {
        return true;
    }
}

?>