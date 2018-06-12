/**
 * @class POSTNET
 * @author Abram Nothnagle
 * This class is used for the POSTNET barcode system.
 * Objects from this class are instantiated with a ZIP code.
 * There is no default constructor because a ZIP code is necessary.
 */
 
public class POSTNET {
	private String ZIP;
	private int checksum;
	private String binaryPOSTNET;
	
	//String is used for the ZIP so that an XXXXX-XXXX format ZIP can be entered
	//String also allows for parsing as though it were a char array
	public POSTNET(String inputZIP){
		try{
			validate(inputZIP);
			inputZIP.replace("-", "");
			ZIP = inputZIP;
			calculateBinaryPOSTNET();
		}
		catch(Exception e){
			System.out.println(e);
		}
	}
	
	//Validate function: 
	//checks the input to verify that it uses only valid characters
	private void validate(String input) throws Exception{
		for(int i = 0; i < input.length(); i++){
			char currentDigit = input.charAt(i);
			if(!Character.isDigit(currentDigit) && currentDigit != '-'){
				throw new Exception(input.charAt(i)+" is not a valid character for your input");
			}
		}
	}
	
	//calculateChecksumDigit
	//calculates the checksum digit from the set global variables
	private void calculateChecksumDigit(){
		int sum = 0;
		
		for(int i = 0; i < ZIP.length(); i++){
			sum = sum + Character.getNumericValue(ZIP.charAt(i));
		}
		if(sum != 10){
			checksum = 10 - sum%10;
		}
		else{
			checksum = 0;
		}
	}
	
	//calculateBinaryPOSTNET
	//Uses POSTNET format to calculate the binary value
	//utilizes a case structure to do this calculation
	private void calculateBinaryPOSTNET(){
		binaryPOSTNET = "";
		calculateChecksumDigit();
		ZIP = ZIP + checksum;
		
		for(int i = 0; i < ZIP.length(); i++){
			switch(ZIP.charAt(i)){
				case '1': binaryPOSTNET = binaryPOSTNET + "00011";
				break;
				case '2': binaryPOSTNET = binaryPOSTNET + "00101";
				break;
				case '3': binaryPOSTNET = binaryPOSTNET + "00110";
				break;
				case '4': binaryPOSTNET = binaryPOSTNET + "01001";
				break;
				case '5': binaryPOSTNET = binaryPOSTNET + "01010";
				break;
				case '6': binaryPOSTNET = binaryPOSTNET + "01100";
				break;
				case '7': binaryPOSTNET = binaryPOSTNET + "10001";
				break;
				case '8': binaryPOSTNET = binaryPOSTNET + "10010";
				break;
				case '9': binaryPOSTNET = binaryPOSTNET + "10100";
				break;
				case '0': binaryPOSTNET = binaryPOSTNET + "11000";
				break;
				default: System.out.println("ZIP cannot be resolved");
				break;
			}
		}
		binaryPOSTNET = "1" + binaryPOSTNET + "1";
	}
	
	
	//printBinaryPOSTNET
	//prints the POSTNET to the screen as binary
	public void printBinaryPOSTNET(){
		System.out.println(binaryPOSTNET);
	}
	
	//printBarPOSTNET
	//formats the binary POSTNET as a series of bars and prints to the screen
	public void printBarPOSTNET(){
		for(int i = 0; i < binaryPOSTNET.length(); i++){
			if(binaryPOSTNET.charAt(i) == '1'){
				System.out.print("|");
			}
			else{
				System.out.print(".");
			}
		}
		System.out.println();
	}

}
