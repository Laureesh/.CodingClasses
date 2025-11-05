package model;

import view.ConsoleColors;
import java.util.Scanner;

/**
 * Class: Puzzle
 * Package: model
 * Author: Laureesh Volmar
 * Version: 2.0
 * Course: ITEC 3860 – Fall 2025
 * Written: October 16, 2025
 *
 * Description:
 * Handles all logic for in-game puzzles.
 * Each puzzle has a question, an answer, and messages for success or failure.
 */
public class Puzzle {
    private String id, question, answer, passMsg, failMsg;
    private int attempts, maxAttempts;
    private boolean completed;

    public Puzzle(String id, String question, String answer, String passMsg, String failMsg, int attempts, boolean completed) {
        this.id = id;
        this.question = question;
        this.answer = answer;
        this.passMsg = passMsg;
        this.failMsg = failMsg;
        this.attempts = attempts;
        this.maxAttempts = attempts;
        this.completed = completed;
    }

    // Getters/Setters
    public boolean isCompleted() { return completed; }
    public String getId() { return id; }
    public void setId(String id) { this.id = id; }

    // Resets puzzle progress (used if player fails or leaves room)
    public void reset() {
        // marks puzzle as not solved
        completed = false;
        // restore attempts to full number
        attempts = maxAttempts;
    }

    // Main method that runs when a player triggers the puzzle
    public void triggerPuzzle() {
        Scanner scanner = new Scanner(System.in);
        System.out.println(ConsoleColors.YELLOW + "Puzzle: " + question + ConsoleColors.RESET);

        // While the player still has attempts and hasn’t solved it yet
        while (attempts > 0 && !completed) {
            System.out.print(ConsoleColors.GREEN + "> " + ConsoleColors.RESET);
            String input = scanner.nextLine().trim();

            // If the answer is correct
            if (input.equalsIgnoreCase(answer)) {
                completed = true;
                System.out.println(ConsoleColors.CYAN + passMsg + ConsoleColors.RESET);
                break;
            }
            // If the answer is wrong
            else {
                // reduce attempts left
                attempts--;
                if (attempts > 0) {
                    System.out.println(ConsoleColors.RED + failMsg + " You still have " + attempts + " attempts. Try again." + ConsoleColors.RESET);
                }
                // Out of attempts
                else {
                    System.out.println(ConsoleColors.RED + "You failed to solve the puzzle. It will reset next visit." + ConsoleColors.RESET);
                }
            }
        }

        // If player failed completely, reset puzzle so they can try again later
        if (!completed) {
            reset();
        }
        
        scanner.close();
    }
}
