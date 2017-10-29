package flare2017_08_flair;

public class RunThis {

	public static void main(String[] args) {
		//for (int i=0x41; i<0x5b; i++){
		for (int i=0x41; i<0x7b; i++){
			String cur = Character.toString((char) i);
			cur += cur;
			System.out.println(cur + ": " + cur.hashCode());
		}
	}

}
