package model;

/**
 * Class: Puzzle
 * Package: model
 * Author: Laureesh Volmar
 * Version: 2.0
 * Course: ITEC 3860 – Fall 2025
 * Written: October 16, 2025
 *
 * Description:
 * Represents an interactive puzzle within the game.
 * Stores the question, correct answer, success and failure messages,
 * attempt limits, and completion state.
 */

public class Puzzle {
    private String id;
    private String question;
    private String answer;
    private String passMsg;
    private String failMsg;
    private int attempts;
    private int maxAttempts;
    private boolean completed;

    public Puzzle(String id, String question, String answer, String passMsg, String failMsg, int attempts) {
        this.id = id;
        this.question = question;
        this.answer = answer;
        this.passMsg = passMsg;
        this.failMsg = failMsg;
        this.attempts = attempts;

        // store original value
        this.maxAttempts = attempts;

        this.completed = false;
    }

    public String getQuestion() { return question; }
    public String getAnswer() { return answer; }
    public String getPassMsg() { return passMsg; }
    public String getFailMsg() { return failMsg; }
    public int getAttempts() { return attempts; }
    public void decrementAttempts() { attempts--; }
    public boolean isCompleted() { return completed; }
    public void setCompleted(boolean completed) { this.completed = completed; }

    public void reset() {
        completed = false;
        attempts = maxAttempts;
    }
}
