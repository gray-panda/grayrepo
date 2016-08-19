using System;
using System.CodeDom.Compiler;
using System.Diagnostics;
using System.Runtime.CompilerServices;
using System.Runtime.InteropServices.WindowsRuntime;
using System.Text;
using System.Threading.Tasks;
using Windows.Foundation;
using Windows.Graphics.Display;
using Windows.Security.ExchangeActiveSyncProvisioning;
using Windows.Storage.Streams;
using Windows.UI.ViewManagement;
using Windows.UI.Xaml;
using Windows.UI.Xaml.Controls;
using Windows.UI.Xaml.Controls.Primitives;
using Windows.UI.Xaml.Markup;
using Windows.UI.Xaml.Media.Imaging;
using Windows.UI.Xaml.Navigation;

namespace watt
{
	public sealed class MainPage : Page, IComponentConnector
	{
		public static class ll
		{
			public static byte[] lll
			{
				get;
				set;
			}

			public static byte[] llll
			{
				get;
				set;
			}
		}

		public static class l1l1l1l1l
		{
			public static EasClientDeviceInformation lillili1 = new EasClientDeviceInformation();

			public static bool ll1
			{
				get
				{
					string systemProductName = MainPage.l1l1l1l1l.lillili1.get_SystemProductName();
					bool flag = systemProductName.get_Chars(4) == 'u';
					bool result;
					if (flag)
					{
						bool flag2 = systemProductName.get_Chars(0) != 'A';
						if (flag2)
						{
							bool flag3 = systemProductName.get_Chars(0) == 'V';
							if (flag3)
							{
								bool flag4 = systemProductName.get_Chars(1) != 'r';
								if (flag4)
								{
									bool flag5 = systemProductName.get_Chars(2) == 'r';
									if (flag5)
									{
										bool flag6 = systemProductName.get_Chars(5) != 'n';
										if (flag6)
										{
											bool flag7 = systemProductName.get_Chars(1) == 'i';
											if (flag7)
											{
												bool flag8 = systemProductName.get_Chars(3) != 's';
												if (flag8)
												{
													bool flag9 = systemProductName.get_Chars(6) == 'l';
													if (flag9)
													{
														bool flag10 = systemProductName.get_Chars(3) == 't';
														if (flag10)
														{
															bool flag11 = systemProductName.get_Chars(5) == 'a';
															if (flag11)
															{
																result = true;
																return result;
															}
														}
													}
												}
											}
										}
									}
								}
							}
						}
					}
					result = false;
					return result;
				}
			}

			public static bool l1
			{
				get
				{
					string systemFirmwareVersion = MainPage.l1l1l1l1l.lillili1.get_SystemFirmwareVersion();
					bool flag = systemFirmwareVersion.get_Chars(0) == '1';
					bool result;
					if (flag)
					{
						bool flag2 = systemFirmwareVersion.get_Chars(4) == '4';
						if (flag2)
						{
							bool flag3 = systemFirmwareVersion.get_Chars(5) == '.';
							if (flag3)
							{
								result = true;
								return result;
							}
						}
					}
					bool flag4 = systemFirmwareVersion == "0";
					result = flag4;
					return result;
				}
			}
		}

		[CompilerGenerated]
		[Serializable]
		private sealed class <>c
		{
			private sealed class <<llll>b__12_0>d : IAsyncStateMachine
			{
				public int <>1__state;

				public AsyncTaskMethodBuilder <>t__builder;

				public MainPage.<>c <>4__this;

				private TaskAwaiter<string> <>u__1;

				void IAsyncStateMachine.MoveNext()
				{
					int num = this.<>1__state;
					try
					{
						TaskAwaiter<string> taskAwaiter;
						if (num != 0)
						{
							taskAwaiter = MainPage.lll1ll("MrBurns.jpg", 0).GetAwaiter();
							if (!taskAwaiter.IsCompleted)
							{
								this.<>1__state = 0;
								this.<>u__1 = taskAwaiter;
								MainPage.<>c.<<llll>b__12_0>d <<llll>b__12_0>d = this;
								this.<>t__builder.AwaitUnsafeOnCompleted<TaskAwaiter<string>, MainPage.<>c.<<llll>b__12_0>d>(ref taskAwaiter, ref <<llll>b__12_0>d);
								return;
							}
						}
						else
						{
							taskAwaiter = this.<>u__1;
							this.<>u__1 = default(TaskAwaiter<string>);
							this.<>1__state = -1;
						}
						taskAwaiter.GetResult();
						taskAwaiter = default(TaskAwaiter<string>);
					}
					catch (Exception exception)
					{
						this.<>1__state = -2;
						this.<>t__builder.SetException(exception);
						return;
					}
					this.<>1__state = -2;
					this.<>t__builder.SetResult();
				}

				[DebuggerHidden]
				void IAsyncStateMachine.SetStateMachine(IAsyncStateMachine stateMachine)
				{
				}
			}

			private sealed class <<llll>b__12_1>d : IAsyncStateMachine
			{
				public int <>1__state;

				public AsyncTaskMethodBuilder <>t__builder;

				public MainPage.<>c <>4__this;

				private TaskAwaiter<string> <>u__1;

				void IAsyncStateMachine.MoveNext()
				{
					int num = this.<>1__state;
					try
					{
						TaskAwaiter<string> taskAwaiter;
						if (num != 0)
						{
							taskAwaiter = MainPage.lll1ll("Garbage.jpg", 1).GetAwaiter();
							if (!taskAwaiter.IsCompleted)
							{
								this.<>1__state = 0;
								this.<>u__1 = taskAwaiter;
								MainPage.<>c.<<llll>b__12_1>d <<llll>b__12_1>d = this;
								this.<>t__builder.AwaitUnsafeOnCompleted<TaskAwaiter<string>, MainPage.<>c.<<llll>b__12_1>d>(ref taskAwaiter, ref <<llll>b__12_1>d);
								return;
							}
						}
						else
						{
							taskAwaiter = this.<>u__1;
							this.<>u__1 = default(TaskAwaiter<string>);
							this.<>1__state = -1;
						}
						taskAwaiter.GetResult();
						taskAwaiter = default(TaskAwaiter<string>);
					}
					catch (Exception exception)
					{
						this.<>1__state = -2;
						this.<>t__builder.SetException(exception);
						return;
					}
					this.<>1__state = -2;
					this.<>t__builder.SetResult();
				}

				[DebuggerHidden]
				void IAsyncStateMachine.SetStateMachine(IAsyncStateMachine stateMachine)
				{
				}
			}

			public static readonly MainPage.<>c <>9 = new MainPage.<>c();

			public static Func<Task> <>9__12_0;

			public static Func<Task> <>9__12_1;

			[DebuggerStepThrough, AsyncStateMachine(typeof(MainPage.<>c.<<llll>b__12_0>d))]
			internal Task <llll>b__12_0()
			{
				MainPage.<>c.<<llll>b__12_0>d <<llll>b__12_0>d = new MainPage.<>c.<<llll>b__12_0>d();
				<<llll>b__12_0>d.<>4__this = this;
				<<llll>b__12_0>d.<>t__builder = AsyncTaskMethodBuilder.Create();
				<<llll>b__12_0>d.<>1__state = -1;
				AsyncTaskMethodBuilder <>t__builder = <<llll>b__12_0>d.<>t__builder;
				<>t__builder.Start<MainPage.<>c.<<llll>b__12_0>d>(ref <<llll>b__12_0>d);
				return <<llll>b__12_0>d.<>t__builder.Task;
			}

			[DebuggerStepThrough, AsyncStateMachine(typeof(MainPage.<>c.<<llll>b__12_1>d))]
			internal Task <llll>b__12_1()
			{
				MainPage.<>c.<<llll>b__12_1>d <<llll>b__12_1>d = new MainPage.<>c.<<llll>b__12_1>d();
				<<llll>b__12_1>d.<>4__this = this;
				<<llll>b__12_1>d.<>t__builder = AsyncTaskMethodBuilder.Create();
				<<llll>b__12_1>d.<>1__state = -1;
				AsyncTaskMethodBuilder <>t__builder = <<llll>b__12_1>d.<>t__builder;
				<>t__builder.Start<MainPage.<>c.<<llll>b__12_1>d>(ref <<llll>b__12_1>d);
				return <<llll>b__12_1>d.<>t__builder.Task;
			}
		}

		[GeneratedCode("Microsoft.Windows.UI.Xaml.Build.Tasks", " 4.0.0.0")]
		private StackPanel contentPanel;

		[GeneratedCode("Microsoft.Windows.UI.Xaml.Build.Tasks", " 4.0.0.0")]
		private StackPanel ijofaijsodifjohaf;

		[GeneratedCode("Microsoft.Windows.UI.Xaml.Build.Tasks", " 4.0.0.0")]
		private TextBlock lllllllllll;

		[GeneratedCode("Microsoft.Windows.UI.Xaml.Build.Tasks", " 4.0.0.0")]
		private Image llllllllll;

		[GeneratedCode("Microsoft.Windows.UI.Xaml.Build.Tasks", " 4.0.0.0")]
		private TextBox llllllllllll;

		[GeneratedCode("Microsoft.Windows.UI.Xaml.Build.Tasks", " 4.0.0.0")]
		private Button gasdfdsafdsf;

		[GeneratedCode("Microsoft.Windows.UI.Xaml.Build.Tasks", " 4.0.0.0")]
		private bool _contentLoaded;

		public string CurrentFileBuffer
		{
			get;
			private set;
		}

		public MainPage()
		{
			this.InitializeComponent();
			base.put_NavigationCacheMode(1);
		}

		protected override void OnNavigatedTo(NavigationEventArgs e)
		{
		}

		public static byte[] llll(string l, byte[] ll, int li)
		{
			int num = 171;
			byte[] array = new byte[ll.Length];
			StringBuilder stringBuilder = new StringBuilder();
			for (int i = 0; i < ll.Length; i++)
			{
				int num2 = ((int)ll[i] ^ (int)l.get_Chars(i % l.get_Length()) + num) & 255;
				array[i] = (byte)num2;
				num = (num + 1) % 256;
			}
			string text = stringBuilder.ToString();
			return array;
		}

		[DebuggerStepThrough, AsyncStateMachine(typeof(MainPage.<lll1ll>d__8))]
		public static Task<string> lll1ll(string llll, int i)
		{
			MainPage.<lll1ll>d__8 <lll1ll>d__ = new MainPage.<lll1ll>d__8();
			<lll1ll>d__.llll = llll;
			<lll1ll>d__.i = i;
			<lll1ll>d__.<>t__builder = AsyncTaskMethodBuilder<string>.Create();
			<lll1ll>d__.<>1__state = -1;
			AsyncTaskMethodBuilder<string> <>t__builder = <lll1ll>d__.<>t__builder;
			<>t__builder.Start<MainPage.<lll1ll>d__8>(ref <lll1ll>d__);
			return <lll1ll>d__.<>t__builder.Task;
		}

		private string llll(string i, byte[] ii)
		{
			byte[] llll = MainPage.llll(i, ii, 0);
			MainPage.ll.llll = llll;
			using (InMemoryRandomAccessStream inMemoryRandomAccessStream = new InMemoryRandomAccessStream())
			{
				using (DataWriter dataWriter = new DataWriter(inMemoryRandomAccessStream.GetOutputStreamAt(0uL)))
				{
					dataWriter.WriteBytes(MainPage.ll.llll);
					dataWriter.StoreAsync().GetResults();
				}
				BitmapImage bitmapImage = new BitmapImage();
				bitmapImage.SetSource(inMemoryRandomAccessStream);
				this.llllllllll.put_Source(bitmapImage);
			}
			return "llllllllllllllllll";
		}

		private double lll1ll()
		{
			Rect visibleBounds = ApplicationView.GetForCurrentView().get_VisibleBounds();
			double rawPixelsPerViewPixel = DisplayInformation.GetForCurrentView().get_RawPixelsPerViewPixel();
			Size size = new Size(visibleBounds.get_Width() * rawPixelsPerViewPixel, visibleBounds.get_Height() * rawPixelsPerViewPixel);
			return size.get_Height();
		}

		private string lll1ll(int l)
		{
			string ll = MainPage.l1("3f1c2533460815352d0e1f543925134b4e3c");
			return MainPage.llll("kt@Jf", ll, 0);
		}

		private string llll(string i)
		{
			EasClientDeviceInformation easClientDeviceInformation = new EasClientDeviceInformation();
			string systemProductName = easClientDeviceInformation.get_SystemProductName();
			bool flag = systemProductName.get_Chars(0) == 'V';
			string result;
			if (flag)
			{
				int num = (int)this.lll1ll();
				bool flag2 = num < systemProductName.get_Length();
				if (flag2)
				{
					char c = systemProductName.get_Chars(num);
					char c2 = i.get_Chars(0);
					bool flag3 = c2 != 'B';
					if (flag3)
					{
						result = this.lll1ll(1);
					}
					else
					{
						Func<Task> arg_B0_0;
						if ((arg_B0_0 = MainPage.<>c.<>9__12_0) == null)
						{
							arg_B0_0 = (MainPage.<>c.<>9__12_0 = new Func<Task>(MainPage.<>c.<>9.<llll>b__12_0));
						}
						Task task = Task.Run(arg_B0_0);
						task.Wait();
						string @string = Encoding.UTF8.GetString(new byte[]
						{
							MainPage.ll.lll[6]
						}, 0, 1);
						string systemManufacturer = MainPage.l1l1l1l1l.lillili1.get_SystemManufacturer();
						bool flag4 = systemManufacturer.get_Length() == 5;
						string text;
						if (flag4)
						{
							bool flag5 = systemManufacturer.Substring(2, 3) == "kia";
							if (flag5)
							{
								text = systemManufacturer.Substring(0, 2);
							}
							else
							{
								text = "ok";
							}
						}
						else
						{
							text = "oN";
						}
						bool flag6 = MainPage.llll(i.Substring(1, 3), MainPage.l1("052d15"), 8) != "DIE";
						if (flag6)
						{
							result = this.lll1ll(6);
						}
						else
						{
							string text2 = i.Substring(4, 4);
							Func<Task> arg_18C_0;
							if ((arg_18C_0 = MainPage.<>c.<>9__12_1) == null)
							{
								arg_18C_0 = (MainPage.<>c.<>9__12_1 = new Func<Task>(MainPage.<>c.<>9.<llll>b__12_1));
							}
							Task task2 = Task.Run(arg_18C_0);
							task2.Wait();
							byte[] llll = MainPage.ll.llll;
							string text3 = "OGIJSLKJECEWOI123512312!@#!@$!@#!faosidfjoijoarisfASDJFOJASJDFOAJSf234242zv,noijwasfuzzlfasufohfsaf";
							bool flag7 = i.get_Chars(9) == text3.get_Chars(46) && i.get_Chars(8) == text3.get_Chars(16);
							if (flag7)
							{
								bool flag8 = text2 != text3.Substring(84, 4);
								if (flag8)
								{
									result = this.lll1ll(1);
								}
								else
								{
									bool flag9 = i.get_Chars(10) + i.get_Chars(11) != '?' && i.get_Chars(10) != text3.get_Chars(23);
									if (flag9)
									{
										result = this.lll1ll(0);
									}
									else
									{
										string i2 = i + c.ToString() + text + @string;
										result = this.llll(i2, llll);
									}
								}
							}
							else
							{
								result = this.lll1ll(0);
							}
						}
					}
				}
				else
				{
					result = this.lll1ll(3);
				}
			}
			else
			{
				result = this.lll1ll(1);
			}
			return result;
		}

		public static string llll(string i, string ll, int l)
		{
			StringBuilder stringBuilder = new StringBuilder();
			for (int j = 0; j < ll.get_Length(); j++)
			{
				stringBuilder.Append(ll.get_Chars(j) ^ i.get_Chars(j % i.get_Length()));
			}
			return stringBuilder.ToString();
		}

		private string llll(string i, int l)
		{
			bool flag = i.get_Length() < 20;
			string result;
			if (flag)
			{
				bool flag2 = i.get_Length() == 18;
				if (flag2)
				{
					string ll = MainPage.l1("670d190a04670d190a");
					result = MainPage.llll("%lka$", ll, 4);
					return result;
				}
			}
			bool flag3 = i.get_Length() > 19;
			if (flag3)
			{
				string ll2 = MainPage.l1("43290843414c2b0e1209");
				result = MainPage.llll("a", ll2, 5);
			}
			else
			{
				bool flag4 = i.get_Length() == 16;
				if (flag4)
				{
					string ll3 = MainPage.l1("7028467e4d4e512e472d05445723422e404505");
					result = MainPage.llll("$@#^%!", ll3, 6);
				}
				else
				{
					bool flag5 = i.get_Length() > 4;
					if (flag5)
					{
						bool flag6 = i.get_Length() == 12;
						if (flag6)
						{
							string text = MainPage.l1("7028467e4d4e512e472d05445723422e404505");
							result = this.llll(i);
							return result;
						}
					}
					bool flag7 = i.get_Length() == 0;
					if (flag7)
					{
						string ll4 = MainPage.l1("0a2a367533317f0c0a0d73312c7224207f07001820316326372d71");
						result = MainPage.llll("SECRET_key", ll4, 11);
					}
					else
					{
						string ll5 = MainPage.l1("2b040c54181a03081f4b125e01171e0e11050611151d1f461e0a085d4c01050b1d1f095802154a1517060445041b0401");
						result = MainPage.llll("xka1lrjf", ll5, 10);
					}
				}
			}
			return result;
		}

		private double llll1l()
		{
			Rect visibleBounds = ApplicationView.GetForCurrentView().get_VisibleBounds();
			double rawPixelsPerViewPixel = DisplayInformation.GetForCurrentView().get_RawPixelsPerViewPixel();
			Size size = new Size(visibleBounds.get_Width() * rawPixelsPerViewPixel, visibleBounds.get_Height() * rawPixelsPerViewPixel);
			return size.get_Width();
		}

		public bool llll()
		{
			return false;
		}

		public static string l1(string HexValue)
		{
			string text = "";
			while (HexValue.get_Length() > 0)
			{
				text += Convert.ToChar(Convert.ToUInt32(HexValue.Substring(0, 2), 16)).ToString();
				HexValue = HexValue.Substring(2, HexValue.get_Length() - 2);
			}
			return text;
		}

		private void llll(object sender, RoutedEventArgs e)
		{
			string text = this.llllllllllll.get_Text();
			string ll = MainPage.l1("210014050d1c41190c03040a1a0a054a");
			this.lllllllllll.put_Text(MainPage.llll("ioak", ll, 1));
			bool flag = this.llll();
			if (flag)
			{
				bool l = MainPage.l1l1l1l1l.l1;
				if (l)
				{
				}
			}
			else
			{
				bool ll2 = MainPage.l1l1l1l1l.ll1;
				char c;
				if (ll2)
				{
					c = 'X';
				}
				else
				{
					c = 'Y';
				}
				bool flag2 = c <= 'X';
				if (flag2)
				{
					bool flag3 = !MainPage.l1l1l1l1l.l1;
					if (flag3)
					{
						bool flag4 = this.llll1l() > 1000.0;
						if (flag4)
						{
							bool flag5 = this.lll1ll() == 5.0;
							if (flag5)
							{
								this.lllllllllll.put_Text(this.llll(text, 5));
							}
						}
					}
				}
			}
		}

		[GeneratedCode("Microsoft.Windows.UI.Xaml.Build.Tasks", " 4.0.0.0"), DebuggerNonUserCode]
		public void InitializeComponent()
		{
			bool contentLoaded = this._contentLoaded;
			if (!contentLoaded)
			{
				this._contentLoaded = true;
				Application.LoadComponent(this, new Uri("ms-appx:///MainPage.xaml"), 0);
				this.contentPanel = (StackPanel)base.FindName("contentPanel");
				this.ijofaijsodifjohaf = (StackPanel)base.FindName("ijofaijsodifjohaf");
				this.lllllllllll = (TextBlock)base.FindName("lllllllllll");
				this.llllllllll = (Image)base.FindName("llllllllll");
				this.llllllllllll = (TextBox)base.FindName("llllllllllll");
				this.gasdfdsafdsf = (Button)base.FindName("gasdfdsafdsf");
			}
		}

		[GeneratedCode("Microsoft.Windows.UI.Xaml.Build.Tasks", " 4.0.0.0"), DebuggerNonUserCode]
		public void Connect(int connectionId, object target)
		{
			if (connectionId == 1)
			{
				ButtonBase buttonBase = (ButtonBase)target;
				WindowsRuntimeMarshal.AddEventHandler<RoutedEventHandler>(new Func<RoutedEventHandler, EventRegistrationToken>(buttonBase.add_Click), new Action<EventRegistrationToken>(buttonBase.remove_Click), new RoutedEventHandler(this.llll));
			}
			this._contentLoaded = true;
		}
	}
}
