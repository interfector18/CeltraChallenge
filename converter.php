<?php 

/*
    tb_centura - textbox s centura kodom
    tb_javascript - textbox s javascript kodom
*/
$tb_centura = $_POST['tb_centura'];
$tb_javascript = $_POST['tb_javascript'];

function convert(){

    ReplaceFunction("\t", "  ", "");
    ReplaceFunction("Function:", "public void ", "() {\n");
    ReplaceFunction("Call ", "", ";");
    ReplaceFunction("FALSE", "false", "");
    ReplaceFunction("TRUE", "true", "");
    ReplaceFunction(" Return", " return", ";");
    ReplaceFunction(" Else If", " else if {", "}");
    ReplaceFunction(" Else", " else {", "");
    ReplaceFunction(" Break", " break", ";");
    // ReplaceFunction("Number:", "$", ";");
    // ReplaceFunction("Boolean", "$", ";");
    // ReplaceFunction("String", "$", ";");
    ReplaceFunction("Set ", "", ";");
    ReplaceFunction("If ", "if (", "");
    ReplaceFunction("( )", "()", "");
    ReplaceFunction("(  )", "()", "");
    ReplaceFunction("(   )", "()", "");
    ReplaceFunction("Description", "/*\nDescription", "");
    ReplaceFunction("  Actions", "  Actions\n*/", "");
    ReplaceFunction("'", "\u0022", "");
    IfAndOr();
    CloseFunctions();
    IfFunctionFix();
    IfFunctionsCommented();
    IfFunctionsClosing();
    ReplaceFunction(" ! ", " // ! ", "");
    CommentingCodeFromString("SalWaitCursor");


    SelectLine();
    Klase();
    AccessingData();
    Deletelines();

}

function AccessingData()
{
    $lines = array(); 
    $lines = $_POST['tb_centura'];
    for ($vv = 0; $vv < count($lines); $vv++)
    {
        $line = $lines[$vv];
        if (strpos($a, 'SELECT') && strpos($a, 'FROM'))
        {
                $indexFROM = strrpos(trim($line), 'FROM');//line.Trim().IndexOf("FROM");
                $textLength = strlen(trim($line));// $textLength = line.Trim().Length;
                $line = trim($line);//line.Trim();
                $temp = substr($line,$indexFROM, $textLength - $indexFROM);//line.Substring(indexFROM, textLength - indexFROM);
                $tempCopy = substr(trim($line),0, $indexFrom)."\u0022 \n        + \u0022" + $temp + "\u0022";//"        "+line.Trim().Substring(0, indexFROM) + "\u0022 \n        + \u0022" + temp + "\u0022";
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
                            $lines[$nn] = "        +\u0022".trim($lines[$nn]);//$lines[$nn].Trim() ;

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
                            $lines[$nn] = "        // + \u0022".trim($lines[$nn])."\u0022";//$lines[$nn].Trim() + "\u0022";
                            $lines[$nn - 1] = $lines[$nn - 1].";";
                        
                        }
                    }
            }
        }
        $tb_javascript = $lines;
    
}          


$temp3;
function Klase()
{
    $lines = array();
    $lines = $tb_javascript;
    for ($gg = 0; $gg < $lines.Length; $gg++)
    {
        $line = $lines[$gg];
        if (line.Contains("Form Window: "))
        {
            for ($pp = $gg+1; $pp < $lines.Length; $pp++)
            {
                $line1 = $lines[$pp];
                if (line1.Trim().StartsWith("Class: "))
                {
                    $temp3 = line.Replace("Form Window: ", "public class ") + line1.Trim().Replace("Class: ", " extends ");
                    $lines[$pp] = $temp3 + " {";
                    System.Windows.Forms.Clipboard.SetText($lines[$pp]);
                    for ($ll = pp + 1; ll < $lines.Length; ll++)
                    {
                        if ($lines[$ll].Trim().StartsWith("/*"))
                        {
                            $index1 = $lines.Length;
                            $lines[$ll] = System.Windows.Forms.Clipboard.GetText() + "\n" + $lines[$ll];
                            $lines[$index1 - 1] = $lines[$index1 - 1] + "\n}";
                            rtb_JavaCode.lines = $lines;
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
    string[] $lines = rtb_JavaCode.lines;
    for ($cc = 0; cc < $lines.Length; cc++)
    {
        $line = $lines[$cc];
        if (line.Contains(find)&& !line.Contains(" !"))
        {
            line = "//" + line;
            $lines[$cc] = line;
        }
    }
    rtb_JavaCode.lines = $lines;
}

// if (and/or)
function IfAndOr()
{
    string[] $lines = rtb_JavaCode.lines;
    for ($dd = 0; dd < $lines.Length; dd++)
    {
        $line = $lines[$dd];
        if (line.Contains("if ("))
        {
            if (line.Contains(" and "))
            {
                line = line.Replace(" and ", " && ");
            }
            if (line.Contains(" or "))
            {
                line = line.Replace(" or ", " || ");
            }
            $lines[$dd] = line;
            
        }
        rtb_JavaCode.lines = $lines;
    }
}

// MOVE PUBLIC VOID UNTER COMMENTS
function SelectLine()
{
    string[] $lines = rtb_JavaCode.lines;
    for ($jj = 0; jj < $lines.Length; jj++)
    {
        $line = $lines[$jj];
        if (line.Contains("public"))
        {
            $temp = line;
            System.Windows.Forms.Clipboard.SetText(temp);
            line = "";

            $lines[$jj] = line;
            string[] a = $lines;
            MoveLine(jj,a);
            jj = tempCount;
          
        }
    }
}

$tempCount= 0;
function MoveLine($count$lines,string[] list)
{
    string[] $lines = list;
    for ($jj = count$lines; jj < $lines.Length; jj++)
    {
        $line = $lines[$jj];
        if (line.Contains("*/"))
        {
            line = line +"\n" +System.Windows.Forms.Clipboard.GetText();
            $lines[$jj] = line;
            rtb_JavaCode.lines = $lines;
            tempCount = jj++;
            return;
        }
        $lines[$jj] = line;
        
    }
    
}

 //REPLACE FUNCTIONS
function ReplaceFunction($OldString,$NewString, $EndLine)
{
    string[] $lines1 = rtb_JavaCode.lines;
    for ($ii = 0; ii < $lines1.Length; ii++ )
    {
        $line = $lines1[ii];
        if (line.Contains(OldString))
        {
            line = line.Replace(OldString, NewString);
            if (EndLine.Length > 0)
            {
                line = line + EndLine;
            }
        
            $lines1[ii] = line;
        }
    }
    rtb_JavaCode.lines = $lines1;
}

//CLOSING FUNCTIONS WITH "}"
$temp;
function CloseFunctions()
{
    string[] $lines1 = rtb_JavaCode.lines;
    for ($gg = 0; gg < $lines1.Length; gg++)
    {
        $line = $lines1[gg];
        if (line.Contains("public void"))
        {
            temp++;
            if (temp>=2)
            {
                line = line.Replace("public void","\n}\npublic void");
            }
            $lines1[gg] = line;
        }
    }
    $lines1[$lines1.Length - 1] = $lines1[$lines1.Length - 1] + "\n}";
    rtb_JavaCode.lines = $lines1;
}

//DELETING TEXT FROM BEGGINNING
function Deletelines()
{
string[] $lines1 = rtb_JavaCode.lines;
for ($jj = 0; jj < $lines1.Length; jj++)
{
    $line = $lines1[jj];
    if (line.Contains("Functions"))
    {
        line = line.Remove(0);
        $lines1[jj] = line;
        rtb_JavaCode.lines = $lines1;
        return;
    }
    else
    {
        line = line.Remove(0);
        $lines1[jj] = line;
    }
}
}

//Fixing if functions
function IfFunctionFix()
{
    $lines1 = array();
    $lines1 = rtb_JavaCode.lines;
    for ($nn = 0; nn < $lines1.Length; nn++)
    {
        $line = $lines1[nn];
        if (line.Contains("if ("))
        {
            if (line.Contains(" != "))
            {
                line = line.Replace("//", "");
                $lines1[nn] = line;
            }
        }
    }
    rtb_JavaCode.lines = $lines1;
}

//Commented if functions 
function IfFunctionsClosing()
{
    $linesRtb = array();
    $linesRtb = rtb_JavaCode.lines;
    for ($yy = 0; yy < $linesRtb.Length; yy++)
    {
        $line = $linesRtb[yy];
        if (line.Trim().StartsWith("if"))
        {
            $tempCount = 0;
            for ($xx = 0; xx < line.Length; xx++)
            {
                if (line[$xx] == ' ')
                {
                    tempCount++;
                }
                else { break; }
            }

            $tempCount2 = 0;
            $nextLine = $linesRtb[yy + 1];
            for ($xx = 0; xx < nextLine.Length; xx++)
            {
                if (nextline[$xx] == ' ')
                {
                    tempCount2++;
                }
                else { break; }
            }
            if (tempCount2 > tempCount && $linesRtb[yy + 1].Contains(",") && (!$linesRtb[yy + 1].Contains(";")))
            {
                $linesRtb[yy] = $linesRtb[yy]+ " " + $linesRtb[yy+1].Trim();
                $linesRtb[yy + 1] = "";
                yy = yy + 1;
            }
        }
    }
    rtb_JavaCode.lines = $linesRtb;
    IfFunctionsFinish();
}

function IfFunctionsFinish()
{
    string[] $linesRtb = rtb_JavaCode.lines;
    for ($aa = 0; aa < $linesRtb.Length; aa++)
    {
        $line = $linesRtb[aa];
        if (line.Trim().StartsWith("if ("))
        {
            $linesRtb[aa] = $linesRtb[aa] + ") {";

            $tempCount = 0;
            for ($hh = 0; hh < line.Length; hh++)
            {
                if (line[$hh] == ' ')
                {
                    tempCount++;
                }
                else { break; }
            }

            $tempCount2 = 0;
            $nextLine = $linesRtb[aa + 1];
            for ($xx = 0; xx < nextLine.Length; xx++)
            {
                if (nextline[$xx] == ' ')
                {
                    tempCount2++;
                }
                else { break; }
            }
            if (tempCount2 > tempCount )
            {
                $linesRtb[aa + 1] = $linesRtb[aa + 1] + "\n}";
                aa = aa + 1;
            }
        }
        if (line.Trim().StartsWith("else "))
        {
           

            $tempCount = 0;
            for ($hh = 0; hh < line.Length; hh++)
            {
                if (line[$hh] == ' ')
                {
                    tempCount++;
                }
                else { break; }
            }

            $tempCount2 = 0;
            $nextLine = $linesRtb[aa + 1];
            for ($xx = 0; xx < nextLine.Length; xx++)
            {
                if (nextline[$xx] == ' ')
                {
                    tempCount2++;
                }
                else { break; }
            }
            if (tempCount2 > tempCount)
            {
                $linesRtb[aa + 1] = $linesRtb[aa + 1] + "\n}";
                aa = aa + 1;
            }
        }

    }
    rtb_JavaCode.lines = $linesRtb;
}

function IfFunctionsCommented()
{
    $lines2 = array();
    string[] $lines2 = rtb_JavaCode.lines;
    for ($nn = 0; nn < $lines2.Length; nn++)
    {
        $line = $lines2[nn];
        if (line.Trim().StartsWith("!"))
        {
            $tempCount = 0;
            for ($xx = 0; xx < line.Length; xx++)
            {
                if (line[$xx] == ' ')
                {
                    tempCount++;
                }
                else { break; }
            }

            $tempCount2 = 0;
            $nextLine = $lines2[nn + 1];
            for ($xx = 0; xx < nextLine.Length; xx++)
            {
                if (nextline[$xx] == ' ')
                {
                    tempCount2++;
                }
                else { break; }
            }
            if (tempCount2 > tempCount)
            {
                $lines2[nn + 1] = $lines2[nn + 1].Substring(0, tempCount) + "//" + $lines2[nn + 1].Substring(tempCount, $lines2[nn + 1].Length - (tempCount));
                nn = nn + 1;
            }
        }
    }
    rtb_JavaCode.lines = $lines2;
}

?>