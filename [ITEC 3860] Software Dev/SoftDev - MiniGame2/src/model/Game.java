package model;

import view.ConsoleColors;
import java.io.*;
import java.util.*;

/**
 * Class: Game
 * Package: model
 * Author: Laureesh Volmar
 * Version: 2.0
 * Course: ITEC 3860 – Fall 2025
 * Written: October 16, 2025
 *
 * Description:
 * Core class responsible for managing the game state and logic.
 * Handles loading rooms, items, and puzzles from data files, tracking the player,
 * managing room navigation, inventory interactions, and puzzle mechanics.
 */

public class Game {
    private List<Room> rooms;
    private Room currentRoom;
    private final Player player;
    private final Map<String, Puzzle> allPuzzles = new HashMap<>();

    /** Constructor — Loads data files, creates player, and sets starting room */
    public Game() throws IOException {
        // Load room, item, and puzzle data
        loadRooms("data/rooms.txt");
        loadItems("data/items.txt");
        loadPuzzles("data/puzzles.txt");

        // Set first room as start
        currentRoom = rooms.get(0);

        // Create new player
        player = new Player();

        // Mark starting room as visited
        currentRoom.setVisited(true);
    }

    // Moves player to a new room if exit is valid
    public String move(String direction) {
        // Get target room ID
        int nextId = currentRoom.getExit(direction);

        if (nextId <= 0 || nextId > rooms.size()) {
            return ConsoleColors.CYAN + "You can't go that way." + ConsoleColors.RESET;
        }

        // Get next room
        Room nextRoom = rooms.get(nextId - 1);
        String message;

        // Check if room was visited before
        if (nextRoom.isVisited()) {
            message = ConsoleColors.PURPLE + nextRoom.getName() + " - You have visited this room before." + ConsoleColors.RESET;
        }
        else {
            message = ConsoleColors.CYAN + "You moved to " + nextRoom.getName() + "." + ConsoleColors.RESET;
            // Mark as visited
            nextRoom.setVisited(true);
        }

        // Update current room
        currentRoom = nextRoom;

        // Trigger puzzle if room has one
        // It takes the regular movement message (Example: "You moved to Training Grounds.")
        // Then adds the tag " [PUZZLE_TRIGGERED]" to the end.
        Puzzle puzzle = currentRoom.getPuzzle();
        if (puzzle != null && !puzzle.isCompleted()) {
            puzzle.reset();
            // Add spacing
            System.out.println();
            triggerPuzzle(puzzle);
            // Example: "You moved to Training Grounds. [PUZZLE_TRIGGERED]"
            // This tag isn’t meant for the player to read
            //      — it’s used internally by my GameController
            //      to detect that a puzzle was activated after moving.
            // So that tag tells the controller:
            //      “A puzzle was triggered
            //      — don’t show the next room yet
            //      until after the puzzle finishes.”
            return message + " [PUZZLE_TRIGGERED]";
        }

        // Return movement message
        return message;
    }

    // Lets the player explore the room for item
    public String explore() {
        // Get items in current room
        List<Item> items = currentRoom.getItems();

        if (items.isEmpty()) {
            return ConsoleColors.YELLOW + "You search the room but find nothing of interest." + ConsoleColors.RESET;
        }

        String result = "You explore the room and find:\n";

        // Start item list
        String itemsList = "[";
        for (int i = 0; i < items.size(); i++) {
            Item item = items.get(i);

            // Set color based on item type
            String color;
            switch (item.getType().toLowerCase()) {
                case "weapon" -> color = ConsoleColors.RED;
                case "heal" -> color = ConsoleColors.GREEN;
                case "key" -> color = ConsoleColors.YELLOW;
                default -> color = ConsoleColors.WHITE;
            }

            // Add item to list with formatting
            // Example: ["Soldier Pill" (Heal), "Medical Ninja Bandage" (Heal)]
            itemsList += color + "\"" + item.getName() + "\" (" + item.getType() + ")" + ConsoleColors.RESET;
            if (i < items.size() - 1) itemsList += ", ";
        }
        // Close list
        itemsList += "]";

        // Final formatted output:
        // result = You explore the room and find:
        // itemsList = ["Soldier Pill" (Heal), "Medical Ninja Bandage" (Heal)]
        return result + itemsList;
    }

    // PICKUP item-name
    public String pickup(String itemName) {
        // Look for the item in the current room
        for (Item item : currentRoom.getItems()) {

            // If found, move it to player inventory
            if (item.getName().equalsIgnoreCase(itemName)) {
                player.addItem(item);
                currentRoom.removeItem(item);
                return ConsoleColors.GREEN +
                        item.getName() + " has been picked up from the room and successfully added to your inventory." +
                        ConsoleColors.RESET;
            }
        }

        // If not found, show warning
        return ConsoleColors.YELLOW + "That item isn't here." + ConsoleColors.RESET;
    }

    // INSPECT item-name
    public String inspect(String itemName) {

        // Get player's inventory
        List<Item> inventory = player.getInventory();

        // Search for the item by name
        for (Item item : inventory) {
            if (item.getName().equalsIgnoreCase(itemName)) {

                // Show item details if found
                return ConsoleColors.CYAN +
                        "Inspecting " + item.getName() + ":\n" +
                        item.getDescription() +
                        ConsoleColors.RESET;
            }
        }

        // If not found, show message
        return ConsoleColors.YELLOW +
                "You don’t have that item in your inventory." +
                ConsoleColors.RESET;
    }

    // DROP item-name
    public String drop(String itemName) {

        // Get player's items
        List<Item> inventory = player.getInventory();

        // Look for the item in inventory
        for (Item item : inventory) {
            if (item.getName().equalsIgnoreCase(itemName)) {

                // Remove from player
                player.removeItem(item);

                // Add to current room
                currentRoom.addItem(item);

                return ConsoleColors.GREEN + item.getName() +
                        " has been dropped successfully from your inventory and placed in " +
                        currentRoom.getName() + "." + ConsoleColors.RESET;
            }
        }

        // If item not found
        return ConsoleColors.YELLOW +
                "You don’t have that item to drop." +
                ConsoleColors.RESET;
    }

    // USE item-name
    public String useItem(String itemName) {

        // Get player's items
        List<Item> inventory = player.getInventory();

        // Search for the item
        for (Item item : inventory) {
            if (item.getName().equalsIgnoreCase(itemName)) {

                // Call the item’s own use() method for message
                String message = item.use();

                // If it’s a healing item, restore health
                if (item instanceof HealItem healItem) {
                    player.heal(healItem.getHealAmount());
                    player.removeItem(item);
                }
                return message;
            }
        }

        // Item not in inventory
        return ConsoleColors.RED +
                "You don’t have that item in your inventory." +
                ConsoleColors.RESET;
    }

    public void showPlayerStats() {
        System.out.println(ConsoleColors.CYAN + "=== Player Stats ===" + ConsoleColors.RESET);
        // Show current and max health
        System.out.println(ConsoleColors.GREEN + "Health: " + player.getHealth() + "/" + player.getMaxHealth() + ConsoleColors.RESET);
        System.out.println(ConsoleColors.CYAN + "====================" + ConsoleColors.RESET);
    }

    // Loads all rooms from file
    private void loadRooms(String fileName) throws IOException {
        rooms = new ArrayList<>();
        // Read file line by line
        Scanner scanner = new Scanner(new File(fileName));

        // This starts a loop that continues as long as there is
        // another line of input to read from the scanner.
        while (scanner.hasNextLine()) {
            String line = scanner.nextLine().trim();

            // This checks if the line is empty.
            // If it is, the continue statement immediately skips
            // the rest of the current loop iteration and moves on
            // to the next one.
            if (line.isEmpty() || line.startsWith("//")) continue;

            String[] parts = line.split("\\|");

            // Skip invalid lines
            if (parts.length < 7) continue;

            int id = Integer.parseInt(parts[0].trim());
            String name = parts[1].trim();
            String description = parts[2].trim();
            String[] exitIds = parts[3].trim().split(",");
            boolean visited = Boolean.parseBoolean(parts[4].trim());
            String itemID = parts[5].trim();
            String puzzleID = parts[6].trim();

            int north = Integer.parseInt(exitIds[0]);
            int east = Integer.parseInt(exitIds[1]);
            int south = Integer.parseInt(exitIds[2]);
            int west = Integer.parseInt(exitIds[3]);

            // Create and add room
            // Ensures each room is stored at its ID index (room 1 → index 0),
            //      even if rooms load out of order.
            Room room = new Room(id, name, description, north, east, south, west, visited, itemID, puzzleID);
            while (rooms.size() < id) {
                rooms.add(null);
            }
            rooms.set(id - 1, room);
        }
        scanner.close();
    }

    // Loads all items and attaches them to rooms
    private void loadItems(String fileName) throws IOException {
        Map<String, Item> allItems = new HashMap<>();
        Scanner scanner = new Scanner(new File(fileName));

        while (scanner.hasNextLine()) {
            String line = scanner.nextLine().trim();
            if (line.isEmpty()) continue;

            String[] parts = line.split("\\|");
            String id = parts[0].trim();
            String name = parts[1].trim();
            String description = parts[2].trim();
            String type = parts[3].trim();

            int value = 0;
            if (parts.length > 4) {
                try { value = Integer.parseInt(parts[4].trim()); }
                catch (NumberFormatException ignored) {}
            }

            Item item;

            // Dynamically determine subclass based on type
            // Create item by type
            switch (type.toLowerCase()) {
                case "weapon" -> item = new WeaponItem(id, name, description, value);
                case "heal" -> item = new HealItem(id, name, description, value);
                case "key" -> item = new KeyItem(id, name, description);
                default -> { item = new Item(id, name, description, "Misc"); }
            }
            allItems.put(id, item);
        }
        scanner.close();

        // Attach items to their assigned rooms
        // Loops through every Room object in the rooms list.
        for (Room room : rooms) {

            // Skips rooms that have no items (I0 means “no item assigned”).
            if (!room.getItemID().equalsIgnoreCase("I0")) {

                // Splits the itemID string (e.g., "I5,I6") into individual item IDs.
                String[] itemIDs = room.getItemID().split(",");

                // Goes through each split item ID (like "I5" and "I6").
                for (String itemId : itemIDs) {

                    // Removes any extra spaces.
                    itemId = itemId.trim();

                    // If the item exists in the allItems map, it’s added to the current room’s item list.
                    if (allItems.containsKey(itemId)) {
                        room.addItem(allItems.get(itemId));
                    }
                }
            }
        }
    }

    // Loads puzzles and attaches them to rooms
    private void loadPuzzles(String fileName) throws IOException {
        Scanner scanner = new Scanner(new File(fileName));

        while (scanner.hasNextLine()) {
            String line = scanner.nextLine().trim();
            if (line.isEmpty()) continue;

            String[] parts = line.split("\\|");
            String id = parts[0].trim();
            String question = parts[1].trim();
            String answer = parts[2].trim();
            String passMsg = parts[3].trim();
            String failMsg = parts[4].trim();
            int attempts = Integer.parseInt(parts[5].trim());
            boolean completed = Boolean.parseBoolean(parts[6].trim());

            Puzzle puzzle = new Puzzle(id, question, answer, passMsg, failMsg, attempts);
            if (completed) puzzle.reset(); // optional initialization behavior
            allPuzzles.put(id, puzzle);
        }
        scanner.close();

        // Attach puzzles to rooms after loading all
        for (Room room : rooms) {
            String puzzleId = room.getPuzzleID();
            if (!puzzleId.equalsIgnoreCase("P0") && allPuzzles.containsKey(puzzleId)) {
                room.setPuzzle(allPuzzles.get(puzzleId));
            }
        }
    }

    // Handles puzzle interaction and attempts
    private void triggerPuzzle(Puzzle puzzle) {
        Scanner scanner = new Scanner(System.in);

        System.out.println(ConsoleColors.YELLOW + "\nPuzzle: " + puzzle.getQuestion() + ConsoleColors.RESET);

        while (puzzle.getAttempts() > 0 && !puzzle.isCompleted()) {
            System.out.print(ConsoleColors.GREEN + "> " + ConsoleColors.RESET);
            String input = scanner.nextLine().trim();

            // Correct answer
            if (input.equalsIgnoreCase(puzzle.getAnswer())) {
                puzzle.setCompleted(true);
                System.out.println(ConsoleColors.CYAN + puzzle.getPassMsg() + ConsoleColors.RESET);
                break;
            }
            // Wrong answer
            else {
                puzzle.decrementAttempts();
                if (puzzle.getAttempts() > 0) {
                    System.out.println(ConsoleColors.RED + puzzle.getFailMsg() +
                            " You still have " + puzzle.getAttempts() + " attempts. Try again." + ConsoleColors.RESET);
                } else {
                    System.out.println(ConsoleColors.RED +
                            "Failed to solve. Puzzle resets next visit." + ConsoleColors.RESET);
                }
            }
        }

        // Reset puzzle for next visit if unsolved
        if (!puzzle.isCompleted()) {
            puzzle.reset();
        }
    }

    // Getters
    public List<Room> getRooms() { return rooms; }
    public Room getCurrentRoom() { return currentRoom; }
    public Player getPlayer() { return player; }
}
