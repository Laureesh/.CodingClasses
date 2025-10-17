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
 * Controls the main game flow — loads rooms, processes player input,
 * and manages all core gameplay logic.
 */

public class GameController {
    private static final Scanner input = new Scanner(System.in);
    private static Game game;

    public static void main(String[] args) {
        try {
            // Attempts to create a new game instance
            game = new Game();
        }
        catch (Exception e) {
            // If something goes wrong (e.g., missing files or bad data), show an error and stop
            System.out.println(ConsoleColors.RED + "Error loading game data." + ConsoleColors.RESET);
            return;
        }

        System.out.println(ConsoleColors.PURPLE + "Welcome to the Hidden Leaf Adventure, shinobi!" + ConsoleColors.RESET);
        System.out.println("Step into the world of Naruto, where the Will of Fire guides your path.");
        System.out.println(ConsoleColors.YELLOW + "Use N, E, S, W to move North, East, South, or West." + ConsoleColors.RESET);
        System.out.println("Type 'Help' to view commands.\n");

        // Show first room
        showCurrentRoom();

        // Repeatedly gets player input, processes it, and executes logic.
        while (true) {
            // Displays ">" for the user to input commands
            System.out.print(ConsoleColors.GREEN + "> " + ConsoleColors.RESET);

            // Gets player input, trims spaces, and makes it lowercase.
            String cmd = input.nextLine().trim().toLowerCase();

            // Split command into 2 parts
            // Split once at first space
            String[] parts = cmd.split(" ", 2);
            // First part = command
            String action = parts[0];
            // Second part = argument (if any)
            // Checks if there’s a second part;
            // if yes, returns it trimmed, otherwise returns an empty string.
            String argument = (parts.length > 1) ? parts[1].trim() : "";

            // Runs game logic based on entered command.
            switch (action) {
                // === Direction Commands ===
                case "n", "north" -> movePlayer("N");
                case "e", "east" -> movePlayer("E");
                case "s", "south" -> movePlayer("S");
                case "w", "west" -> movePlayer("W");

                // === Interaction Commands ===
                // EXPLORE: Lists any items currently in the room.
                case "explore" -> {
                    System.out.println(game.explore());
                    showCurrentRoom();
                }
                // PICKUP: Adds an item to the player's inventory.
                // Requires a valid item name (e.g., "pickup kunai").
                case "pickup" -> {
                    if (argument.isEmpty()) {
                        System.out.println(ConsoleColors.YELLOW + "Usage: pickup <item-name>" + ConsoleColors.RESET);
                        break;
                    }
                    System.out.println(game.pickup(argument));
                }
                // INSPECT: Shows an item's description if it’s in the player’s inventory.
                case "inspect" -> {
                    if (argument.isEmpty()) {
                        System.out.println(ConsoleColors.YELLOW + "Usage: inspect <item-name>" + ConsoleColors.RESET);
                        break;
                    }
                    System.out.println(game.inspect(argument));
                }
                // DROP: Removes an item from the player's inventory
                // and places it back into the current room.
                case "drop" -> {
                    if (argument.isEmpty()) {
                        System.out.println(ConsoleColors.YELLOW + "Usage: drop <item-name>" + ConsoleColors.RESET);
                        break;
                    }
                    System.out.println(game.drop(argument));
                }
                // USE: Allows the player to use a item (like Healing Herb).
                case "use" -> {
                    if (argument.isEmpty()) {
                        System.out.println(ConsoleColors.YELLOW + "Usage: use <item-name>" + ConsoleColors.RESET);
                        break;
                    }
                    System.out.println(game.useItem(argument));
                    game.showPlayerStats();
                }

                // === Utility Commands ===
                // HELP: Lists all available commands.
                case "help" -> {
                    printHelp();
                    showCurrentRoom();
                }
                // PLAYERSTATS: Displays the player's current health
                case "playerstats", "stats" -> {
                    game.showPlayerStats();
                    showCurrentRoom();
                }
                // LOOK: Displays all exits available from the current room.
                case "look" -> {
                    showExits();
                    showCurrentRoom();
                }
                // INVENTORY: Shows a list of items the player currently carries.
                case "inventory" -> {
                    game.getPlayer().showInventory();
                    showCurrentRoom();
                }
                // MAP: Displays a list of visited rooms and progress.
                case "map" -> {
                    showMap();
                    showCurrentRoom();
                }
                // EXIT/X/QUIT: Gracefully ends the game loop and thanks the player.
                case "exit", "x", "quit" -> {
                    System.out.println(ConsoleColors.YELLOW + "Thanks for playing!" + ConsoleColors.RESET);
                    return;
                }

                // === Invalid Command ===
                // Handles unknown commands by showing an error and room info again.
                default -> {
                    System.out.println(ConsoleColors.RED + "Unknown command. Type 'Help' for help." + ConsoleColors.RESET);
                    showCurrentRoom();
                }
            }
        }

    }

    private static void movePlayer(String direction) {
        String result = game.move(direction);

        // Print movement message
        System.out.println(result.replace(" [PUZZLE_TRIGGERED]", ""));
        System.out.println();

        // If puzzle was triggered, show the room after it’s done
        if (result.contains("[PUZZLE_TRIGGERED]")) {
            showCurrentRoom();
            return;
        }

        // If no puzzle, show room immediately as before
        showCurrentRoom();
    }


    private static void showCurrentRoom() {
        System.out.println(ConsoleColors.PURPLE + game.getCurrentRoom().getName() + ConsoleColors.RESET);

        // Splits room description into sentences
        String[] sentences = game.getCurrentRoom().getDescription().split("\\.\\s*");

        // Loops through each sentence
        for (String sentence : sentences) {
            // Skips empty lines
            if (sentence.trim().isEmpty()) continue;

            // Highlights directions sentences from the description in green
            if (sentence.toLowerCase().contains("north") ||
                    sentence.toLowerCase().contains("south") ||
                    sentence.toLowerCase().contains("east") ||
                    sentence.toLowerCase().contains("west")) {
                System.out.println(ConsoleColors.GREEN + sentence.trim() + "." + ConsoleColors.RESET);
            }
            // Prints other sentences normally in default console color
            else {
                System.out.println(sentence.trim() + ".");
            }
        }

        // Prompts player for next action
        System.out.println(ConsoleColors.CYAN + "What would you like to do?" + ConsoleColors.RESET);
    }

    private static void showExits() {
        // Gets the current room
        Room current = game.getCurrentRoom();

        // Starts exit list in cyan
        StringBuilder exits = new StringBuilder(ConsoleColors.CYAN + "Available exits: [");

        // If the id in that direction from rooms.txt is greater than 0
        // then corresponding Direction command is printed
        if (current.getExit("NORTH") > 0) exits.append("N, ");
        if (current.getExit("EAST") > 0) exits.append("E, ");
        if (current.getExit("SOUTH") > 0) exits.append("S, ");
        if (current.getExit("WEST") > 0) exits.append("W, ");

        // Remove trailing comma and space if needed
        if (exits.lastIndexOf(", ") == exits.length() - 2) {
            exits.delete(exits.length() - 2, exits.length());
        }

        // Closes bracket and resets color
        exits.append("]" + ConsoleColors.RESET);

        // Prints available exits | Example = "Available exits: [W]"
        System.out.println(exits);
    }

    private static void showMap() {
        // Gets all rooms in the game
        List<Room> allRooms = game.getRooms();

        // Counts how many rooms were visited
        // allRooms.stream() = Converts the list into a stream — a sequence of elements that can be processed one by one.
        // filter(Room::isVisited) = This filters the stream to include only rooms where the method isVisited() returns true.
        // count() = returns the number of visited rooms.
        long visitedCount = allRooms.stream().filter(Room::isVisited).count();

        // Displays visited room count in cyan
        System.out.println(ConsoleColors.CYAN + "Visited " + visitedCount + " of " + allRooms.size() + " rooms" + ConsoleColors.RESET);

        // Lists each room with its ID, name, and visit status
        for (Room r : allRooms) {
            String status = r.isVisited() ? "(visited)" : "";
            System.out.println(r.getId() + " | " + r.getName() + " " + status);
        }
    }

    private static void printHelp() {
        System.out.println(ConsoleColors.YELLOW + """
                Available Commands:
                N, E, S, W - Move in a direction
                EXPLORE - View items in current room
                PICKUP [item] - Add item to inventory
                DROP [item] - Drop item in room
                INSPECT [item] - View item description
                USE [item] - Use a item from your inventory
                INVENTORY - View your items
                LOOK - Show room exits
                PLAYERSTATS - View your current health and item summary
                MAP - Show visited rooms
                HELP - Show this list
                EXIT - Quit the game
                """ + ConsoleColors.RESET);
    }
}
