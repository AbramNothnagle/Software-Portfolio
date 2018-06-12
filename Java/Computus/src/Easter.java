import java.util.Calendar;
import java.util.GregorianCalendar;

/**
 * 
 * @author Abram
 * 
 *
 */
public class Easter {
	private int year;
	private int month;
	private int day;
	private Calendar thisEaster;
	//private int[] easterCycleDates = new int[35]; //might just make a new array every time the function is called
	
	/**
	 * Constructor that takes in the year
	 * this sets the object's internal parameter 'year'
	 * no default constructor because I want the user to always input a year
	 * @param year
	 */
	public Easter(int year){
		this.year = year;
		getEaster();
	}
	
	/**
	 * Default constructor
	 * for use when only the Easter cycle is wanted
	 * I might not use this
	 */
	//public Easter(){
		
	//}
	
	/**
	 * Function taken from Wikipedia article "Computus"
	 * Meeus/Jones/Butcher Gregorian algorithm
	 * Note: 13 days are added to the table presented in the Wikipedia article
	 * This is because of the conversion to Easter Orthodox Easter
	 * @return Date of Easter
	 */
	
	private void getEaster() {
		int a = year % 19;
		int b = year / 100;
		int c = year % 100;
		int d = b / 4;
		int e = b % 4;
		int f = (b + 8) / 25;
		int g = (b - f + 1) / 3;
		int h = (19 * a + b - d - g + 15) % 30;
		int i = c / 4;
		int k = c % 4;
		int l = (32 + 2 * e + 2 * i - h - k) % 7;
		int m = (a + 11 * h + 22 * l) / 451;
		int n = (h + l - 7 * m + 114) / 31;
		int p = (h + l - 7 * m + 114) % 31;
		Calendar calendar = GregorianCalendar.getInstance();
		calendar.clear();
		calendar.set(year, n - 1, p + 1);
		thisEaster = calendar;
		setMonth();
		setDay();
		//return thisEaster;
	}
	
	private void setMonth(){
		this.month = thisEaster.get(thisEaster.MONTH);
	}
	
	private void setDay(){
		this.day = thisEaster.get(thisEaster.DAY_OF_MONTH);
	}
	
	public String getEasterMonth(){
		String returnMonth = null;
		switch (this.month){
		case 0: returnMonth = "January";
		break;
		case 1: returnMonth = "February";
		break;
		case 2: returnMonth = "March";
		break;
		case 3: returnMonth = "April";
		break;
		case 4: returnMonth = "May";
		break;
		case 5: returnMonth = "June";
		break;
		case 6: returnMonth = "July";
		break;
		case 7: returnMonth = "August";
		break;
		case 8: returnMonth = "September";
		break;
		case 9: returnMonth = "October";
		break;
		case 10: returnMonth = "November";
		break;
		case 11: returnMonth = "December";
		break;
		default: returnMonth = "ERROR";
		break;
		}
		
		return returnMonth;
	}
	
	public int getEasterMonthInt(){
		return month;
	}
	
	public int getEasterDay(){
		return day;
	}
	
	/**
	 * @name calculateEasterCycle
	 * @function calculates all the times Easter appears on a certain date and prints the numbers off
	 * This function will just run through an entire cycle and keep count in an array 
	 */
	public static void calculateEasterCycle(int startingYear){
		Easter holderEaster = new Easter(startingYear);
		int index = 0;
		int[] easterCycleDates = new int[36];
		int month;
		int day;
		
		for(int i = 0; i <5700000; i++){
			month = holderEaster.getEasterMonthInt();
			day = holderEaster.getEasterDay();
			index = (month-2)*9 + day - (3-month)*(22);

			easterCycleDates[index] = easterCycleDates[index] + 1;
			
			holderEaster = new Easter(startingYear + i + 1);
		}
		
		for(int j = 0; j < 10; j++){
			System.out.println("March "+ (22+j) + ": " + easterCycleDates[j]);
		}
		
		for(int k = 10; k < 35; k++){
			System.out.println("April " + (k-9) + ": " + easterCycleDates[k]);
		}
	}
}
