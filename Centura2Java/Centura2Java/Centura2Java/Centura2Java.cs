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
                DialogResult dr = MessageBox.Show("Are you sure you want to open new centura code?", "Warning", MessageBoxButtons.YesNo,MessageBoxIcon.Warning);
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
            else {

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
                
                ReplaceFunction("\t", "  ", "");
                ReplaceFunction("Function:", "public void ", "() {\n");
                ReplaceFunction("Call ", "", ";");
                ReplaceFunction("FALSE", "false", "");
                ReplaceFunction("TRUE", "true", "");
                ReplaceFunction(" Return", " return", ";");
                ReplaceFunction(" Else If", " else if {", "}");
                ReplaceFunction(" Else", " else {", "");
                ReplaceFunction(" Break", " break", ";");
                //ReplaceFunction("Number:", "int ", ";");
                //ReplaceFunction("Boolean", "bool ", ";");
                //ReplaceFunction("String", "string ", ";");
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
                Class();
                AccessingData();
                DeleteLines();
                colorComments();
                pb1.Value = pb1.Maximum;
                Rchtxt_TextChanged();
                pb1.Visible = false;    
                pb1.Value = 0;
            
            }
            catch(InvalidCastException e) { MessageBox.Show("Error occurred while code converting.", "Info", MessageBoxButtons.OK, MessageBoxIcon.Error);
            MessageBox.Show("" + e, "Error");
            }
        }
        public void AccessingData()
        {
            string[] lines = rtb_JavaCode.Lines;
            for (int vv = 0; vv < lines.Length; vv++)
            {
                string line = lines[vv];
                if (line.Contains("SELECT") && line.Contains("FROM"))
                {
                        int indexFROM = line.Trim().IndexOf("FROM");
                        int textLength = line.Trim().Length;
                        line = line.Trim();
                        string temp = line.Substring(indexFROM, textLength - indexFROM);
                        string tempCopy = "        "+line.Trim().Substring(0, indexFROM) + "\u0022 \n        + \u0022" + temp + "\u0022";
                        lines[vv] = tempCopy;
                        if (lines[vv].Contains(";"))
                        {
                            lines[vv] = lines[vv].Replace(";", "");
                        }
                        if (lines[vv + 2].Contains("}"))
                        {
                            lines[vv + 2] = lines[vv + 1].Replace("}", "");
                        }

                         for (int nn = vv+1; nn < lines.Length; nn++)
                         {
                             if (lines[nn].Contains("AND") || lines[nn].Contains("WHERE"))
                             {
                                 lines[nn] = "        +\u0022" + lines[nn].Trim() ;

                                 if (lines[nn].Contains(";"))
                                 {
                                     lines[nn] = lines[vv].Replace(";", "");
                                 }
                                 if (lines[nn].Contains("}"))
                                 {
                                     lines[nn] = lines[vv].Replace("}", "");
                                 }
                             }
                             if (lines[nn].Contains("INTO") && !lines[nn].Contains("AND") && !lines[nn].Contains("WHERE"))
                             {
                                 lines[nn] = "        // + \u0022" + lines[nn].Trim() + "\u0022";
                                 lines[nn - 1] = lines[nn - 1] + ";";
                               
                             }
                         }
                    }
                }
                rtb_JavaCode.Lines = lines;
            
        }


        string temp3;
        public void Class()
        {
            string[] lines = rtb_JavaCode.Lines;
            for (int gg = 0; gg < lines.Length; gg++)
            {
                string line = lines[gg];
                if (line.Contains("Form Window: "))
                {
                    for (int pp = gg+1; pp < lines.Length; pp++)
                    {
                        string line1 = lines[pp];
                        if (line1.Trim().StartsWith("Class: "))
                        {
                            temp3 = line.Replace("Form Window: ", "public class ") + line1.Trim().Replace("Class: ", " extends ");
                            lines[pp] = temp3 + " {";
                            System.Windows.Forms.Clipboard.SetText(lines[pp]);
                            for (int ll = pp + 1; ll < lines.Length; ll++)
                            {
                                if (lines[ll].Trim().StartsWith("/*"))
                                {
                                    int index1 = lines.Length;
                                    lines[ll] = System.Windows.Forms.Clipboard.GetText() + "\n" + lines[ll];
                                    lines[index1 - 1] = lines[index1 - 1] + "\n}";
                                    rtb_JavaCode.Lines = lines;
                                    return;
                                }
                            }                          
                        }
                    }
                }
            }            
        }
        public void CommentingCodeFromString(string find)
        {
            string[] lines = rtb_JavaCode.Lines;
            for (int cc = 0; cc < lines.Length; cc++)
            {
                string line = lines[cc];
                if (line.Contains(find)&& !line.Contains(" !"))
                {
                    line = "//" + line;
                    lines[cc] = line;
                }
            }
            rtb_JavaCode.Lines = lines;
        }

        // if (and/or)
        public void IfAndOr()
        {
            string[] lines = rtb_JavaCode.Lines;
            for (int dd = 0; dd < lines.Length; dd++)
            {
                string line = lines[dd];
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
                    lines[dd] = line;
                    
                }
                rtb_JavaCode.Lines = lines;
            }
 
        }

        // MOVE PUBLIC VOID UNTER COMMENTS
        public void SelectLine()
        {
            string[] lines = rtb_JavaCode.Lines;
            for (int jj = 0; jj < lines.Length; jj++)
            {
                string line = lines[jj];
                if (line.Contains("public"))
                {
                    string temp = line;
                    System.Windows.Forms.Clipboard.SetText(temp);
                    line = "";

                    lines[jj] = line;
                    string[] a = lines;
                    MoveLine(jj,a);
                    jj = tempCount;
                  
                }
            }
        }
        int tempCount= 0;
        public void MoveLine(int countLines,string[] list)
        {
            string[] lines = list;
            for (int i = countLines; i < lines.Length; i++)
            {
                string line = lines[i];
                if (line.Contains("*/"))
                {
                    line = line +"\n" +System.Windows.Forms.Clipboard.GetText();
                    lines[i] = line;
                    rtb_JavaCode.Lines = lines;
                    tempCount = i++;
                    return;
                }
                lines[i] = line;
             }
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
        public void ReplaceFunction(string OldString,string NewString, string EndLine)
        {
            string[] lines1 = rtb_JavaCode.Lines;
            for (int i = 0; i < lines1.Length; i++ )
            {
                string line = lines1[i];
                if (line.Contains(OldString))
                {
                    line = line.Replace(OldString, NewString);
                    if (EndLine.Length > 0)
                    {
                        line = line + EndLine;
                    }
                   
                    lines1[i] = line;
                }
            }
            rtb_JavaCode.Lines = lines1;
        }
        //CLOSING FUNCTIONS WITH "}"
        int temp;
        public void CloseFunctions()
        {
            string[] lines1 = rtb_JavaCode.Lines;
            for (int gg = 0; gg < lines1.Length; gg++)
            {
                string line = lines1[gg];
                if (line.Contains("public void"))
                {
                    temp++;
                    if (temp>=2)
                    {
                        line = line.Replace("public void","\n}\npublic void");
                    }
                    lines1[gg] = line;
                }
            }
            lines1[lines1.Length - 1] = lines1[lines1.Length - 1] + "\n}";
            rtb_JavaCode.Lines = lines1;
        }
        //DELETING TEXT FROM BEGGINNING
        public void DeleteLines()
        {
            string[] lines1 = rtb_JavaCode.Lines;
            for (int jj = 0; jj < lines1.Length; jj++)
            {
                string line = lines1[jj];
                if (line.Contains("Functions"))
                {
                    line = line.Remove(0);
                    lines1[jj] = line;
                    rtb_JavaCode.Lines = lines1;
                    return;
                }
                else
                {
                    line = line.Remove(0);
                    lines1[jj] = line;
                }
            }
        }
        //Fixing if functions
        public void IfFunctionFix()
        {
            string[] lines1 = rtb_JavaCode.Lines;
            for (int nn = 0; nn < lines1.Length; nn++)
            {
                string line = lines1[nn];
                if (line.Contains("if ("))
                {
                    if (line.Contains(" != "))
                    {
                        line = line.Replace("//", "");
                        lines1[nn] = line;
                    }
                }
            }
            rtb_JavaCode.Lines = lines1;
        }
        //Commented if functions 
        public void IfFunctionsClosing()
        {
            string[] linesRtb = rtb_JavaCode.Lines;
            for (int yy = 0; yy < linesRtb.Length; yy++)
            {
                string line = linesRtb[yy];
                if (line.Trim().StartsWith("if"))
                {
                    int tempCount = 0;
                    for (int xx = 0; xx < line.Length; xx++)
                    {
                        if (line[xx] == ' ')
                        {
                            tempCount++;
                        }
                        else { break; }
                    }

                    int tempCount2 = 0;
                    string nextLine = linesRtb[yy + 1];
                    for (int xx = 0; xx < nextLine.Length; xx++)
                    {
                        if (nextLine[xx] == ' ')
                        {
                            tempCount2++;
                        }
                        else { break; }
                    }
                    if (tempCount2 > tempCount && linesRtb[yy + 1].Contains(",") && (!linesRtb[yy + 1].Contains(";")))
                    {
                        linesRtb[yy] = linesRtb[yy]+ " " + linesRtb[yy+1].Trim();
                        linesRtb[yy + 1] = "";
                        yy = yy + 1;
                    }
                }
            }
            rtb_JavaCode.Lines = linesRtb;
            IfFunctionsFinish();
        }
        public void IfFunctionsFinish()
        {
            string[] linesRtb = rtb_JavaCode.Lines;
            for (int aa = 0; aa < linesRtb.Length; aa++)
            {
                string line = linesRtb[aa];
                if (line.Trim().StartsWith("if ("))
                {
                    linesRtb[aa] = linesRtb[aa] + ") {";

                    int tempCount = 0;
                    for (int hh = 0; hh < line.Length; hh++)
                    {
                        if (line[hh] == ' ')
                        {
                            tempCount++;
                        }
                        else { break; }
                    }

                    int tempCount2 = 0;
                    string nextLine = linesRtb[aa + 1];
                    for (int xx = 0; xx < nextLine.Length; xx++)
                    {
                        if (nextLine[xx] == ' ')
                        {
                            tempCount2++;
                        }
                        else { break; }
                    }
                    if (tempCount2 > tempCount )
                    {
                        linesRtb[aa + 1] = linesRtb[aa + 1] + "\n}";
                        aa = aa + 1;
                    }
                }
                if (line.Trim().StartsWith("else "))
                {
                   

                    int tempCount = 0;
                    for (int hh = 0; hh < line.Length; hh++)
                    {
                        if (line[hh] == ' ')
                        {
                            tempCount++;
                        }
                        else { break; }
                    }

                    int tempCount2 = 0;
                    string nextLine = linesRtb[aa + 1];
                    for (int xx = 0; xx < nextLine.Length; xx++)
                    {
                        if (nextLine[xx] == ' ')
                        {
                            tempCount2++;
                        }
                        else { break; }
                    }
                    if (tempCount2 > tempCount)
                    {
                        linesRtb[aa + 1] = linesRtb[aa + 1] + "\n}";
                        aa = aa + 1;
                    }
                }
   
            }
            rtb_JavaCode.Lines = linesRtb;
        }
        public void IfFunctionsCommented()
        {
            string[] lines2 = rtb_JavaCode.Lines;
            for (int nn = 0; nn < lines2.Length; nn++)
            {
                string line = lines2[nn];
                if (line.Trim().StartsWith("!"))
                {
                    int tempCount = 0;
                    for (int xx = 0; xx < line.Length; xx++)
                    {
                        if (line[xx] == ' ')
                        {
                            tempCount++;
                        }
                        else { break; }
                    }

                    int tempCount2 = 0;
                    string nextLine = lines2[nn + 1];
                    for (int xx = 0; xx < nextLine.Length; xx++)
                    {
                        if (nextLine[xx] == ' ')
                        {
                            tempCount2++;
                        }
                        else { break; }
                    }
                    if (tempCount2 > tempCount)
                    {
                        lines2[nn + 1] = lines2[nn + 1].Substring(0, tempCount) + "//" + lines2[nn + 1].Substring(tempCount, lines2[nn + 1].Length - (tempCount));
                        nn = nn + 1;
                    }
                }
            }
            rtb_JavaCode.Lines = lines2;
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
            label_Java.Text = "Java Code: "+ rtb_JavaCode.Lines.Count()+ " lines of code";
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
