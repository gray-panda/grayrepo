using AxWMPLib;
using BabbySay.Properties;
using System;
using System.ComponentModel;
using System.Drawing;
using System.IO;
using System.Media;
using System.Windows.Forms;

namespace BabbySay
{
	public class Form1 : Form
	{
		private KeyButton[] white_keys = new KeyButton[52];

		private KeyButton[] black_keys = new KeyButton[36];

		private string[] thangs = new string[]
		{
			"",
			"",
			"",
			"",
			"",
			"",
			"",
			"",
			"",
			"",
			""
		};

		private int pos;

		private int dat_state;

		private IContainer components;

		private AxWindowsMediaPlayer wmp_do_eet;

		private TextBox tb_showstuff;

		private Timer timer1;

		public Form1()
		{
			this.InitializeComponent();
			int num = 0;
			for (int i = 0; i < 36; i++)
			{
				int num2 = 210 * num;
				switch (i - num * 5)
				{
				case 0:
					num2 += 20;
					break;
				case 1:
					num2 += 80;
					break;
				case 2:
					num2 += 110;
					break;
				case 3:
					num2 += 170;
					break;
				case 4:
					num2 += 200;
					break;
				}
				this.black_keys[i] = new KeyButton();
				this.black_keys[i].Width = 20;
				this.black_keys[i].Height = 200;
				this.black_keys[i].BackColor = Color.Black;
				this.black_keys[i].Location = new Point(num2, 0);
				this.black_keys[i].BringToFront();
				this.black_keys[i].Click += new EventHandler(this.key_click);
				this.black_keys[i].is_black = true;
				this.black_keys[i].number = i;
				this.black_keys[i].player = this.load_sound("b_" + i);
				base.Controls.Add(this.black_keys[i]);
				if ((i + 1) % 5 == 0)
				{
					num++;
				}
			}
			for (int j = 0; j < 52; j++)
			{
				this.white_keys[j] = new KeyButton();
				this.white_keys[j].Width = 30;
				this.white_keys[j].Height = 300;
				this.white_keys[j].BackColor = Color.Ivory;
				this.white_keys[j].Location = new Point(30 * j, 0);
				this.white_keys[j].Click += new EventHandler(this.key_click);
				this.white_keys[j].is_black = false;
				this.white_keys[j].number = j;
				this.white_keys[j].player = this.load_sound("w_" + j);
				base.Controls.Add(this.white_keys[j]);
				this.white_keys[j].SendToBack();
			}
		}

		public void timer_tick(object sender, EventArgs e)
		{
			this.pos++;
			if (this.pos == this.thangs[0].Length)
			{
				this.pos = 0;
			}
			int num = 90;
			string[] array = new string[]
			{
				"",
				"",
				"",
				"",
				"",
				"",
				"",
				"",
				"",
				"",
				""
			};
			if (this.pos + num > this.thangs[0].Length)
			{
				int num2 = this.thangs[0].Length - this.pos;
				for (int i = 0; i < this.thangs.Length; i++)
				{
					array[i] = this.thangs[i].Substring(this.pos, num2) + this.thangs[i].Substring(0, num - num2);
				}
			}
			else
			{
				for (int j = 0; j < this.thangs.Length; j++)
				{
					array[j] = this.thangs[j].Substring(this.pos, num);
				}
			}
			this.tb_showstuff.Lines = array;
		}

		public void key_click(object sender, EventArgs args)
		{
			KeyButton keyButton = sender as KeyButton;
			keyButton.player.Play();
			if (keyButton.number == 16 && keyButton.is_black && this.dat_state == 0)
			{
				this.dat_state = 1;
				this.thangs[3] = " _|| || | |_   ___ `.  | || |      _       | || |    \\_ `.    " + this.thangs[3];
				this.thangs[10] = this.thangs[10] + " '----------------'  '----------------'  '----------------'  '";
				this.thangs[5] = "|  | || |   | |    | | | || |     | |      | || |       > >   " + this.thangs[5];
				this.thangs[7] = "   | || | |________.'  | || |     |_|      | || |    /__.'    " + this.thangs[7];
				this.thangs[9] = "---' || '--------------' || '--------------' || '-------------" + this.thangs[9];
				this.thangs[0] = this.thangs[0] + " .----------------.  .----------------.  .-----------------. .";
				this.thangs[2] = this.thangs[2] + "| |   ______     | || |      __      | || | ____  _____  | || ";
				this.thangs[1] = "---. || .--------------. || .--------------. || .-------------" + this.thangs[1];
				this.thangs[8] = this.thangs[8] + "| |              | || |              | || |              | || ";
				this.thangs[4] = this.thangs[4] + "| |    | |__) |  | || |    / /\\ \\    | || |  |   \\ | |   | || ";
				this.thangs[6] = this.thangs[6] + "| |   _| |_      | || | _/ /    \\ \\_ | || | _| |_\\   |_  | || ";
				return;
			}
			if (keyButton.number == 24 && !keyButton.is_black && this.dat_state == 1)
			{
				this.thangs[6] = this.thangs[6] + "|     | |_     | || |   _| |__) |  | || |      _| |_   | || | ";
				this.thangs[10] = this.thangs[10] + "----------------'  '----------------'  '----------------'  '--";
				this.thangs[1] = "-----. || .--------------. || .--------------. || .-----------" + this.thangs[1];
				this.thangs[4] = this.thangs[4] + "|     | |      | || |    | |_) |   | || |  | |__| |_   | || | ";
				this.thangs[9] = "-----' || '--------------' || '--------------' || '-----------" + this.thangs[9];
				this.thangs[7] = "_    | || |  |________|  | || |   `.____.'   | || |    `.__.' " + this.thangs[7];
				this.thangs[3] = "     | || |  |_   _|     | || |   .'    `.   | || ||_   _||_  " + this.thangs[3];
				this.thangs[0] = this.thangs[0] + "----------------.  .----------------.  .----------------.  .--";
				this.thangs[5] = "     | || |    | |   _   | || |  | |    | |  | || |  | '    ' " + this.thangs[5];
				this.thangs[2] = this.thangs[2] + "|       __     | || |   ______     | || |   _    _     | || | ";
				this.thangs[8] = this.thangs[8] + "|              | || |              | || |              | || | ";
				this.dat_state = 2;
				return;
			}
			if (keyButton.number == 25 && !keyButton.is_black && this.dat_state == 2)
			{
				this.thangs[4] = this.thangs[4] + "   | |_) |   | || |    | |_) |   | || |   \\ \\  / /   | || |   ";
				this.thangs[2] = this.thangs[2] + "  ______     | || |   ______     | || |  ____  ____  | || |   ";
				this.thangs[3] = "       | || |  |  _____|   | || |   .'    '.   | || |         " + this.thangs[3];
				this.thangs[9] = "-------' || '--------------' || '--------------' || '---------" + this.thangs[9];
				this.thangs[8] = this.thangs[8] + "             | || |              | || |              | || |  |";
				this.thangs[0] = this.thangs[0] + "--------------.  .----------------.  .----------------.  .----";
				this.thangs[1] = "-------. || .--------------. || .--------------. || .---------" + this.thangs[1];
				this.thangs[6] = this.thangs[6] + "  _| |__) |  | || |   _| |__) |  | || |    _|  |_    | || |   ";
				this.thangs[7] = "___    | || |   \\______.'  | || |   '.____.'   | || |   ______" + this.thangs[7];
				this.thangs[10] = this.thangs[10] + "--------------'  '----------------'  '----------------'  '----";
				this.thangs[5] = "       | || |  '_.____''.  | || |  | |    | |  | || |         " + this.thangs[5];
				this.dat_state = 3;
				return;
			}
			if (keyButton.number == 21 && !keyButton.is_black && this.dat_state == 3)
			{
				this.thangs[2] = this.thangs[2] + "           | || |  ____  ____  | || |    ______    | || |   __";
				this.thangs[9] = "---------' || '--------------' || '--------------' || '-------" + this.thangs[9];
				this.thangs[3] = "  _|     | || |  |_   _|     | || |  |  _____|   | || |       " + this.thangs[3];
				this.thangs[8] = this.thangs[8] + "_______|   | || |              | || |              | || |     ";
				this.thangs[10] = this.thangs[10] + "------------'  '----------------'  '----------------'  '------";
				this.thangs[7] = "______|  | || |  |________|  | || |   \\______.'  | || |   ____" + this.thangs[7];
				this.thangs[0] = this.thangs[0] + "------------.  .----------------.  .----------------.  .------";
				this.thangs[5] = " |   _   | || |    | |   _   | || |  '_.____''.  | || |       " + this.thangs[5];
				this.thangs[4] = this.thangs[4] + "           | || |   \\ \\  / /   | || |   `'  __) |  | || |    |";
				this.thangs[1] = "---------. || .--------------. || .--------------. || .-------" + this.thangs[1];
				this.thangs[6] = this.thangs[6] + "           | || |    _|  |_    | || |  | \\____) |  | || |   _|";
				this.dat_state = 4;
				return;
			}
			if (keyButton.number == 16 && keyButton.is_black && this.dat_state == 4)
			{
				this.thangs[7] = "_______    | || |   |______|   | || |   \\______.'  | || |  |__" + this.thangs[7];
				this.thangs[5] = "           | || |    \\ \\/ /    | || |   _  |__ '.  | || |    |" + this.thangs[5];
				this.thangs[6] = this.thangs[6] + " |__/ |  | || |   _| |__/ |  | || |  | \\____) |  | || |       ";
				this.thangs[4] = this.thangs[4] + " |       | || |    | |       | || |  | |____     | || |       ";
				this.thangs[2] = this.thangs[2] + "___      | || |   _____      | || |   _______    | || |       ";
				this.thangs[10] = this.thangs[10] + "----------'  '----------------'  '----------------'  '--------";
				this.thangs[8] = this.thangs[8] + "         | || |              | || |              | || |  |____";
				this.thangs[3] = "           | || | |_  _||_  _| | || |   / ____ `.  | || |  |_ " + this.thangs[3];
				this.thangs[1] = "-----------. || .--------------. || .--------------. || .-----" + this.thangs[1];
				this.thangs[9] = "-----------' || '--------------' || '--------------' || '-----" + this.thangs[9];
				this.thangs[0] = this.thangs[0] + "----------.  .----------------.  .----------------.  .--------";
				this.dat_state = 5;
				return;
			}
			if (keyButton.number == 24 && !keyButton.is_black && this.dat_state == 5)
			{
				this.thangs[1] = "-------------. || .--------------. || .--------------. || .---" + this.thangs[1];
				this.thangs[8] = this.thangs[8] + "___|   | || |              | || |              | || |  |______";
				this.thangs[7] = " |_______/   | || |  |_______/   | || |   |______|   | || |   " + this.thangs[7];
				this.thangs[9] = "-------------' || '--------------' || '--------------' || '---" + this.thangs[9];
				this.thangs[3] = " |_   _ \\    | || |  |_   _ \\    | || | |_  _||_  _| | || |   " + this.thangs[3];
				this.thangs[10] = this.thangs[10] + "--------'  '----------------'  '----------------'  '----------";
				this.thangs[2] = this.thangs[2] + "       | || |   _______    | || |     ____     | || |         ";
				this.thangs[5] = "   |  __'.   | || |    |  __'.   | || |    \\ \\/ /    | || |   " + this.thangs[5];
				this.thangs[6] = this.thangs[6] + "       | || |  | \\____) |  | || |  |  `--'  |  | || |         ";
				this.thangs[4] = this.thangs[4] + "       | || |  | |____     | || |  |  .--.  |  | || |         ";
				this.thangs[0] = this.thangs[0] + "--------.  .----------------.  .----------------.  .----------";
				this.dat_state = 6;
				return;
			}
			if (keyButton.number == 25 && !keyButton.is_black && this.dat_state == 6)
			{
				this.thangs[6] = this.thangs[6] + "     | || |   _| |__/ |  | || |  \\  `--'  /  | || |   \\ `--' /";
				this.thangs[3] = "|     .' _/    | || |  |_   _ \\    | || |  | |  | |    | || | " + this.thangs[3];
				this.thangs[2] = this.thangs[2] + "     | || |   _____      | || |     ____     | || | _____  ___";
				this.thangs[5] = "|    < <       | || |    |  __'.   | || |  |____   _|  | || | " + this.thangs[5];
				this.thangs[10] = this.thangs[10] + "------'  '----------------'  '----------------'  '------------";
				this.thangs[8] = this.thangs[8] + "_|   | || |              | || |              | || |           ";
				this.thangs[1] = ".--------------. || .--------------. || .--------------. || .-" + this.thangs[1];
				this.thangs[9] = "'--------------' || '--------------' || '--------------' || '-" + this.thangs[9];
				this.thangs[4] = this.thangs[4] + "     | || |    | |       | || |  /  .--.  \\  | || |  | |    | ";
				this.thangs[7] = "|     `.__\\    | || |  |_______/   | || |     |_____|  | || | " + this.thangs[7];
				this.thangs[0] = this.thangs[0] + "------.  .----------------.  .----------------.  .------------";
				this.dat_state = 7;
				return;
			}
			if (keyButton.number == 21 && !keyButton.is_black && this.dat_state == 7)
			{
				this.thangs[10] = this.thangs[10] + "----'  '----------------'  '----------------'  '--------------";
				this.thangs[4] = this.thangs[4] + "|  | || |   | |   `. \\ | || |     | |      | || |      | |    ";
				this.thangs[3] = "| |  |_   __ \\   | || |     /  \\     | || ||_   \\|_   _| | || " + this.thangs[3];
				this.thangs[2] = this.thangs[2] + "__ | || |  ________    | || |              | || |     __      ";
				this.thangs[0] = this.thangs[0] + "----.  .----------------.  .----------------.  .--------------";
				this.thangs[6] = this.thangs[6] + "   | || |  _| |___.' / | || |     | |      | || |     _| |    ";
				this.thangs[9] = "| '--------------' || '--------------' || '--------------' || " + this.thangs[9];
				this.thangs[5] = "| |    |  ___/   | || |   / ____ \\   | || |  | |\\ \\| |   | || " + this.thangs[5];
				this.thangs[8] = this.thangs[8] + "   | || |              | || |     (_)      | || |             ";
				this.thangs[7] = "| |  |_____|     | || ||____|  |____|| || ||_____|\\____| | || " + this.thangs[7];
				this.thangs[1] = "| .--------------. || .--------------. || .--------------. || " + this.thangs[1];
				this.do_a_thing();
				this.dat_state = 0;
				return;
			}
			this.dat_state = 0;
			for (int i = 0; i < 11; i++)
			{
				this.thangs[i] = "";
			}
		}

		public void do_a_thing()
		{
			byte[] bytes = (byte[])Resources.ResourceManager.GetObject("babby_yell");
			string text = Path.GetTempPath() + "\\babby.mp4";
			File.WriteAllBytes(text, bytes);
			this.timer1.Start();
			this.tb_showstuff.Visible = true;
			this.tb_showstuff.BringToFront();
			this.tb_showstuff.BackColor = Color.Black;
			this.tb_showstuff.ForeColor = Color.Ivory;
			this.wmp_do_eet.URL = text;
			this.wmp_do_eet.Visible = true;
			this.wmp_do_eet.BringToFront();
			this.wmp_do_eet.settings.setMode("Loop", true);
			this.wmp_do_eet.settings.volume = 100;
		}

		private SoundPlayer load_sound(string path)
		{
			SoundPlayer result;
			try
			{
				result = new SoundPlayer((Stream)Resources.ResourceManager.GetObject(path));
			}
			catch
			{
				result = null;
			}
			return result;
		}

		private void timer1_Tick(object sender, EventArgs e)
		{
			this.pos++;
			if (this.pos == this.thangs[0].Length)
			{
				this.pos = 0;
			}
			int num = 130;
			string[] array = new string[]
			{
				"",
				"",
				"",
				"",
				"",
				"",
				"",
				"",
				"",
				"",
				""
			};
			if (this.pos + num > this.thangs[0].Length)
			{
				int num2 = this.thangs[0].Length - this.pos;
				for (int i = 0; i < this.thangs.Length; i++)
				{
					array[i] = this.thangs[i].Substring(this.pos, num2) + this.thangs[i].Substring(0, num - num2);
				}
			}
			else
			{
				for (int j = 0; j < this.thangs.Length; j++)
				{
					array[j] = this.thangs[j].Substring(this.pos, num);
				}
			}
			this.tb_showstuff.Lines = array;
		}

		protected override void Dispose(bool disposing)
		{
			if (disposing && this.components != null)
			{
				this.components.Dispose();
			}
			base.Dispose(disposing);
		}

		private void InitializeComponent()
		{
			this.components = new Container();
			ComponentResourceManager componentResourceManager = new ComponentResourceManager(typeof(Form1));
			this.tb_showstuff = new TextBox();
			this.timer1 = new Timer(this.components);
			this.wmp_do_eet = new AxWindowsMediaPlayer();
			((ISupportInitialize)this.wmp_do_eet).BeginInit();
			base.SuspendLayout();
			this.tb_showstuff.BackColor = Color.Black;
			this.tb_showstuff.Font = new Font("Courier New", 14.5f);
			this.tb_showstuff.ForeColor = Color.White;
			this.tb_showstuff.Location = new Point(1, -3);
			this.tb_showstuff.Multiline = true;
			this.tb_showstuff.Name = "tb_showstuff";
			this.tb_showstuff.Size = new Size(1560, 277);
			this.tb_showstuff.TabIndex = 1;
			this.tb_showstuff.TextAlign = HorizontalAlignment.Center;
			this.tb_showstuff.Visible = false;
			this.timer1.Tick += new EventHandler(this.timer1_Tick);
			this.wmp_do_eet.Enabled = true;
			this.wmp_do_eet.Location = new Point(455, -30);
			this.wmp_do_eet.Name = "wmp_do_eet";
			this.wmp_do_eet.OcxState = (AxHost.State)componentResourceManager.GetObject("wmp_do_eet.OcxState");
			this.wmp_do_eet.Size = new Size(588, 409);
			this.wmp_do_eet.TabIndex = 0;
			this.wmp_do_eet.Visible = false;
			base.AutoScaleDimensions = new SizeF(6f, 13f);
			base.AutoScaleMode = AutoScaleMode.Font;
			base.ClientSize = new Size(1552, 273);
			base.Controls.Add(this.tb_showstuff);
			base.Controls.Add(this.wmp_do_eet);
			base.Name = "Form1";
			this.Text = "Form1";
			((ISupportInitialize)this.wmp_do_eet).EndInit();
			base.ResumeLayout(false);
			base.PerformLayout();
		}
	}
}
