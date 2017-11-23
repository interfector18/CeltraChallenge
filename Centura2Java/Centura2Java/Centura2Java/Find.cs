using System;
using System.Collections.Generic;
using System.ComponentModel;
using System.Data;
using System.Drawing;
using System.Linq;
using System.Text;
using System.Windows.Forms;


namespace Centura2Java
{
    public partial class Find : Form
    {
        public Find()
        {
            InitializeComponent();
        }

        private void btn_Search_Click(object sender, EventArgs e)
        {
            this.Close();
        }

        private void tb_findWord_TextChanged(object sender, EventArgs e)
        {
            
        }
    }
}
