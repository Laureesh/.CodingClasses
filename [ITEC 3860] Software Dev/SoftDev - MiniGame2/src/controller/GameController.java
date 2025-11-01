package controller;

import model.*;
import view.*;
import java.util.*;

/**
 * Class: GameController
 * Package: controller
 * Author: Laureesh Volmar
 * Version: 2.0
 * Course: ITEC 3860 – Fall 2025
 * Written: October 16, 2025
 *
 * Description:
 * Handles user input and sends commands to the model.
 */
public class GameController {
    // Reads player input
    private static final Scanner input = new Scanner(System.in);
    // Holds main game data (rooms, puzzles, items)
    private static Game game;
    private static Player player;

    public static void main(String[] args) {
        // Start the game and load all files
        try {
            game = new Game();
            player = new Player();
        }
        // Stop if loading fails
        catch (Exception e) {
            System.out.println(ConsoleColors.RED + "Error loading game data." + ConsoleColors.RESET);
            return;
        }

        // Welcome messages and basic instructions
        System.out.println(ConsoleColors.PURPLE + "Welcome to the Hidden Leaf Adventure, shinobi!" + ConsoleColors.RESET);
        System.out.println("Step into the world of Naruto, where the Will of Fire guides your path.");
        System.out.println(ConsoleColors.YELLOW + "Use N, E, S, W to move North, East, South, or West." + ConsoleColors.RESET);
        System.out.println("Type 'Help' to view commands.\n");

        // Show the first room at game start
        Room.getCurrentRoom().showCurrentRoom();

        // Main game loop (runs until player exits)
        while (true) {
            // Prompts the user to type something
            System.out.print(ConsoleColors.GREEN + "> " + ConsoleColors.RESET);
            // Reads and removes any extra spaces then turns it into lowercases
            String cmd = input.nextLine().trim().toLowerCase();

            // Split command into action + optional argument
            String[] parts = cmd.split(" ", 2);
            String action = parts[0];
            String item = (parts.length > 1) ? parts[1].trim() : "";

            // Handles all commands
            switch (action) {
                // N, E, S, W: Moves player in corresponding direction
                case "n", "north" -> player.movePlayer("N");
                case "e", "east" -> player.movePlayer("E");
                case "s", "south" -> player.movePlayer("S");
                case "w", "west" -> player.movePlayer("W");

                // // EXPLORE: Lists any items currently in the room.
                case "explore" -> player.explore();

                // PICKUP: Adds an item to the player's inventory. (ex: "pickup kunai").
                case "pickup" -> {
                    // if user only types "pickup" then this will print
                    if (item.isEmpty()) {
                        System.out.println(ConsoleColors.YELLOW + "Usage: pickup <item-name>" + ConsoleColors.RESET);
                    }
                    // else the player pickups the item
                    else {
                        player.pickup(item);
                    }
                }

                // INSPECT: Shows an item's description if it’s in the player’s inventory.
                case "inspect" -> {
                    // if user only types "inspect" then this will print
                    if (item.isEmpty()) {
                        System.out.println(ConsoleColors.YELLOW + "Usage: inspect <item-name>" + ConsoleColors.RESET);
                    }
                    // else the player inspects the item
                    else {
                        player.inspect(item);
                    }
                }

                // DROP: Removes an item from the player's inventory and places it back into the current room.
                case "drop" -> {
                    // if user only types "drop" then this will print
                    if (item.isEmpty()) {
                        System.out.println(ConsoleColors.YELLOW + "Usage: drop <item-name>" + ConsoleColors.RESET);
                    }
                    // else the player drops the item
                    else {
                        player.drop(item);
                    }
                }

                // USE: Allows the player to use item (like Healing Herb).
                case "use" -> {
                    // if user only types "use" then this will print
                    if (item.isEmpty()) {
                        System.out.println(ConsoleColors.YELLOW + "Usage: use <item-name>" + ConsoleColors.RESET);
                    }
                    // else the player uses the item
                    else {
                        player.use(item);
                    }
                }

                // LOOK: Displays all exits available from the current room.
                case "look" -> Room.getCurrentRoom().look();

                // INVENTORY: Shows a list of items the player currently carries.
                case "inventory" -> player.showInventory();

                // PLAYERSTATS: Displays the player's current/max health
                case "playerstats", "stats" -> player.showPlayerStats();

                // MAP: Displays a list of visited rooms and progress.
                case "map" -> Room.getCurrentRoom().showMap();

                // HELP: Lists all available commands.
                case "help" -> player.printHelp();

                // EXIT/X/QUIT: Ends the game loop.
                case "exit", "quit", "x" -> {
                    System.out.println(ConsoleColors.YELLOW + "Thanks for playing!" + ConsoleColors.RESET);
                    return;
                }

                // Handles unknown commands by showing an error.
                default -> System.out.println(ConsoleColors.RED + "Unknown command. Type 'Help' for help." + ConsoleColors.RESET);
            }
        }
    }
}
