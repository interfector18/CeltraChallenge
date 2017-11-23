namespace Centura2Java
{
    partial class Centura2Java
    {
        /// <summary>
        /// Required designer variable.
        /// </summary>
        private System.ComponentModel.IContainer components = null;

        /// <summary>
        /// Clean up any resources being used.
        /// </summary>
        /// <param name="disposing">true if managed resources should be disposed; otherwise, false.</param>
        protected override void Dispose(bool disposing)
        {
            if (disposing && (components != null))
            {
                components.Dispose();
            }
            base.Dispose(disposing);
        }

        #region Windows Form Designer generated code

        /// <summary>
        /// Required method for Designer support - do not modify
        /// the contents of this method with the code editor.
        /// </summary>
        private void InitializeComponent()
        {
            System.ComponentModel.ComponentResourceManager resources = new System.ComponentModel.ComponentResourceManager(typeof(Centura2Java));
            this.MainMenu = new System.Windows.Forms.MenuStrip();
            this.fileToolStripMenuItem = new System.Windows.Forms.ToolStripMenuItem();
            this.loadCenturaCodeToolStripMenuItem = new System.Windows.Forms.ToolStripMenuItem();
            this.saveJavaCodeToolStripMenuItem = new System.Windows.Forms.ToolStripMenuItem();
            this.exitToolStripMenuItem = new System.Windows.Forms.ToolStripMenuItem();
            this.convertToJavaToolStripMenuItem = new System.Windows.Forms.ToolStripMenuItem();
            this.actionsToolStripMenuItem = new System.Windows.Forms.ToolStripMenuItem();
            this.undoToolStripMenuItem = new System.Windows.Forms.ToolStripMenuItem();
            this.redoToolStripMenuItem = new System.Windows.Forms.ToolStripMenuItem();
            this.findToolStripMenuItem = new System.Windows.Forms.ToolStripMenuItem();
            this.copyJavaCodeToolStripMenuItem = new System.Windows.Forms.ToolStripMenuItem();
            this.copyCenturaGuptaCodeToolStripMenuItem = new System.Windows.Forms.ToolStripMenuItem();
            this.LB_CenturaCode = new System.Windows.Forms.ListBox();
            this.label1 = new System.Windows.Forms.Label();
            this.rtb_JavaCode = new System.Windows.Forms.RichTextBox();
            this.label_Java = new System.Windows.Forms.Label();
            this.splitContainer1 = new System.Windows.Forms.SplitContainer();
            this.pb1 = new System.Windows.Forms.ProgressBar();
            this.MainMenu.SuspendLayout();
            this.splitContainer1.Panel1.SuspendLayout();
            this.splitContainer1.Panel2.SuspendLayout();
            this.splitContainer1.SuspendLayout();
            this.SuspendLayout();
            // 
            // MainMenu
            // 
            this.MainMenu.BackColor = System.Drawing.Color.White;
            this.MainMenu.Items.AddRange(new System.Windows.Forms.ToolStripItem[] {
            this.fileToolStripMenuItem,
            this.convertToJavaToolStripMenuItem,
            this.actionsToolStripMenuItem});
            this.MainMenu.Location = new System.Drawing.Point(0, 0);
            this.MainMenu.Name = "MainMenu";
            this.MainMenu.Size = new System.Drawing.Size(1392, 24);
            this.MainMenu.TabIndex = 0;
            this.MainMenu.Text = "menuStrip1";
            // 
            // fileToolStripMenuItem
            // 
            this.fileToolStripMenuItem.DropDownItems.AddRange(new System.Windows.Forms.ToolStripItem[] {
            this.loadCenturaCodeToolStripMenuItem,
            this.saveJavaCodeToolStripMenuItem,
            this.exitToolStripMenuItem});
            this.fileToolStripMenuItem.Image = global::Centura2Java.Properties.Resources.mainmenu;
            this.fileToolStripMenuItem.Name = "fileToolStripMenuItem";
            this.fileToolStripMenuItem.Size = new System.Drawing.Size(53, 20);
            this.fileToolStripMenuItem.Text = "&File";
            // 
            // loadCenturaCodeToolStripMenuItem
            // 
            this.loadCenturaCodeToolStripMenuItem.Image = global::Centura2Java.Properties.Resources.open;
            this.loadCenturaCodeToolStripMenuItem.Name = "loadCenturaCodeToolStripMenuItem";
            this.loadCenturaCodeToolStripMenuItem.ShortcutKeys = ((System.Windows.Forms.Keys)(((System.Windows.Forms.Keys.Control | System.Windows.Forms.Keys.Shift)
                        | System.Windows.Forms.Keys.O)));
            this.loadCenturaCodeToolStripMenuItem.Size = new System.Drawing.Size(257, 22);
            this.loadCenturaCodeToolStripMenuItem.Text = "&Load Centura Code..";
            this.loadCenturaCodeToolStripMenuItem.Click += new System.EventHandler(this.loadCenturaCodeToolStripMenuItem_Click);
            // 
            // saveJavaCodeToolStripMenuItem
            // 
            this.saveJavaCodeToolStripMenuItem.Image = global::Centura2Java.Properties.Resources.save;
            this.saveJavaCodeToolStripMenuItem.Name = "saveJavaCodeToolStripMenuItem";
            this.saveJavaCodeToolStripMenuItem.ShortcutKeys = ((System.Windows.Forms.Keys)(((System.Windows.Forms.Keys.Control | System.Windows.Forms.Keys.Shift)
                        | System.Windows.Forms.Keys.S)));
            this.saveJavaCodeToolStripMenuItem.Size = new System.Drawing.Size(257, 22);
            this.saveJavaCodeToolStripMenuItem.Text = "&Export Java Code As..";
            this.saveJavaCodeToolStripMenuItem.Click += new System.EventHandler(this.saveJavaCodeToolStripMenuItem_Click);
            // 
            // exitToolStripMenuItem
            // 
            this.exitToolStripMenuItem.ForeColor = System.Drawing.Color.FromArgb(((int)(((byte)(192)))), ((int)(((byte)(0)))), ((int)(((byte)(0)))));
            this.exitToolStripMenuItem.Image = global::Centura2Java.Properties.Resources.exit;
            this.exitToolStripMenuItem.Name = "exitToolStripMenuItem";
            this.exitToolStripMenuItem.ShortcutKeys = ((System.Windows.Forms.Keys)(((System.Windows.Forms.Keys.Control | System.Windows.Forms.Keys.Shift)
                        | System.Windows.Forms.Keys.Q)));
            this.exitToolStripMenuItem.Size = new System.Drawing.Size(257, 22);
            this.exitToolStripMenuItem.Text = "&Exit";
            this.exitToolStripMenuItem.Click += new System.EventHandler(this.exitToolStripMenuItem_Click);
            // 
            // convertToJavaToolStripMenuItem
            // 
            this.convertToJavaToolStripMenuItem.Image = global::Centura2Java.Properties.Resources.greenarrows;
            this.convertToJavaToolStripMenuItem.Name = "convertToJavaToolStripMenuItem";
            this.convertToJavaToolStripMenuItem.ShortcutKeys = ((System.Windows.Forms.Keys)(((System.Windows.Forms.Keys.Control | System.Windows.Forms.Keys.Alt)
                        | System.Windows.Forms.Keys.C)));
            this.convertToJavaToolStripMenuItem.Size = new System.Drawing.Size(113, 20);
            this.convertToJavaToolStripMenuItem.Text = "&ConvertToJava";
            this.convertToJavaToolStripMenuItem.Click += new System.EventHandler(this.convertToJavaToolStripMenuItem_Click);
            // 
            // actionsToolStripMenuItem
            // 
            this.actionsToolStripMenuItem.DropDownItems.AddRange(new System.Windows.Forms.ToolStripItem[] {
            this.undoToolStripMenuItem,
            this.redoToolStripMenuItem,
            this.findToolStripMenuItem,
            this.copyJavaCodeToolStripMenuItem,
            this.copyCenturaGuptaCodeToolStripMenuItem});
            this.actionsToolStripMenuItem.Image = global::Centura2Java.Properties.Resources.widgets;
            this.actionsToolStripMenuItem.Name = "actionsToolStripMenuItem";
            this.actionsToolStripMenuItem.Size = new System.Drawing.Size(75, 20);
            this.actionsToolStripMenuItem.Text = "&Actions";
            // 
            // undoToolStripMenuItem
            // 
            this.undoToolStripMenuItem.Image = global::Centura2Java.Properties.Resources._1436400452_edit_undo;
            this.undoToolStripMenuItem.Name = "undoToolStripMenuItem";
            this.undoToolStripMenuItem.ShortcutKeys = ((System.Windows.Forms.Keys)((System.Windows.Forms.Keys.Control | System.Windows.Forms.Keys.Z)));
            this.undoToolStripMenuItem.Size = new System.Drawing.Size(252, 22);
            this.undoToolStripMenuItem.Text = "&Undo";
            this.undoToolStripMenuItem.Click += new System.EventHandler(this.undoToolStripMenuItem_Click);
            // 
            // redoToolStripMenuItem
            // 
            this.redoToolStripMenuItem.Image = global::Centura2Java.Properties.Resources._1436400452_edit_redo;
            this.redoToolStripMenuItem.Name = "redoToolStripMenuItem";
            this.redoToolStripMenuItem.ShortcutKeys = ((System.Windows.Forms.Keys)((System.Windows.Forms.Keys.Control | System.Windows.Forms.Keys.Y)));
            this.redoToolStripMenuItem.Size = new System.Drawing.Size(252, 22);
            this.redoToolStripMenuItem.Text = "&Redo";
            this.redoToolStripMenuItem.Click += new System.EventHandler(this.redoToolStripMenuItem_Click);
            // 
            // findToolStripMenuItem
            // 
            this.findToolStripMenuItem.Image = global::Centura2Java.Properties.Resources.searchh;
            this.findToolStripMenuItem.Name = "findToolStripMenuItem";
            this.findToolStripMenuItem.ShortcutKeys = ((System.Windows.Forms.Keys)((System.Windows.Forms.Keys.Control | System.Windows.Forms.Keys.F)));
            this.findToolStripMenuItem.Size = new System.Drawing.Size(252, 22);
            this.findToolStripMenuItem.Text = "&Search...";
            this.findToolStripMenuItem.Click += new System.EventHandler(this.findToolStripMenuItem_Click);
            // 
            // copyJavaCodeToolStripMenuItem
            // 
            this.copyJavaCodeToolStripMenuItem.Image = global::Centura2Java.Properties.Resources.java_os_x_mavericks2;
            this.copyJavaCodeToolStripMenuItem.Name = "copyJavaCodeToolStripMenuItem";
            this.copyJavaCodeToolStripMenuItem.ShortcutKeys = ((System.Windows.Forms.Keys)(((System.Windows.Forms.Keys.Control | System.Windows.Forms.Keys.Shift)
                        | System.Windows.Forms.Keys.J)));
            this.copyJavaCodeToolStripMenuItem.Size = new System.Drawing.Size(252, 22);
            this.copyJavaCodeToolStripMenuItem.Text = "Copy &Java Code";
            this.copyJavaCodeToolStripMenuItem.Click += new System.EventHandler(this.copyJavaCodeToolStripMenuItem_Click);
            // 
            // copyCenturaGuptaCodeToolStripMenuItem
            // 
            this.copyCenturaGuptaCodeToolStripMenuItem.Image = global::Centura2Java.Properties.Resources.Gupta3;
            this.copyCenturaGuptaCodeToolStripMenuItem.Name = "copyCenturaGuptaCodeToolStripMenuItem";
            this.copyCenturaGuptaCodeToolStripMenuItem.ShortcutKeys = ((System.Windows.Forms.Keys)(((System.Windows.Forms.Keys.Control | System.Windows.Forms.Keys.Shift)
                        | System.Windows.Forms.Keys.C)));
            this.copyCenturaGuptaCodeToolStripMenuItem.Size = new System.Drawing.Size(252, 22);
            this.copyCenturaGuptaCodeToolStripMenuItem.Text = "Copy &Centura Code";
            this.copyCenturaGuptaCodeToolStripMenuItem.Click += new System.EventHandler(this.copyCenturaGuptaCodeToolStripMenuItem_Click);
            // 
            // LB_CenturaCode
            // 
            this.LB_CenturaCode.Anchor = ((System.Windows.Forms.AnchorStyles)((((System.Windows.Forms.AnchorStyles.Top | System.Windows.Forms.AnchorStyles.Bottom)
                        | System.Windows.Forms.AnchorStyles.Left)
                        | System.Windows.Forms.AnchorStyles.Right)));
            this.LB_CenturaCode.BorderStyle = System.Windows.Forms.BorderStyle.None;
            this.LB_CenturaCode.Font = new System.Drawing.Font("Courier New", 9F, System.Drawing.FontStyle.Regular, System.Drawing.GraphicsUnit.Point, ((byte)(238)));
            this.LB_CenturaCode.FormattingEnabled = true;
            this.LB_CenturaCode.ItemHeight = 15;
            this.LB_CenturaCode.Location = new System.Drawing.Point(0, 44);
            this.LB_CenturaCode.Name = "LB_CenturaCode";
            this.LB_CenturaCode.Size = new System.Drawing.Size(669, 600);
            this.LB_CenturaCode.TabIndex = 1;
            // 
            // label1
            // 
            this.label1.AutoSize = true;
            this.label1.BackColor = System.Drawing.Color.Transparent;
            this.label1.Location = new System.Drawing.Point(3, 28);
            this.label1.Name = "label1";
            this.label1.Size = new System.Drawing.Size(75, 13);
            this.label1.TabIndex = 2;
            this.label1.Text = "Centura Code:";
            // 
            // rtb_JavaCode
            // 
            this.rtb_JavaCode.Anchor = ((System.Windows.Forms.AnchorStyles)((((System.Windows.Forms.AnchorStyles.Top | System.Windows.Forms.AnchorStyles.Bottom)
                        | System.Windows.Forms.AnchorStyles.Left)
                        | System.Windows.Forms.AnchorStyles.Right)));
            this.rtb_JavaCode.BorderStyle = System.Windows.Forms.BorderStyle.None;
            this.rtb_JavaCode.Font = new System.Drawing.Font("Courier New", 9F, System.Drawing.FontStyle.Regular, System.Drawing.GraphicsUnit.Point, ((byte)(238)));
            this.rtb_JavaCode.Location = new System.Drawing.Point(0, 44);
            this.rtb_JavaCode.Name = "rtb_JavaCode";
            this.rtb_JavaCode.Size = new System.Drawing.Size(715, 613);
            this.rtb_JavaCode.TabIndex = 3;
            this.rtb_JavaCode.Text = "";
            this.rtb_JavaCode.WordWrap = false;
            this.rtb_JavaCode.TextChanged += new System.EventHandler(this.rtb_JavaCode_TextChanged);
            // 
            // label_Java
            // 
            this.label_Java.AutoSize = true;
            this.label_Java.BackColor = System.Drawing.Color.Transparent;
            this.label_Java.Location = new System.Drawing.Point(3, 28);
            this.label_Java.Name = "label_Java";
            this.label_Java.Size = new System.Drawing.Size(61, 13);
            this.label_Java.TabIndex = 4;
            this.label_Java.Text = "Java Code:";
            // 
            // splitContainer1
            // 
            this.splitContainer1.Anchor = ((System.Windows.Forms.AnchorStyles)((((System.Windows.Forms.AnchorStyles.Top | System.Windows.Forms.AnchorStyles.Bottom)
                        | System.Windows.Forms.AnchorStyles.Left)
                        | System.Windows.Forms.AnchorStyles.Right)));
            this.splitContainer1.BackColor = System.Drawing.Color.White;
            this.splitContainer1.BorderStyle = System.Windows.Forms.BorderStyle.FixedSingle;
            this.splitContainer1.Location = new System.Drawing.Point(0, 0);
            this.splitContainer1.Name = "splitContainer1";
            // 
            // splitContainer1.Panel1
            // 
            this.splitContainer1.Panel1.Controls.Add(this.LB_CenturaCode);
            this.splitContainer1.Panel1.Controls.Add(this.label1);
            // 
            // splitContainer1.Panel2
            // 
            this.splitContainer1.Panel2.Controls.Add(this.pb1);
            this.splitContainer1.Panel2.Controls.Add(this.label_Java);
            this.splitContainer1.Panel2.Controls.Add(this.rtb_JavaCode);
            this.splitContainer1.Size = new System.Drawing.Size(1392, 659);
            this.splitContainer1.SplitterDistance = 671;
            this.splitContainer1.TabIndex = 5;
            // 
            // pb1
            // 
            this.pb1.Anchor = ((System.Windows.Forms.AnchorStyles)((System.Windows.Forms.AnchorStyles.Top | System.Windows.Forms.AnchorStyles.Right)));
            this.pb1.Location = new System.Drawing.Point(610, 28);
            this.pb1.Name = "pb1";
            this.pb1.Size = new System.Drawing.Size(100, 13);
            this.pb1.Step = 1;
            this.pb1.TabIndex = 3;
            this.pb1.Visible = false;
            // 
            // Centura2Java
            // 
            this.AutoScaleDimensions = new System.Drawing.SizeF(6F, 13F);
            this.AutoScaleMode = System.Windows.Forms.AutoScaleMode.Font;
            this.BackColor = System.Drawing.Color.White;
            this.ClientSize = new System.Drawing.Size(1392, 659);
            this.Controls.Add(this.MainMenu);
            this.Controls.Add(this.splitContainer1);
            this.Icon = ((System.Drawing.Icon)(resources.GetObject("$this.Icon")));
            this.MainMenuStrip = this.MainMenu;
            this.Name = "Centura2Java";
            this.StartPosition = System.Windows.Forms.FormStartPosition.CenterScreen;
            this.Text = "Centura2Java Converter";
            this.FormClosing += new System.Windows.Forms.FormClosingEventHandler(this.Centura2Java_FormClosing);
            this.MainMenu.ResumeLayout(false);
            this.MainMenu.PerformLayout();
            this.splitContainer1.Panel1.ResumeLayout(false);
            this.splitContainer1.Panel1.PerformLayout();
            this.splitContainer1.Panel2.ResumeLayout(false);
            this.splitContainer1.Panel2.PerformLayout();
            this.splitContainer1.ResumeLayout(false);
            this.ResumeLayout(false);
            this.PerformLayout();

        }

        #endregion

        private System.Windows.Forms.MenuStrip MainMenu;
        private System.Windows.Forms.ToolStripMenuItem fileToolStripMenuItem;
        private System.Windows.Forms.ToolStripMenuItem loadCenturaCodeToolStripMenuItem;
        private System.Windows.Forms.ToolStripMenuItem exitToolStripMenuItem;
        private System.Windows.Forms.Label label1;
        private System.Windows.Forms.Label label_Java;
        public System.Windows.Forms.ListBox LB_CenturaCode;
        private System.Windows.Forms.SplitContainer splitContainer1;
        private System.Windows.Forms.ToolStripMenuItem saveJavaCodeToolStripMenuItem;
        private System.Windows.Forms.ToolStripMenuItem convertToJavaToolStripMenuItem;
        private System.Windows.Forms.ToolStripMenuItem actionsToolStripMenuItem;
        private System.Windows.Forms.ToolStripMenuItem undoToolStripMenuItem;
        private System.Windows.Forms.ToolStripMenuItem redoToolStripMenuItem;
        private System.Windows.Forms.ToolStripMenuItem copyJavaCodeToolStripMenuItem;
        private System.Windows.Forms.ToolStripMenuItem copyCenturaGuptaCodeToolStripMenuItem;
        private System.Windows.Forms.ToolStripMenuItem findToolStripMenuItem;
        public System.Windows.Forms.RichTextBox rtb_JavaCode;
        private System.Windows.Forms.ProgressBar pb1;
    }
}

