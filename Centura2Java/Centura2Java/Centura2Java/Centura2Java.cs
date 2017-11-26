using System;
using System.Collections.Generic;
using System.ComponentModel;
using System.Data;
using System.Drawing;
using System.Linq;
using System.Text;
using System.Windows.Forms;
using System.Diagnostics;
using System.IO;
using System.Text.RegularExpressions;

namespace Centura2Java
{
    public partial class Centura2Java : Form
    {
        public Centura2Java()
        {
            InitializeComponent();

        }

        public string keyword = "";
        private void exitToolStripMenuItem_Click(object sender, EventArgs e)
        {
            if (rtb_JavaCode.Modified == true)
            {
                DialogResult dr = MessageBox.Show("Discart all changes?", "Save Java code", MessageBoxButtons.YesNo, MessageBoxIcon.Warning);
                if (dr == DialogResult.Yes)
                {
                    this.Close();
                }
            }
            else { this.Close(); }
        }

        private void loadCenturaCodeToolStripMenuItem_Click(object sender, EventArgs e)
        {
            if (LB_CenturaCode.Items.Count > 0)
            {
                DialogResult dr = MessageBox.Show("Are you sure you want to open new centura code?", "Warning", MessageBoxButtons.YesNo, MessageBoxIcon.Warning);
                if (dr == DialogResult.Yes)
                {
                    OpenFileDialog ofd = new OpenFileDialog();
                    ofd.Filter = "Text files (*.txt)|*.txt";
                    if (ofd.ShowDialog() == DialogResult.OK)
                    {
                        LB_CenturaCode.Items.Clear();
                        rtb_JavaCode.Clear();
                        label_Java.Text = "Java Code: ";
                        label1.Text = "Centura Code: ";
                        List<string> lines = new List<string>();
                        using (StreamReader r = new StreamReader(ofd.OpenFile(), Encoding.Default))
                        {

                            string line;
                            while ((line = r.ReadLine()) != null)
                            {
                                LB_CenturaCode.Items.Add(line);
                                label1.Text = "Centura Code: " + LB_CenturaCode.Items.Count.ToString() + " lines of code";
                            }
                        }

                    }

                }
            }
            else
            {
                OpenFileDialog ofd = new OpenFileDialog();
                ofd.Filter = "Text files (*.txt)|*.txt";
                if (ofd.ShowDialog() == DialogResult.OK)
                {
                    LB_CenturaCode.Items.Clear();
                    rtb_JavaCode.Clear();

                    List<string> lines = new List<string>();
                    using (StreamReader r = new StreamReader(ofd.OpenFile(), Encoding.Default))
                    {
                        string line;
                        while ((line = r.ReadLine()) != null)
                        {
                            LB_CenturaCode.Items.Add(line);
                            label1.Text = "Centura Code: " + LB_CenturaCode.Items.Count.ToString() + " lines of code";
                        }
                    }
                }
            }
        }


        private void saveJavaCodeToolStripMenuItem_Click(object sender, EventArgs e)
        {
            //Opening savefile dialog and saving code to text file
            SaveFileDialog sfd1 = new SaveFileDialog();

            sfd1.Filter = "Java files (*.java)|*.java|Text files (*.txt)|*.txt|All files (*.*)|*.*";
            sfd1.FilterIndex = 2;
            sfd1.RestoreDirectory = true;
            if (sfd1.ShowDialog() == DialogResult.OK)
            {
                StreamWriter sw = File.CreateText(sfd1.FileName);
                for (int hh = 0; hh < rtb_JavaCode.Lines.Length; hh++)
                {
                    sw.WriteLine(rtb_JavaCode.Lines[hh]);
                }
                sw.Flush();
                sw.Close();
                //File.WriteAllText(sfd1.FileName , rtb_JavaCode.Text);
            }
        }

        private void convertToJavaToolStripMenuItem_Click(object sender, EventArgs e)
        {
            if (rtb_JavaCode.Modified == true)
            {
                DialogResult dr = MessageBox.Show("Are you sure you want to delete current java code?", "Warning", MessageBoxButtons.YesNo, MessageBoxIcon.Warning);
                if (dr == DialogResult.Yes)
                {
                    rtb_JavaCode.Clear();
                    pb1.Visible = true;
                    converting();

                }
            }
            else
            {
                pb1.Visible = true;
                converting();

            }
        }

        public void converting()
        {
            try
            {
                //Copying text to richtextbox
                int linenumber = LB_CenturaCode.Items.Count;
                int i = linenumber;
                for (i = 0; i < LB_CenturaCode.Items.Count; i++)
                {
                    if ((i + 1) < LB_CenturaCode.Items.Count)
                    {
                        rtb_JavaCode.Text += LB_CenturaCode.Items[i] + "\n";
                        pb1.Value = pb1.Value + 1;
                    }
                    else
                    {
                        rtb_JavaCode.Text += LB_CenturaCode.Items[i];
                    }
                }

                //CONVERTING CODE TO JAVA
                rtb_JavaCode.Lines = ReplaceFunction("\t", "  ", "", rtb_JavaCode.Lines);
                rtb_JavaCode.Lines = ReplaceFunction("Function:", "public void ", "() {\n", rtb_JavaCode.Lines);
                rtb_JavaCode.Lines = ReplaceFunction("Call ", "", ";", rtb_JavaCode.Lines);
                rtb_JavaCode.Lines = ReplaceFunction("FALSE", "false", "", rtb_JavaCode.Lines);
                rtb_JavaCode.Lines = ReplaceFunction("TRUE", "true", "", rtb_JavaCode.Lines);
                rtb_JavaCode.Lines = ReplaceFunction(" Return", " return", ";", rtb_JavaCode.Lines);
                rtb_JavaCode.Lines = ReplaceFunction(" Else If", " else if {", "}", rtb_JavaCode.Lines);
                rtb_JavaCode.Lines = ReplaceFunction(" Else", " else {", "", rtb_JavaCode.Lines);
                rtb_JavaCode.Lines = ReplaceFunction(" Break", " break", ";", rtb_JavaCode.Lines);
                //ReplaceFunction("Number:", "int ", ";");
                //ReplaceFunction("Boolean", "bool ", ";");
                //ReplaceFunction("String", "string ", ";");
                rtb_JavaCode.Lines = ReplaceFunction("Set ", "", ";", rtb_JavaCode.Lines);
                rtb_JavaCode.Lines = ReplaceFunction("If ", "if (", "", rtb_JavaCode.Lines);
                rtb_JavaCode.Lines = ReplaceFunction("( )", "()", "", rtb_JavaCode.Lines);
                rtb_JavaCode.Lines = ReplaceFunction("(  )", "()", "", rtb_JavaCode.Lines);
                rtb_JavaCode.Lines = ReplaceFunction("(   )", "()", "", rtb_JavaCode.Lines);
                rtb_JavaCode.Lines = ReplaceFunction("Description", "/*\nDescription", "", rtb_JavaCode.Lines);
                rtb_JavaCode.Lines = ReplaceFunction("  Actions", "  Actions\n*/", "", rtb_JavaCode.Lines);
                rtb_JavaCode.Lines = ReplaceFunction("'", "\"", "", rtb_JavaCode.Lines);
                rtb_JavaCode.Lines = IfAndOr(rtb_JavaCode.Lines);
                rtb_JavaCode.Lines = CloseFunctions(rtb_JavaCode.Lines);
                rtb_JavaCode.Lines = IfFunctionFix(rtb_JavaCode.Lines);
                rtb_JavaCode.Lines = IfFunctionsCommented(rtb_JavaCode.Lines);
                rtb_JavaCode.Lines = IfFunctionsClosing(rtb_JavaCode.Lines);
                rtb_JavaCode.Lines = ReplaceFunction(" ! ", " // ! ", "", rtb_JavaCode.Lines);
                rtb_JavaCode.Lines = CommentingCodeFromString("SalWaitCursor", rtb_JavaCode.Lines);


                rtb_JavaCode.Lines = SelectLine(rtb_JavaCode.Lines);
                rtb_JavaCode.Lines = Class(rtb_JavaCode.Lines);
                rtb_JavaCode.Lines = AccessingData(rtb_JavaCode.Lines);
                rtb_JavaCode.Lines = DeleteLines(rtb_JavaCode.Lines);


                colorComments();
                pb1.Value = pb1.Maximum;
                Rchtxt_TextChanged();
                pb1.Visible = false;
                pb1.Value = 0;

            }
            catch (InvalidCastException e)
            {
                MessageBox.Show("Error occurred while code converting.", "Info", MessageBoxButtons.OK, MessageBoxIcon.Error);
                MessageBox.Show("" + e, "Error");
            }
        }
        public string[] AccessingData(string[] inputLines)
        {
            for (int i = 0; i < inputLines.Length; i++)
            {
                string line = inputLines[i];
                if (line.Contains("SELECT") && line.Contains("FROM"))
                {
                    int indexFROM = line.Trim().IndexOf("FROM");
                    int textLength = line.Trim().Length;
                    line = line.Trim();
                    string temp = line.Substring(indexFROM, textLength - indexFROM);
                    string tempCopy = "        " + line.Trim().Substring(0, indexFROM) + "\" \n        + \"" + temp + "\"";
                    inputLines[i] = tempCopy;
                    if (inputLines[i].Contains(";"))
                    {
                        inputLines[i] = inputLines[i].Replace(";", "");
                    }
                    if (inputLines[i + 2].Contains("}"))
                    {
                        inputLines[i + 2] = inputLines[i + 1].Replace("}", "");
                    }

                    for (int j = i + 1; j < inputLines.Length; j++)
                    {
                        if (inputLines[j].Contains("AND") || inputLines[j].Contains("WHERE"))
                        {
                            inputLines[j] = "        +\"" + inputLines[j].Trim();

                            if (inputLines[j].Contains(";"))
                            {
                                inputLines[j] = inputLines[i].Replace(";", "");
                            }
                            if (inputLines[j].Contains("}"))
                            {
                                inputLines[j] = inputLines[i].Replace("}", "");
                            }
                        }
                        if (inputLines[j].Contains("INTO") && !inputLines[j].Contains("AND") && !inputLines[j].Contains("WHERE"))
                        {
                            inputLines[j] = "        // + \"" + inputLines[j].Trim() + "\"";
                            inputLines[j - 1] = inputLines[j - 1] + ";";
                        }
                    }
                }
            }
            return inputLines;
        }



        public string[] Class(string[] inputLines)
        {
            string temp3;
            for (int i = 0; i < inputLines.Length; i++)
            {
                if (inputLines[i].Contains("Form Window: "))
                {
                    for (int j = i + 1; j < inputLines.Length; j++)
                    {
                        if (inputLines[j].Trim().StartsWith("Class: "))
                        {
                            temp3 = inputLines[i].Replace("Form Window: ", "public class ") + inputLines[j].Trim().Replace("Class: ", " extends ");
                            inputLines[j] = temp3 + " {";
                            string copyTmp = inputLines[j];
                            for (int k = j + 1; k < inputLines.Length; k++)
                            {
                                if (inputLines[k].Trim().StartsWith("/*"))
                                {
                                    inputLines[k] = copyTmp + "\n" + inputLines[k];
                                    inputLines[inputLines.Length - 1] = inputLines[inputLines.Length - 1] + "\n}";
                                    return inputLines;
                                }
                            }
                        }
                    }
                }
            }
            return inputLines;
        }

        public string[] CommentingCodeFromString(string find, string[] inputLines)
        {
            for (int i = 0; i < inputLines.Length; i++)
                if (inputLines[i].Contains(find) && !inputLines[i].Contains(" !"))
                    inputLines[i] = "//" + inputLines[i];

            return inputLines;
        }

        // if (and/or)
        public string[] IfAndOr(string[] inputLines)
        {
            for (int i = 0; i < inputLines.Length; i++)
            {
                if (inputLines[i].Contains("if ("))
                {
                    if (inputLines[i].Contains(" and "))
                        inputLines[i] = inputLines[i].Replace(" and ", " && ");

                    if (inputLines[i].Contains(" or "))
                        inputLines[i] = inputLines[i].Replace(" or ", " || ");
                }
            }
            return inputLines;
        }

        // MOVE PUBLIC VOID UNTER COMMENTS
        public string[] SelectLine(string[] inputLines)
        {
            int tempCount = 0;
            for (int i = 0; i < inputLines.Length; i++)
            {
                string line = inputLines[i];
                if (line.Contains("public"))
                {
                    string temp = line;
                    line = "";
                    inputLines[i] = line;
                    inputLines = MoveLine(i, inputLines, ref tempCount, temp);
                    i = tempCount;
                }
            }
            return inputLines;
        }

        public string[] MoveLine(int countLines, string[] inputLines, ref int tempCount, string copyString)
        {
            for (int i = countLines; i < inputLines.Length; i++)
            {
                if (inputLines[i].Contains("*/"))
                {
                    inputLines[i] = inputLines[i] + "\n" + copyString;
                    rtb_JavaCode.Lines = inputLines;
                    tempCount = i++;
                    return inputLines;
                }
            }
            return inputLines;
        }

        //TEXT COLOR
        public void colorComments()
        {
            for (int i = 0; i < rtb_JavaCode.Lines.Length; i++)
            {
                string text = rtb_JavaCode.Lines[i];
                rtb_JavaCode.Select(rtb_JavaCode.GetFirstCharIndexFromLine(i), text.Length);
                rtb_JavaCode.SelectionColor = colorForLine(text);
            }
        }

        private Color colorForLine(string line)
        {
            if (line.Contains("//") || line.Contains("/*") || line.Contains("*/") || line.Contains("Actions") || line.Contains("Description") || line.Contains("Local variables") || line.Contains("Static Variables") || line.Contains("Number:") || line.Contains("Boolean:") || line.Contains("String:") || line.Contains("returns") || line.Contains("Parameters") || line.Contains("Class") || line.Contains(":"))
            {
                return Color.Green;
            }
            else
            {
                return Color.Black;
            }
        }

        private void Rchtxt_TextChanged()
        {
            this.CheckKeyword("while ", Color.Blue, 0);
            this.CheckKeyword("if ", Color.Blue, 0);
            this.CheckKeyword("public void ", Color.Purple, 0);
            this.CheckKeyword("public class ", Color.Purple, 0);
            this.CheckKeyword("true", Color.Blue, 0);
            this.CheckKeyword("false", Color.Blue, 0);
            this.CheckKeyword("else", Color.Blue, 0);
            this.CheckKeyword("break", Color.Blue, 0);
            this.CheckKeyword("extends", Color.Blue, 0);
            this.CheckKeyword("(", Color.Blue, 0);
            this.CheckKeyword(")", Color.Blue, 0);
            this.CheckKeyword("super", Color.Blue, 0);
            this.CheckKeyword("catch ", Color.Blue, 0);
            this.CheckKeyword("try ", Color.Blue, 0);
            this.CheckKeyword(" new", Color.Blue, 0);
            this.CheckKeyword("null", Color.Blue, 0);
            this.CheckKeyword(" this", Color.Blue, 0);
        }

        private void CheckKeyword(string word, Color color, int startIndex)
        {
            if (this.rtb_JavaCode.Text.Contains(word))
            {
                int index = -1;
                int selectStart = this.rtb_JavaCode.SelectionStart;

                while ((index = this.rtb_JavaCode.Text.IndexOf(word, (index + 1))) != -1)
                {
                    this.rtb_JavaCode.Select((index + startIndex), word.Length);
                    this.rtb_JavaCode.SelectionColor = color;
                    this.rtb_JavaCode.Select(selectStart, 0);
                    this.rtb_JavaCode.SelectionColor = Color.Black;
                }
            }
        }

        //REPLACE FUNCTIONS
        public string[] ReplaceFunction(string OldString, string NewString, string EndLine, string[] inputLines)
        {
            for (int i = 0; i < inputLines.Length; i++)
            {
                if (inputLines[i].Contains(OldString))
                {
                    inputLines[i] = inputLines[i].Replace(OldString, NewString);
                    if (EndLine.Length > 0)
                    {
                        inputLines[i] = inputLines[i] + EndLine;
                    }
                }
            }
            return inputLines;
        }

        //CLOSING FUNCTIONS WITH "}"
        public string[] CloseFunctions(string[] inputLines)
        {
            int publicVoidCount = 0;
            for (int i = 0; i < inputLines.Length; i++)
            {
                if (inputLines[i].Contains("public void"))
                {
                    publicVoidCount++;
                    if (publicVoidCount >= 2)
                    {
                        inputLines[i] = inputLines[i].Replace("public void", "\n}\npublic void");
                    }
                }
            }
            inputLines[inputLines.Length - 1] = inputLines[inputLines.Length - 1] + "\n}";
            return inputLines;
        }

        //DELETING TEXT FROM BEGGINNING
        public string[] DeleteLines(string[] inputLines)
        {
            for (int i = 0; i < inputLines.Length; i++)
            {
                if (inputLines[i].Contains("Functions"))
                {
                    inputLines[i] = "";
                    break;
                }
                else
                    inputLines[i] = "";
            }
            return inputLines;
        }

        //Fixing if functions
        public string[] IfFunctionFix(string[] inputLines)
        {
            for (int i = 0; i < inputLines.Length; i++)
                if (inputLines[i].Contains("if ("))
                    if (inputLines[i].Contains(" != "))
                        inputLines[i] = inputLines[i].Replace("//", "");
            
            return inputLines;
        }
        //Commented if functions 
        public string[] IfFunctionsClosing(string[] inputLines)
        {
            for (int i = 0; i < inputLines.Length; i++)
            {
                if (inputLines[i].Trim().StartsWith("if"))
                {
                    int leadingSpaces = countLeadingSpaces(inputLines[i]);
                    int leadingSpaces2 = countLeadingSpaces(inputLines[i+1]);

                    if (leadingSpaces2 > leadingSpaces && inputLines[i + 1].Contains(",") && (!inputLines[i + 1].Contains(";")))
                    {
                        inputLines[i] = inputLines[i] + " " + inputLines[i + 1].Trim();
                        inputLines[i + 1] = "";
                        i = i + 1;
                    }
                }
            }

            inputLines = IfFunctionsFinish(inputLines);
            return inputLines;
        }
        public string[] IfFunctionsFinish(string[] inputLines)
        {
            for (int i = 0; i < inputLines.Length; i++)
            {
                if (inputLines[i].Trim().StartsWith("if ("))
                {
                    inputLines[i] = inputLines[i] + ") {";

                    if (countLeadingSpaces(inputLines[i + 1]) > countLeadingSpaces(inputLines[i]))
                    {
                        inputLines[i + 1] = inputLines[i + 1] + "\n}";
                        i = i + 1;
                    }
                }
                if (inputLines[i].Trim().StartsWith("else "))
                {
                    if (countLeadingSpaces(inputLines[i + 1]) > countLeadingSpaces(inputLines[i]))
                    {
                        inputLines[i + 1] = inputLines[i + 1] + "\n}";
                        i = i + 1;
                    }
                }
            }
            return inputLines;
        }

        public int countLeadingSpaces(string text)
        {
            int leadingSpaces = 0;
            
            for(int i = 0; i < text.Length; i++)
                if (text[i] == ' ')                
                    leadingSpaces++;               
                else
                    break; 

            return leadingSpaces;
        }

        public string[] IfFunctionsCommented(string[] inputLines)
        {
            for (int i = 0; i < inputLines.Length; i++)
            {
                if (inputLines[i].Trim().StartsWith("!"))
                {
                    int leadingSpaces = countLeadingSpaces(inputLines[i]);
                    int leadingSpaces2 = countLeadingSpaces(inputLines[i+1]);

                    if (leadingSpaces2 > leadingSpaces)
                    {
                        inputLines[i + 1] = inputLines[i + 1].Substring(0, leadingSpaces) + "//" + inputLines[i + 1].Substring(leadingSpaces, inputLines[i + 1].Length - (leadingSpaces));
                        i = i + 1;
                    }
                }
            }
            return inputLines;
        }

        private void undoToolStripMenuItem_Click(object sender, EventArgs e)
        {
            rtb_JavaCode.Undo();
            rtb_JavaCode.Focus();
        }

        private void redoToolStripMenuItem_Click(object sender, EventArgs e)
        {
            rtb_JavaCode.Redo();
            rtb_JavaCode.Focus();
        }

        private void findToolStripMenuItem_Click(object sender, EventArgs e)
        {
            Find f = new Find();
            f.ShowDialog();
            string highlight = f.tb_findWord.Text;

            Utility.HighlightText(rtb_JavaCode, highlight, Color.Firebrick);
        }

        private void copyJavaCodeToolStripMenuItem_Click(object sender, EventArgs e)
        {
            try
            {
                rtb_JavaCode.SelectAll();
                rtb_JavaCode.Copy();
            }
            catch { MessageBox.Show("Error occurred at copying java code."); }
        }

        private void copyCenturaGuptaCodeToolStripMenuItem_Click(object sender, EventArgs e)
        {
            btn_copy_Click();
        }
        private void btn_copy_Click()
        {
            try
            {
                string s1 = "";
                foreach (object item in LB_CenturaCode.Items) s1 += item.ToString() + "\r\n";
                Clipboard.SetText(s1);
            }
            catch { MessageBox.Show("Error occurred at copying centura code."); }
        }

        private void rtb_JavaCode_TextChanged(object sender, EventArgs e)
        {
            pb1.Maximum = rtb_JavaCode.Lines.Count();
            label_Java.Text = "Java Code: " + rtb_JavaCode.Lines.Count() + " lines of code";
        }

        private void Centura2Java_FormClosing(object sender, FormClosingEventArgs e)
        {
            if (rtb_JavaCode.Modified == true)
            {
                DialogResult dr = MessageBox.Show("Java code not saved. Do you want to save your Java code?", "Warning", MessageBoxButtons.YesNo, MessageBoxIcon.Warning);
                if (dr == DialogResult.Yes)
                {
                    //Opening savefile dialog and saving code to text file
                    SaveFileDialog sfd1 = new SaveFileDialog();

                    sfd1.Filter = "Java files (*.java)|*.java|Text files (*.txt)|*.txt|All files (*.*)|*.*";
                    sfd1.FilterIndex = 2;
                    sfd1.RestoreDirectory = true;
                    if (sfd1.ShowDialog() == DialogResult.OK)
                    {
                        StreamWriter sw = File.CreateText(sfd1.FileName);
                        for (int hh = 0; hh < rtb_JavaCode.Lines.Length; hh++)
                        {
                            sw.WriteLine(rtb_JavaCode.Lines[hh]);
                        }
                        sw.Flush();
                        sw.Close();
                        this.Close();
                        //File.WriteAllText(sfd1.FileName , rtb_JavaCode.Text);
                    }

                }
            }
        }




    }
    // Highlight word color
    static class Utility
    {
        public static void HighlightText(this RichTextBox myRtb, string word, Color color)
        {
            if (word == "")
            {
                return;
            }

            int s_start = myRtb.SelectionStart, startIndex = 0, index;

            while ((index = myRtb.Text.IndexOf(word, startIndex)) != -1)
            {
                myRtb.Select(index, word.Length);
                myRtb.SelectionColor = color;

                startIndex = index + word.Length;
            }

            myRtb.SelectionStart = s_start;
            myRtb.SelectionLength = 0;
            myRtb.SelectionColor = Color.Black;
        }
    }
}
