/**
 * @class Barcodes - test class
 * @author Abram Nothnagle
 * This class is the class that will run the project. It acts as the test class.
 */
public class Barcodes {

	public static void main(String[] args) {
		//print out the barcode
		System.out.println(Character.getNumericValue("123".charAt(1)));
		System.out.println(Character.isDigit("123".charAt(0)));
		//set a test barcode and run functions on it for testing
		POSTNET barcode = new POSTNET("52242");
		barcode.printBarPOSTNET();
		barcode.printBinaryPOSTNET();
		
		UPCA barcode2 = new UPCA("01254667375");
		
		barcode2.calculateUPCABarcode();
	}

}
