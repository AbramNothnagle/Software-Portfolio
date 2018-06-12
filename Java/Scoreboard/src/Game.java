/*
*	Game
*	@author Abram
*/

public class Game {
	//create two teams for a generic game
	private Team firstTeam;
	private Team secondTeam;
	
	//instantiate nothing of no parameters set
	public Game(){
		
	}
	
	//set the two teams if teams are provided
	public Game(Team team1, Team team2){
		firstTeam = team1;
		secondTeam = team2;
	}
	
	//Allow for the teams to be changed
	public void setTeams(Team team1, Team team2){
		firstTeam = team1;
		secondTeam = team2;
	}
	
	//Allow for team 1 to be changed
	public void setTeam1(Team team1){
		firstTeam = team1;
	}
	
	//Allow for team 2 to be changed
	public void setTeam2(Team team2){
		secondTeam = team2;
	}
	
	//Get team 1
	public Team getTeam1(){
		return firstTeam;
	}
	
	//Get team 2
	public Team getTeam2(){
		return secondTeam;
	}
	
	//Get both teams
	public String getTeams(){
		String teams = firstTeam + ", " + secondTeam;
		return teams;
	}
	
	//Set the scores for both teams
	public void setScores(int scoreForTeam1, int scoreForTeam2){
		firstTeam.setTeamScore(scoreForTeam1);
		secondTeam.setTeamScore(scoreForTeam2);
	}
	
	//Set the score for team 1
	public void setTeam1Score(int scoreForTeam1){
		firstTeam.setTeamScore(scoreForTeam1);
	}
	
	//Set the score for team 2
	public void setTeam2Score(int scoreForTeam2){
		secondTeam.setTeamScore(scoreForTeam2);
	}
	
	//Not used
	public void getScoringMethods(){
		
	}
	/*public enum scoringType{
		TOUCHDOWN(6),
		FIELDGOAL(3);
		
		private final int score;
		
		scoringType(int points){
			this.score = points;
		}
		
	}*/
}
