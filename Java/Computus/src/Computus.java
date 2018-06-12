
/**
 * 
 * @author Abram Nothnagle
 * @version v1.0
 */
 
 //Calculate the Easter cycle given a start time.
public class Computus {
	public static void main(String[] args){
		//create object from Easter.java
		Easter easter1800 = new Easter(1800);
	
		System.out.println(easter1800.getEasterMonth() + " " + easter1800.getEasterDay());
		
		Easter.calculateEasterCycle(1800);
		System.out.println("done");
	}
}
