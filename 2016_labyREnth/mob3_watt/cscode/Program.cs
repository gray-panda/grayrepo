using System;
using System.CodeDom.Compiler;
using System.Diagnostics;
using System.Runtime.CompilerServices;
using Windows.UI.Xaml;

namespace watt
{
	public static class Program
	{
		[CompilerGenerated]
		[Serializable]
		private sealed class <>c
		{
			public static readonly Program.<>c <>9 = new Program.<>c();
			public static ApplicationInitializationCallback <>9__0_0;
			internal void <Main>b__0_0(ApplicationInitializationCallbackParams p){
				new App();
			}
		}

		[GeneratedCode("Microsoft.Windows.UI.Xaml.Build.Tasks", " 4.0.0.0"), DebuggerNonUserCode]
		private static void Main(string[] args)
		{
			ApplicationInitializationCallback arg_20_0;
			if ((arg_20_0 = Program.<>c.<>9__0_0) == null){
				arg_20_0 = (Program.<>c.<>9__0_0 = new ApplicationInitializationCallback(Program.<>c.<>9.<Main>b__0_0));
			}
			Application.Start(arg_20_0);
		}
	}
}
