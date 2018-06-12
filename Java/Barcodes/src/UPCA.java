
public class UPCA {
	private String productCode;
	private int checkDigit;
	private String barcode;

	/**
	 * @consructor UPCA - no default
	 * @param productCode
	 * @author Abram Nothnagle
	 * I don't want the user to have a default because every barcode object must have a code to make sense.
	 */
	public UPCA(String productCode){
		try{
			validate(productCode);
			this.productCode = productCode;
			calculateCheckDigit();
		}
		catch(Exception e){
			System.out.println(e);
		}
	}
	
	//validate
	//validates the input string to make sure that it uses proper digits
	private void validate(String productCode) throws Exception{
		if(productCode.length() != 11){
			throw new Exception("The product code must be 11 digits long.");
		}
		for(int i = 0; i<productCode.length(); i++){
			if(!Character.isDigit(productCode.charAt(i))){
				throw new Exception(productCode.charAt(i) + " is not a digit.");
			}
		}
	}
	
	/**
	 * calculateCheckDigit
	 * calculates the checkdigit used in the barcode
	 */
	private void calculateCheckDigit(){
		int oddSum = 0;
		
		for(int i = 0; i<productCode.length(); i = i + 2){
			oddSum = oddSum + Character.getNumericValue(productCode.charAt(i));
		}
		
		int oddSumTimesThree = 3*oddSum;
		
		int addEvenResults = oddSumTimesThree;
		
		for(int i = 1; i<productCode.length(); i = i + 2){
			addEvenResults = addEvenResults + Character.getNumericValue(productCode.charAt(i));
		}
		
		int resultMod10 = addEvenResults%10;
		
		if(resultMod10 != 10){
			checkDigit = 10 - resultMod10;
		}
		else{
			checkDigit = 0;
		}
		productCode = productCode + checkDigit;
	}
	
	//calculateUPCABarcode
	//uses the UPCA format to calculate the binary barcode
	public void calculateUPCABarcode(){
		barcode = "";
		for(int i = 0; i<6; i++){
			switch(productCode.charAt(i)){
			case '0': barcode = barcode + "0001101";
			break;
			case '1': barcode = barcode + "0011001";
			break;
			case '2': barcode = barcode + "0010011";
			break;
			case '3': barcode = barcode + "0111101";
			break;
			case '4': barcode = barcode + "0100011";
			break;
			case '5': barcode = barcode + "0110001";
			break;
			case '6': barcode = barcode + "0101111";
			break;
			case '7': barcode = barcode + "0111011";
			break;
			case '8': barcode = barcode + "0110111";
			break;
			case '9': barcode = barcode + "0001011";
			break;
			}
		}
		
		barcode = barcode + "01010";
		
		for(int i = 6; i < 12; i++){
			switch(productCode.charAt(i)){
			case '0': barcode = barcode + "1110010";
			break;
			case '1': barcode = barcode + "1100110";
			break;
			case '2': barcode = barcode + "1101100";
			break;
			case '3': barcode = barcode + "1000010";
			break;
			case '4': barcode = barcode + "1011100";
			break;
			case '5': barcode = barcode + "1001110";
			break;
			case '6': barcode = barcode + "1010000";
			break;
			case '7': barcode = barcode + "1000100";
			break;
			case '8': barcode = barcode + "1001000";
			break;
			case '9': barcode = barcode + "1110100";
			break;
			}
		}
		
		barcode = "101" + barcode + "101";
		
		System.out.println(barcode);
	}
}
