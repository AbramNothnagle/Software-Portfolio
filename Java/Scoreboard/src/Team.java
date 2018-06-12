

public class Team {
	private String teamName;
	private int teamScore;
	
	public Team(String name){
		teamName = name;
	}
	
	public void setTeamName(String name){
		teamName = name;
	}
	
	public String getTeamName(){
		return teamName;
	}
	
	public void setTeamScore(int score){
		teamScore = score;
	}
	
	public int getTeamScore(){
		return teamScore;
	}

}
