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
		// ll
		public static class varStore 
		{
			public static byte[] varA // lll
			{
				get;
				set;
			}

			public static byte[] varB // llll
			{
				get;
				set;
			}
		}

		// l1l1l1l1l
		public static class systemChecker 
		{
			//public static EasClientDeviceInformation lillili1 = new EasClientDeviceInformation();
			public static EasClientDeviceInformation devInfo = new EasClientDeviceInformation();

			public static bool checkProductName { // ll1 // returns true if SystemProductName starts with "Virtual"
				get { return MainPage.systemChecker.devInfo.get_SystemProductName().startsWith("Virtual");}
			}

			public static bool checkFirmwareVersion { // l1 // returns true if SystemFirmwareVersion is "1???4." or "0"
				get {
					string systemFirmwareVersion = MainPage.systemChecker.devInfo.get_SystemFirmwareVersion();
					if (systemFirmwareVersion == "0") return true;
					return (systemFirmwareVersion.get_Chars(0) == '1' && systemFirmwareVersion.get_Chars(4) == '4' && systemFirmwareVersion.get_Chars(5) == '.');
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

				void IAsyncStateMachine.MoveNext() {
					int num = this.<>1__state;
					try {
						TaskAwaiter<string> taskAwaiter;
						if (num != 0) {
							taskAwaiter = MainPage.loadImageToVarStore("MrBurns.jpg", 0).GetAwaiter(); // 0 means go to varA
							if (!taskAwaiter.IsCompleted) {
								this.<>1__state = 0;
								this.<>u__1 = taskAwaiter;
								MainPage.<>c.<<llll>b__12_0>d <<llll>b__12_0>d = this;
								this.<>t__builder.AwaitUnsafeOnCompleted<TaskAwaiter<string>, MainPage.<>c.<<llll>b__12_0>d>(ref taskAwaiter, ref <<llll>b__12_0>d);
								return;
							}
						}
						else {
							taskAwaiter = this.<>u__1;
							this.<>u__1 = default(TaskAwaiter<string>);
							this.<>1__state = -1;
						}
						taskAwaiter.GetResult();
						taskAwaiter = default(TaskAwaiter<string>);
					}
					catch (Exception exception){
						this.<>1__state = -2;
						this.<>t__builder.SetException(exception);
						return;
					}
					this.<>1__state = -2;
					this.<>t__builder.SetResult();
				}

				[DebuggerHidden]
				void IAsyncStateMachine.SetStateMachine(IAsyncStateMachine stateMachine) { }
			}

			private sealed class <<llll>b__12_1>d : IAsyncStateMachine
			{
				public int <>1__state;
				public AsyncTaskMethodBuilder <>t__builder;
				public MainPage.<>c <>4__this;
				private TaskAwaiter<string> <>u__1;

				void IAsyncStateMachine.MoveNext() {
					int num = this.<>1__state;
					try {
						TaskAwaiter<string> taskAwaiter;
						if (num != 0) {
							taskAwaiter = MainPage.loadImageToVarStore("Garbage.jpg", 1).GetAwaiter(); // 1 means got to varB
							if (!taskAwaiter.IsCompleted) {
								this.<>1__state = 0;
								this.<>u__1 = taskAwaiter;
								MainPage.<>c.<<llll>b__12_1>d <<llll>b__12_1>d = this;
								this.<>t__builder.AwaitUnsafeOnCompleted<TaskAwaiter<string>, MainPage.<>c.<<llll>b__12_1>d>(ref taskAwaiter, ref <<llll>b__12_1>d);
								return;
							}
						}
						else {
							taskAwaiter = this.<>u__1;
							this.<>u__1 = default(TaskAwaiter<string>);
							this.<>1__state = -1;
						}
						taskAwaiter.GetResult();
						taskAwaiter = default(TaskAwaiter<string>);
					}
					catch (Exception exception) {
						this.<>1__state = -2;
						this.<>t__builder.SetException(exception);
						return;
					}
					this.<>1__state = -2;
					this.<>t__builder.SetResult();
				}

				[DebuggerHidden]
				void IAsyncStateMachine.SetStateMachine(IAsyncStateMachine stateMachine) { }
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

		private StackPanel contentPanel;
		private StackPanel uiStackPanel; // ijofaijsodifjohaf;
		private TextBlock uiTextBlock; // lllllllllll;
		private Image uiImage; // llllllllll;
		private TextBox uiTextBox; // llllllllllll;
		private Button uiButton; // gasdfdsafdsf;
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

		protected override void OnNavigatedTo(NavigationEventArgs e){}

		public static byte[] xorOffset171(string p1, byte[] p2, int p3) // llll xors l and ll with offset 171
		{
			int num = 171;
			byte[] array = new byte[p2.Length];
			StringBuilder stringBuilder = new StringBuilder();
			for (int i = 0; i < p2.Length; i++) {
				int num2 = ((int)p2[i] ^ (int)p1.get_Chars(i % p1.get_Length()) + num) & 255;
				array[i] = (byte)num2;
				num = (num + 1) % 256;
			}
			string text = stringBuilder.ToString();
			return array;
		}

		[DebuggerStepThrough, AsyncStateMachine(typeof(MainPage.<lll1ll>d__8))]
		public static Task<string> loadImageToVarStore(string llll, int i) // lll1ll builds something? image? create task?
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

		private string xorOffset171AndWrite(string p1, byte[] p2) // llll xors i and ii with offset 171, then writes results somethere, SETS MainPage.ll.llll !!!
		{
			MainPage.varStore.varB = MainPage.xorOffset171(p1, p2, 0); // xors i and ii with offset 0
			using (InMemoryRandomAccessStream inMemoryRandomAccessStream = new InMemoryRandomAccessStream()) {
				using (DataWriter dataWriter = new DataWriter(inMemoryRandomAccessStream.GetOutputStreamAt(0))) { // 0uL = 0 unsigned Long?
					dataWriter.WriteBytes(MainPage.varStore.varB); // dataWriter.WriteBytes(MainPage.ll.llll);
					dataWriter.StoreAsync().GetResults();
				}
				BitmapImage bitmapImage = new BitmapImage();
				bitmapImage.SetSource(inMemoryRandomAccessStream);
				this.uiImage.put_Source(bitmapImage);
			}
			return "llllllllllllllllll";
		}

		private double getVisibleHeight() // lll1ll() // get visibleBounds height?
		{
			Rect visibleBounds = ApplicationView.GetForCurrentView().get_VisibleBounds();
			double rawPixelsPerViewPixel = DisplayInformation.GetForCurrentView().get_RawPixelsPerViewPixel();
			Size size = new Size(visibleBounds.get_Width() * rawPixelsPerViewPixel, visibleBounds.get_Height() * rawPixelsPerViewPixel);
			return size.get_Height();
		}

		private string retFailMsg(int l) {return "They caught you :|";} // lll1ll

		private string evaluateInput(string i) // llll
		{
			EasClientDeviceInformation easClientDeviceInformation = new EasClientDeviceInformation();
			string systemProductName = easClientDeviceInformation.get_SystemProductName();
			string result;
			if (systemProductName.get_Chars(0) == 'V';) {
				int num = (int)this.getVisibleHeight(); // visible height must be 5
				if (num < systemProductName.get_Length()) {
					char c = systemProductName.get_Chars(num);
					if (i.get_Chars(0) != 'B'){ result = this.retFailMsg(1); } // i[0] == "B"
					else{
						Func<Task> arg_B0_0;
						if ((arg_B0_0 = MainPage.<>c.<>9__12_0) == null) {
							arg_B0_0 = (MainPage.<>c.<>9__12_0 = new Func<Task>(MainPage.<>c.<>9.<llll>b__12_0));
						}
						Task task = Task.Run(arg_B0_0);
						task.Wait();
						string @string = Encoding.UTF8.GetString(new byte[] { MainPage.varStore.varA[6] }, 0, 1); // MainPage.ll.lll[6] // set by what?
						string systemManufacturer = MainPage.systemChecker.devInfo.get_SystemManufacturer();
						string text;
						if (systemManufacturer.get_Length() == 5) {
							if (systemManufacturer.Substring(2, 3) == "kia") {
								text = systemManufacturer.Substring(0, 2); // I'm guessing "No"
							}
							else { text = "ok"; }
						}
						else { text = "oN"; }

						if (i.Substring(1, 3) != "Adp") { result = this.retFailMsg(6); }
						else {
							// i[1-3] = "Adp" , decoded with my php script
							string text2 = i.Substring(4, 4);
							Func<Task> arg_18C_0;
							if ((arg_18C_0 = MainPage.<>c.<>9__12_1) == null) {
								arg_18C_0 = (MainPage.<>c.<>9__12_1 = new Func<Task>(MainPage.<>c.<>9.<llll>b__12_1));
							}
							Task task2 = Task.Run(arg_18C_0);
							task2.Wait();
							byte[] storedVarB = MainPage.varStore.varB; // MainPage.ll.llll;
							string text3 = "OGIJSLKJECEWOI123512312!@#!@$!@#!faosidfjoijoarisfASDJFOJASJDFOAJSf234242zv,noijwasfuzzlfasufohfsaf";
							if (i.get_Chars(9) == text3.get_Chars(46) && i.get_Chars(8) == text3.get_Chars(16)) { // i[9] = "r", i[8] = "3"
								if (text2 != text3.Substring(84, 4)) { result = this.retFailMsg(1); }
								else {
									// i[4-7] = "uzzl"
									if (i.get_Chars(10) + i.get_Chars(11) != '?' && i.get_Chars(10) != text3.get_Chars(23);){ result = this.retFailMsg(0); }
									else{
										// i is "BAdPuzzl3r!?"
										// c.tostring ?? "Virtual"[5] = "a"
										// text is "No"
										// @string is MainPage.varStore.varA[6] UTF-8 encoded 7th byte of varA
										string i2 = i + c.ToString() + text + @string; 
										result = this.xorOffset171AndWrite(i2, storedVarB); // storedVarB is varStore.varB
									}
								}
							}
							else
							{
								result = this.retFailMsg(0); // return fail msg
							}
						}
					}
				}
				else
				{
					result = this.retFailMsg(3);// return fail msg
				}
			}
			else
			{
				result = this.retFailMsg(1); // return fail msg
			}
			return result;
		}

		public static string deobfuscate(string i, string ll, int l) // llll String Deobfuscator!! xors i and ll strings (xorstr)
		{
			StringBuilder stringBuilder = new StringBuilder();
			for (int j = 0; j < ll.get_Length(); j++)
			{
				stringBuilder.Append(ll.get_Chars(j) ^ i.get_Chars(j % i.get_Length()));
			}
			return stringBuilder.ToString();
		}

		private string getMsg(string i, int l) {// llll returns string based on length of i (special thing happens at length 12)
			string result;
			if (i.get_Length() == 18){return "Bark Bark";}
			else if (i.get_Length() > 19) {return '"Hi" -Josh';}
			else if (i.get_Length() == 16){return "The hounds escaped!";}
			else if (i.get_Length() == 12){
				string text = MainPage.unhex("7028467e4d4e512e472d05445723422e404505"); // some random char string?
				result = this.evaluateInput(i); // calls even more shit
				return result;
			}
			else if (i.get_Length() == 0){return "You've got to at least try.";}
			else { return "Something something you fail something something";}
		}

		private double getVisibleWidth() // llll1l() // get VisibleBounds width?
		{
			Rect visibleBounds = ApplicationView.GetForCurrentView().get_VisibleBounds();
			double rawPixelsPerViewPixel = DisplayInformation.GetForCurrentView().get_RawPixelsPerViewPixel();
			Size size = new Size(visibleBounds.get_Width() * rawPixelsPerViewPixel, visibleBounds.get_Height() * rawPixelsPerViewPixel);
			return size.get_Width();
		}

		public bool getFalse() { return false; } // llll() // returns false

		public static string unhex(string HexValue) // l1 converts hex string to char string
		{
			string text = "";
			while (HexValue.get_Length() > 0)
			{
				text += Convert.ToChar(Convert.ToUInt32(HexValue.Substring(0, 2), 16)).ToString();
				HexValue = HexValue.Substring(2, HexValue.get_Length() - 2);
			}
			return text;
		}

		private void handleEvent(object sender, RoutedEventArgs e) {// llll checks if SystemProductName and SystemFirmwareVersion is correct and display result text
			string text = this.uiTextBox.get_Text();
			this.uiTextBlock.put_Text("Hounds released!"); // "Hounds released!"
			if (MainPage.systemChecker.checkProductName){c = 'X';}
			else {c = 'Y';}
			
			if (c <= 'X') {
				if (!MainPage.systemChecker.checkFirmwareVersion;) {
					if (this.getVisibleWidth() > 1000.0) {
							if (this.getVisibleHeight() == 5.0) {
								this.uiTextBlock.put_Text(this.getMsg(text, 5)); // display specific text based on length of "text" string
							}
						}
					}
				}
			}
		}

		public void InitializeComponent()
		{
			bool contentLoaded = this._contentLoaded;
			if (!contentLoaded)
			{
				this._contentLoaded = true;
				Application.LoadComponent(this, new Uri("ms-appx:///MainPage.xaml"), 0);
				this.contentPanel = (StackPanel)base.FindName("contentPanel");
				this.uiStackPanel = (StackPanel)base.FindName("ijofaijsodifjohaf");
				this.uiTextBlock = (TextBlock)base.FindName("lllllllllll");
				this.uiImage = (Image)base.FindName("llllllllll");
				this.uiTextBox = (TextBox)base.FindName("llllllllllll");
				this.uiButton = (Button)base.FindName("gasdfdsafdsf");
			}
		}

		public void Connect(int connectionId, object target)
		{
			if (connectionId == 1)
			{
				ButtonBase buttonBase = (ButtonBase)target;
				WindowsRuntimeMarshal.AddEventHandler<RoutedEventHandler>(new Func<RoutedEventHandler, EventRegistrationToken>(buttonBase.add_Click), new Action<EventRegistrationToken>(buttonBase.remove_Click), new RoutedEventHandler(this.handleEvent));
			}
			this._contentLoaded = true;
		}
	}
}
