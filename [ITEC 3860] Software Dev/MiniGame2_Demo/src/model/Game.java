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
 * Manages global data (rooms, puzzles, items) and provides help text.
 */
public class Game {
    // Stores all rooms in the game
    private final List<Room> rooms = new ArrayList<>();

    // Stores all puzzles by ID
    private final Map<String, Puzzle> allPuzzles = new HashMap<>();

    // The single player instance
    private static Player player;

    public Game() throws IOException {
        // Load data from text files
        loadRooms("data/rooms.txt");
        loadPuzzles("data/puzzles.txt");
        loadItems("data/items.txt");

        // Set starting room
        Room.setCurrentRoom(rooms.get(0));
        Room.getCurrentRoom().setVisited(true);

        // Create and register the player
        player = new Player();
        Player.setCurrentPlayer(player);
    }

    // Prints a list of all possible player commands
    public void printHelp() {
        System.out.println(ConsoleColors.YELLOW + """
                Available Commands:
                N, E, S, W - Move
                EXPLORE - View items in current room
                PICKUP [item] - Add item to inventory
                DROP [item] - Drop item in room
                INSPECT [item] - View item description
                USE [item] - Use an item from your inventory
                INVENTORY - View your items
                LOOK - Show room exits
                PLAYERSTATS - Show health
                MAP - Show visited rooms
                HELP - Show this list
                EXIT/X/QUIT - Quit the game
                """ + ConsoleColors.RESET);
    }

    // Reads all rooms from rooms.txt and creates Room objects
    private void loadRooms(String fileName) throws IOException {
        Scanner scanner = new Scanner(new File(fileName));
        while (scanner.hasNextLine()) {
            String line = scanner.nextLine().trim();

            // Skip blank or comment lines
            if (line.isEmpty() || line.startsWith("//")) continue;

            // Split each line using vertical bar and into separate parts
            // <roomID>|<roomName>|<roomDescription>|<roomConnections>|<isVisited>|<itemID>|<puzzleID>
            String[] parts = line.split("\\|");
            int id = Integer.parseInt(parts[0].trim());
            String name = parts[1].trim();
            String desc = parts[2].trim();
            String[] exits = parts[3].split(",");
            int north = Integer.parseInt(exits[0]);
            int east = Integer.parseInt(exits[1]);
            int south = Integer.parseInt(exits[2]);
            int west = Integer.parseInt(exits[3]);
            boolean visited = Boolean.parseBoolean(parts[4].trim());
            String itemID = parts[5].trim();
            String puzzleID = parts[6].trim();

            // Create and add a new Room to the list
            rooms.add(new Room(id, name, desc, north, east, south, west, visited, itemID, puzzleID));
        }
        scanner.close();
    }

    // Reads all items from items.txt and assigns them to rooms
    private void loadItems(String fileName) throws IOException {
        // Stores all items by ID
        Map<String, Item> allItems = new HashMap<>();
        Scanner scanner = new Scanner(new File(fileName));

        while (scanner.hasNextLine()) {
            String line = scanner.nextLine().trim();
            // Skip blank lines
            if (line.isEmpty()) continue;

            // Split each line using vertical bar and into separate parts
            // <itemID>|<itemName>|<itemDescription>|<itemType>|<value>
            String[] parts = line.split("\\|");
            String id = parts[0].trim();
            String name = parts[1].trim();
            String description = parts[2].trim();
            String type = parts[3].trim();
            int value = 0;
            if (parts.length > 4) { value = Integer.parseInt(parts[4].trim()); }

            // Choose what kind of item to create based on type
            Item item;
            switch (type.toLowerCase()) {
                case "weapon" -> item = new WeaponItem(id, name, description, value);
                case "heal" -> item = new HealItem(id, name, description, value);
                case "key" -> item = new KeyItem(id, name, description);
                default -> { item = new Item(id, name, description, "Misc"); }
            }
            // Save item by its ID
            allItems.put(id, item);
        }
        scanner.close();

        // Go through every room and attach items to it
        for (Room room : rooms) {
            // Skips rooms that have no items (I0 means “no item assigned”).
            if (!room.getItemID().equalsIgnoreCase("I0")) {
                // Splits the itemID string (ex: "I5,I6") into individual item IDs.
                String[] itemIDs = room.getItemID().split(",");
                // Goes through each split item ID (like "I5" and "I6").
                for (String itemId : itemIDs) {
                    itemId = itemId.trim();
                    // If the item exists in the allItems map, it’s added to the current room’s item list.
                    if (allItems.containsKey(itemId)) {
                        room.addItem(allItems.get(itemId));
                    }
                }
            }
        }
    }

    // Reads all puzzles from puzzles.txt and links them to rooms
    private void loadPuzzles(String fileName) throws IOException {
        Scanner scanner = new Scanner(new File(fileName));
        while (scanner.hasNextLine()) {
            String line = scanner.nextLine().trim();
            if (line.isEmpty()) continue;

            // Split each line using vertical bar and into separate parts
            // <puzzleID>|<puzzleQuestion>|<puzzleAnswer>|<puzzlePassMessage>|<puzzleFailMessage>|<puzzleAttempts>|<puzzleFlag>
            String[] parts = line.split("\\|");
            String id = parts[0].trim();
            String question = parts[1].trim();
            String answer = parts[2].trim();
            String passMsg = parts[3].trim();
            String failMsg = parts[4].trim();
            int attempts = Integer.parseInt(parts[5].trim());
            boolean completed = Boolean.parseBoolean(parts[6].trim());

            // Create a new Puzzle object and store it
            Puzzle puzzle = new Puzzle(id, question, answer, passMsg, failMsg, attempts, completed);
            allPuzzles.put(id, puzzle);
        }
        scanner.close();

        // Link each puzzle to its assigned room
        for (Room room : rooms) {
            String puzzleID = room.getPuzzleID();
            if (!puzzleID.equalsIgnoreCase("P0") && allPuzzles.containsKey(puzzleID)) {
                room.setPuzzle(allPuzzles.get(puzzleID));
            }
        }
    }
}
