using System;
using System.CodeDom.Compiler;
using System.Collections.Generic;
using System.Diagnostics;
using System.Runtime.CompilerServices;
using System.Runtime.InteropServices.WindowsRuntime;
using watt.watt_XamlTypeInfo;
using Windows.ApplicationModel;
using Windows.ApplicationModel.Activation;
using Windows.Globalization;
using Windows.UI.Xaml;
using Windows.UI.Xaml.Controls;
using Windows.UI.Xaml.Markup;
using Windows.UI.Xaml.Media.Animation;
using Windows.UI.Xaml.Navigation;

namespace watt
{
	public sealed class App : Application, IComponentConnector, IXamlMetadataProvider
	{
		[CompilerGenerated]
		[Serializable]
		private sealed class <>c
		{
			public static readonly App.<>c <>9 = new App.<>c();
			public static BindingFailedEventHandler <>9__6_0;
			public static UnhandledExceptionEventHandler <>9__6_1;
			internal void <InitializeComponent>b__6_0(object sender, BindingFailedEventArgs args){
				Debug.WriteLine(args.get_Message());
			}

			internal void <InitializeComponent>b__6_1(object sender, UnhandledExceptionEventArgs e){
				bool isAttached = Debugger.IsAttached;
				if (isAttached) Debugger.Break();
			}
		}

		private TransitionCollection transitions;
		private bool _contentLoaded;
		private XamlTypeInfoProvider _provider;

		public App()
		{
			this.InitializeComponent();
			WindowsRuntimeMarshal.AddEventHandler<SuspendingEventHandler>(
				new Func<SuspendingEventHandler, EventRegistrationToken>(this.add_Suspending),
				new Action<EventRegistrationToken>(this.remove_Suspending),
				new SuspendingEventHandler(this.OnSuspending)
			);
		}

		protected override void OnLaunched(LaunchActivatedEventArgs e){
			if (Debugger.IsAttached){ base.get_DebugSettings().put_EnableFrameRateCounter(true); }
			Frame frame = Window.get_Current().get_Content() as Frame;
			if (frame == null) {
				frame = new Frame();
				frame.put_CacheSize(1);
				frame.put_Language(ApplicationLanguages.get_Languages().get_Item(0));
				if (e.get_PreviousExecutionState() == 3){}
				Window.get_Current().put_Content(frame);
			}
			if (frame.get_Content() == null) {
				if (frame.get_ContentTransitions() != null) {
					this.transitions = new TransitionCollection();
					using (IEnumerator<Transition> enumerator = frame.get_ContentTransitions().GetEnumerator()) {
						while (enumerator.MoveNext()) this.transitions.Add(enumerator.get_Current());
					}
				}
				frame.put_ContentTransitions(null);
				Frame frame2 = frame;
				WindowsRuntimeMarshal.AddEventHandler<NavigatedEventHandler>(
					new Func<NavigatedEventHandler, EventRegistrationToken>(frame2.add_Navigated),
					new Action<EventRegistrationToken>(frame2.remove_Navigated),
					new NavigatedEventHandler(this.RootFrame_FirstNavigated)
				);
				if (!frame.Navigate(typeof(MainPage), e.get_Arguments())) {
					throw new Exception("Failed to create initial page");
				}
			}
			Window.get_Current().Activate();
		}

		private void RootFrame_FirstNavigated(object sender, NavigationEventArgs e)
		{
			Frame frame = sender as Frame;
			ContentControl arg_24_0 = frame;
			TransitionCollection arg_24_1;
			if ((arg_24_1 = this.transitions) == null) {
				(arg_24_1 = new TransitionCollection()).Add(new NavigationThemeTransition());
			}
			arg_24_0.put_ContentTransitions(arg_24_1);
			WindowsRuntimeMarshal.RemoveEventHandler<NavigatedEventHandler>(
				new Action<EventRegistrationToken>(frame.remove_Navigated), 
				new NavigatedEventHandler(this.RootFrame_FirstNavigated)
			);
		}

		private void OnSuspending(object sender, SuspendingEventArgs e)
		{
			SuspendingDeferral deferral = e.get_SuspendingOperation().GetDeferral();
			deferral.Complete();
		}

		[GeneratedCode("Microsoft.Windows.UI.Xaml.Build.Tasks", " 4.0.0.0"), DebuggerNonUserCode]
		public void InitializeComponent()
		{
			bool contentLoaded = this._contentLoaded;
			if (!contentLoaded)
			{
				this._contentLoaded = true;
				DebugSettings debugSettings = base.get_DebugSettings();
				Func<BindingFailedEventHandler, EventRegistrationToken> arg_57_0 = new Func<BindingFailedEventHandler, EventRegistrationToken>(debugSettings.add_BindingFailed);
				Action<EventRegistrationToken> arg_57_1 = new Action<EventRegistrationToken>(debugSettings.remove_BindingFailed);
				BindingFailedEventHandler arg_57_2;
				if ((arg_57_2 = App.<>c.<>9__6_0) == null){
					arg_57_2 = (App.<>c.<>9__6_0 = new BindingFailedEventHandler(App.<>c.<>9.<InitializeComponent>b__6_0));
				}
				WindowsRuntimeMarshal.AddEventHandler<BindingFailedEventHandler>(arg_57_0, arg_57_1, arg_57_2);
				Func<UnhandledExceptionEventHandler, EventRegistrationToken> arg_96_0 = new Func<UnhandledExceptionEventHandler, EventRegistrationToken>(this.add_UnhandledException);
				Action<EventRegistrationToken> arg_96_1 = new Action<EventRegistrationToken>(this.remove_UnhandledException);
				UnhandledExceptionEventHandler arg_96_2;
				if ((arg_96_2 = App.<>c.<>9__6_1) == null){
					arg_96_2 = (App.<>c.<>9__6_1 = new UnhandledExceptionEventHandler(App.<>c.<>9.<InitializeComponent>b__6_1));
				}
				WindowsRuntimeMarshal.AddEventHandler<UnhandledExceptionEventHandler>(arg_96_0, arg_96_1, arg_96_2);
			}
		}

		[GeneratedCode("Microsoft.Windows.UI.Xaml.Build.Tasks", " 4.0.0.0"), DebuggerNonUserCode]
		public void Connect(int connectionId, object target) { this._contentLoaded = true;}

		public IXamlType GetXamlType(Type type){
			if (this._provider == null) this._provider = new XamlTypeInfoProvider();
			return this._provider.GetXamlTypeByType(type);
		}

		public IXamlType GetXamlType(string fullName) {
			if (this._provider == null) this._provider = new XamlTypeInfoProvider();
			return this._provider.GetXamlTypeByName(fullName);
		}

		public XmlnsDefinition[] GetXmlnsDefinitions() { return new XmlnsDefinition[0]; }
	}
}
