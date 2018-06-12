/*
* @author Abram
*/

//Scoreboard for the game football
public class Football extends Game {
	
	//Football has two teams, set it up with two teams.
	public Football(Team team1, Team team2){
		//from team.java
		super(team1, team2);
	}
	
	//Create a scoring method for football
	//Types of scoring: touchdown, field goal, extra point kick, extra point carry, safety
	public ScoringMethod getScoringMethod(int method){
		switch (method){
		case 0: ScoringMethod touchdown = new ScoringMethod(6);
		return touchdown;
		case 1: ScoringMethod fieldGoal = new ScoringMethod(3);
		return fieldGoal;
		case 2: ScoringMethod extraPointKick = new ScoringMethod(1);
		return extraPointKick;
		case 3: ScoringMethod extraPointCarry = new ScoringMethod(2);
		return extraPointCarry;
		case 4: ScoringMethod safety = new ScoringMethod(2);
		return safety;
		default: break;
		}
		
		return null;
	}
}
