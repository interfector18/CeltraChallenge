<?php 

/*
gCenturaCode - textbox s centura kodom
gJavaCode - textbox s javascript kodom
*/

global $gCenturaCode;
global $gJavaCode;
$gCenturaCode = $_POST['jsCenturaCode'];
// $gCenturaCode = $_POST['gCenturaCode'];
$gJavaCode = $gCenturaCode;
convert();

// echo $gJavaCode;

function convert()
{

    global $gCenturaCode;
    global $gJavaCode;
    $gJavaCode = explode("\n", $gJavaCode);

    //CONVERTING CODE TO JAVA
    $gJavaCode = ReplaceFunction("\r\n", "", "", $gJavaCode);
    $gJavaCode = ReplaceFunction("\n", "", "", $gJavaCode);
    $gJavaCode = ReplaceFunction("\t", "  ", "", $gJavaCode);    
    $gJavaCode = ReplaceFunction("Function:", "public void ", "() {\n", $gJavaCode);
    $gJavaCode = ReplaceFunction("Call ", "", ';', $gJavaCode);    
    $gJavaCode = ReplaceFunction("FALSE", "false", '', $gJavaCode);    
    $gJavaCode = ReplaceFunction("TRUE", "true", "", $gJavaCode);    
    $gJavaCode = ReplaceFunction(" Return", " return", ";", $gJavaCode);    
    $gJavaCode = ReplaceFunction(" Else If", " else if {", "}", $gJavaCode);    
    $gJavaCode = ReplaceFunction(" Else", " else {", "", $gJavaCode);        
    $gJavaCode = ReplaceFunction(" Break", " break", ";", $gJavaCode);    
    //ReplaceFunction("Number:", "int ", ";");
    //ReplaceFunction("Boolean", "bool ", ";");
    //ReplaceFunction("String", "string ", ";");
    $gJavaCode = ReplaceFunction("Set ", "", ";", $gJavaCode);    
    $gJavaCode = ReplaceFunction("If ", "if (", "", $gJavaCode);    
    $gJavaCode = ReplaceFunction("( )", "()", "", $gJavaCode);    
    $gJavaCode = ReplaceFunction("(  )", "()", "", $gJavaCode);    
    $gJavaCode = ReplaceFunction("(   )", "()", "", $gJavaCode);    
    $gJavaCode = ReplaceFunction("Description", "/*\nDescription", "", $gJavaCode);
    $gJavaCode = ReplaceFunction("  Actions", "  Actions\n*/", "", $gJavaCode);
    $gJavaCode = ReplaceFunction("'", "\"", "", $gJavaCode);    
    $gJavaCode = IfAndOr($gJavaCode);    
    $gJavaCode = CloseFunctions($gJavaCode);    
    $gJavaCode = IfFunctionFix($gJavaCode);    
    $gJavaCode = IfFunctionsCommented($gJavaCode);    
    $gJavaCode = IfFunctionsClosing($gJavaCode);    
    $gJavaCode = ReplaceFunction(" ! ", " // ! ", "", $gJavaCode);    
    $gJavaCode = CommentingCodeFromString("SalWaitCursor", $gJavaCode);    


    $gJavaCode = SelectLine($gJavaCode);
    $gJavaCode = ClassFunct($gJavaCode);
    $gJavaCode = AccessingData($gJavaCode);
    $gJavaCode = DeleteLines($gJavaCode);



    $gJavaCode = ReplaceFunction("\n", "\r\n", "", $gJavaCode);
    $gJavaCode = implode("\r\n", $gJavaCode);

    
    // $path = "output.txt";
    // $fh = fopen($path, "w");
    // flock($fh,LOCK_EX);
    // fwrite($fh, json_encode($gJavaCode));
    // // echo json_encode($gJavaCode);
    // flock($fh, LOCK_UN);
    // fclose($fh);
}


function AccessingData($inputLines)
{
    for($i = 0; $i < count($inputLines) - 2; $i++)
    {
        $line = $inputLines[$i];
        if (contains($line, "SELECT") && contains($line, "FROM"))
        {
            $indexFROM = strpos(trim($line), "FROM");
            $textLength = strlen(trim($line));
            $line = trim($line);
            $temp = substr($line, $indexFROM, $textLength - $indexFROM);
            $tempCopy = "        " . substr(trim($line), 0, $indexFROM) . "\" \n        + \"" . $temp . "\"";
            $inputLines[$i] = $tempCopy;
            if (contains($inputLines[$i],";"))
            {
                $inputLines[$i] = str_replace(";", "", $inputLines[$i]);
            }
            if (contains($inputLines[$i + 2], "}"))
            {
                $inputLines[$i + 2] = str_replace("}", "", $inputLines[$i + 1]);
            }
            
            for ($j = $i + 1; $j < count($inputLines); $j++)
            {
                if (contains($inputLines[$j], 'AND') || contains($inputLines[$j], "WHERE"))
                {
                    $inputLines[$j] = "        +\"" . trim($inputLines[$j]);
                    
                    if (contains($inputLines[$j], ";"))
                    {
                        $inputLines[$j] = str_replace(";", "", $inputLines[$i]);
                    }
                    if (contains($inputLines[$j], "}"))
                    {
                        $inputLines[$j] = str_replace("}", "", $inputLines[$i]);
                    }
                }
                if (contains($inputLines[$j], "INTO") && !contains($inputLines[$j], 'AND') && !contains($inputLines[$j], "WHERE"))
                {
                    $inputLines[$j] = "        // + \"" . trim($inputLines[$j]) . "\"";
                    $inputLines[$j - 1] = $inputLines[$j - 1] . ";";
                }
            }
        }
    }
    return $inputLines;
}



function ClassFunct($inputLines)
{
    $temp3;
    for ($i = 0; $i < count($inputLines); $i++)
    {
        if (contains($inputLines[$i], "Form Window: "))
        {
            for ($j = $i + 1; $j < count($inputLines); $j++)
            {
                if (startsWith(trim($inputLines[$j]), "Class: "))
                {
                    $temp3 = str_replace("Form Window: ", "public class ", $inputLines[$i]) . str_replace("Class: ", " extends ", trim($inputLines[$j]));
                    $inputLines[$j] = $temp3 . " {";
                    $copyTmp = $inputLines[$j];
                    for ($k = $j + 1; $k < count($inputLines); $k++)
                    {
                        if (startsWith(trim($inputLines[$k]), "/*"))
                        {
                            $inputLines[$k] = $copyTmp . "\n" . $inputLines[$k];
                            $inputLines[count($inputLines) - 1] = $inputLines[count($inputLines) - 1] . "\n}";;
                            return $inputLines;
                        }
                    }
                }
            }
        }
    }
    return $inputLines;
}

function CommentingCodeFromString($find, $inputLines)
{
    for ($i = 0; $i < count($inputLines); $i++)
    if (contains($inputLines[$i], $find) && !contains($inputLines[$i], " !"))
    $inputLines[$i] = '//' . $inputLines[$i];
    
    return $inputLines;
}

// if (and/or)
function IfAndOr($inputLines)
{
    for ($i = 0; $i < count($inputLines); $i++)
    {
        if (contains($inputLines[$i], 'if ('))
        {
            if (contains($inputLines[$i], ' and '))
            $inputLines[$i] = str_replace(' and ', ' && ', $inputLines[$i]);
            
            if (contains($inputLines[$i], ' or '))
            $inputLines[$i] = str_replace(' or ', ' || ', $inputLines[$i]);
        }
    }
    return $inputLines;
}

// MOVE PUBLIC VOID UNTER COMMENTS
function SelectLine($inputLines)
{
    $tempCount = 0;
    for ($i = 0; $i < count($inputLines); $i++)
    {
        $line = $inputLines[$i];
        if (contains($line, 'public'))
        {
            $temp = $line;
            $line = "";
            $inputLines[$i] = $line;
            $inputLines = MoveLine($i, $inputLines, $tempCount, $temp);
            $i = $tempCount;
        }
    }
    return $inputLines;
}

function MoveLine($countLines, $inputLines, &$tempCount, $copyString)
{
    for ($i = $countLines; $i < count($inputLines); $i++)
    {
        if (contains($inputLines[$i], "*/"))
        {
            $inputLines[$i] = $inputLines[$i] . "\n" . $copyString;
            $tempCount = $i++;
            return $inputLines;
        }
    }
    return $inputLines;
}

//REPLACE FUNCTIONS
function ReplaceFunction($OldString, $NewString, $EndLine, $inputLines)
{
    for ($i = 0; $i < count($inputLines); $i++)
    {
        if (contains($inputLines[$i], $OldString))
        {
            
            $inputLines[$i] = str_replace($OldString, $NewString, $inputLines[$i]);
            if (strlen($EndLine) > 0)
            {
                $inputLines[$i] = $inputLines[$i].$EndLine;
            }
        }
    }
    
    return $inputLines;
}

//CLOSING FUNCTIONS WITH "}"
function CloseFunctions($inputLines)
{
    $publicVoidCount = 0;
    for ($i = 0; $i < count($inputLines); $i++)
    {
        if (contains($inputLines[$i], "public void"))
        {
            $publicVoidCount++;
            if ($publicVoidCount >= 2)
            {
                $inputLines[$i] = str_replace("public void", "\n}\npublic void", $inputLines[$i]);
            }
        }
    }
    $inputLines[count($inputLines) - 1] = $inputLines[count($inputLines) - 1] . "\n}";
    return $inputLines;
}

//DELETING TEXT FROM BEGGINNING
function DeleteLines($inputLines)
{
    for ($i = 0; $i < count($inputLines); $i++)
    {
        if (contains($inputLines[$i], "Functions"))
        {
            $inputLines[$i] = "";
            break;
        }
        else
        $inputLines[$i] = "";
    }
    
    return $inputLines;
}

//Fixing if functions
function IfFunctionFix($inputLines)
{
    for ($i = 0; $i < count($inputLines); $i++)
    if (contains($inputLines[$i], "if ("))
    if (contains($inputLines[$i], " != "))
    $inputLines[$i] = str_replace("//", "", $inputLines[$i]);
    
    return $inputLines;
}
//Commented if functions 
function IfFunctionsClosing($inputLines)
{
    for ($i = 0; $i < count($inputLines); $i++)
    {
        if (startsWith(trim($inputLines[$i]), "if"))
        {
            $leadingSpaces = countLeadingSpaces($inputLines[$i]);
            $leadingSpaces2 = countLeadingSpaces($inputLines[$i+1]);
            
            if ($leadingSpaces2 > $leadingSpaces && contains($inputLines[$i + 1], ",") && (!contains($inputLines[$i + 1], ";")))
            {
                $inputLines[$i] = $inputLines[$i] . " " . trim($inputLines[$i + 1]);
                $inputLines[$i + 1] = "";
                $i = $i + 1;
            }
        }
    }
    $inputLines = IfFunctionsFinish($inputLines);
    return $inputLines;
}
function IfFunctionsFinish($inputLines)
{
    for ($i = 0; $i < count($inputLines); $i++)
    {
        if (startsWith(trim($inputLines[$i]), "if ("))
        {
            $inputLines[$i] = $inputLines[$i] . ") {";
                
                if (countLeadingSpaces($inputLines[$i + 1]) > countLeadingSpaces($inputLines[$i]))
                {
                    $inputLines[$i + 1] = $inputLines[$i + 1] . "\n}";
                    $i = $i + 1;
                }
            }
            if (startsWith(trim($inputLines[$i]), "else "))
            {
                if (countLeadingSpaces($inputLines[$i + 1]) > countLeadingSpaces($inputLines[$i]))
                {
                    $inputLines[$i + 1] = $inputLines[$i + 1] . "\n}";
                    $i = $i + 1;
                }
            }
        }
        return $inputLines;
    }
    
    function countLeadingSpaces($text)
    {
        $leadingSpaces = 0;
        
        for($i = 0; $i < strlen($text); $i++)
        if ($text[$i] == ' ')                
        $leadingSpaces++;               
        else
        break;
        
        return $leadingSpaces;
    }
    
    function IfFunctionsCommented($inputLines)
    {
        for ($i = 0; $i < count($inputLines); $i++)
        {
            if (startsWith(trim($inputLines[$i]), '!'))
            {
                $leadingSpaces = countLeadingSpaces($inputLines[$i]);
                $leadingSpaces2 = countLeadingSpaces($inputLines[$i+1]);
                
                if ($leadingSpaces2 > $leadingSpaces)
                {
                    $inputLines[$i + 1] = substr($inputLines[$i + 1], 0, $leadingSpaces) . '//' . substr($inputLines[$i + 1], $leadingSpaces, strlen($inputLines[$i + 1]) - $leadingSpaces);
                    $i = $i + 1;
                }
            }
        }
        return $inputLines;
    }
    
    function startsWith($text, $word) 
    {
        $length = strlen($word);
        return (substr($text, 0, $length) === $word);
    }
    
    function contains($text, $word)
    {
        if (strpos($text, $word) !== false) 
        {
            return true;
        } 
        else
        {
            return false;
        }
    }

    // echo json_encode($gJavaCode);
    echo $gJavaCode;
?>