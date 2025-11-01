package model;

import view.ConsoleColors;
import java.util.*;

/**
 * Class: Room
 * Package: model
 * Author: Laureesh Volmar
 * Version: 2.0
 * Course: ITEC 3860 – Fall 2025
 * Written: October 16, 2025
 *
 * Description:
 * Now holds global currentRoom reference.
 * Displays itself, exits, and map.
 */
public class Room {
    // Holds every room created in the game
    private static final List<Room> allRooms = new ArrayList<>();
    // Keeps track of the player's current room
    private static Room currentRoom;

    private int id;
    private String name;
    private String description;
    private int north, east, south, west;
    private boolean visited;
    private String itemID, puzzleID;

    // Items currently inside the room
    private List<Item> items = new ArrayList<>();
    // Puzzle linked to this room (if any)
    private Puzzle puzzle;

    // Constructor - creates a room and adds it to the global list
    public Room(int id, String name, String description, int north, int east, int south, int west,
                boolean visited, String itemID, String puzzleID) {
        this.id = id;
        this.name = name;
        this.description = description;
        this.north = north;
        this.east = east;
        this.south = south;
        this.west = west;
        this.visited = visited;
        this.itemID = itemID;
        this.puzzleID = puzzleID;

        // Add this room (the one currently being created) into the list of all rooms.
        allRooms.add(this);
    }

    // Getters/Setters
    public String getName() { return name; }
    public int getExit(String direction) {
        return switch (direction.toUpperCase()) {
            case "N", "NORTH" -> north;
            case "E", "EAST" -> east;
            case "S", "SOUTH" -> south;
            case "W", "WEST" -> west;
            default -> 0;
        };
    }
    public boolean isVisited() { return visited; }
    public void setVisited(boolean visited) { this.visited = visited; }
    public String getItemID() { return itemID; }
    public List<Item> getItems() { return items; }
    public void addItem(Item i) { items.add(i); }
    public void removeItem(Item i) { items.remove(i); }
    public String getPuzzleID() { return puzzleID; }
    public Puzzle getPuzzle() { return puzzle; }
    public void setPuzzle(Puzzle puzzle) { this.puzzle = puzzle; }
    public static Room getCurrentRoom() { return currentRoom; }
    public static void setCurrentRoom(Room room) { currentRoom = room; }
    public static Room getRoomById(int id) {
        // Go through each room in the list
        for (Room room : allRooms) {
            // If the room's ID matches, return that room
            if (room.id == id) { return room; }
        }
        // If no room was found, return null
        return null;
    }

    // Shows the name, description, and prompts player for next action
    public void showCurrentRoom() {
        // Room title in color
        System.out.println(ConsoleColors.PURPLE + name + ConsoleColors.RESET);
        // Split long descriptions into separate sentences
        String[] sentences = description.split("\\.\\s*");
        for (String sentence : sentences) {
            if (sentence.trim().isEmpty()) continue;
            // Highlight sentences that mention directions
            if (sentence.toLowerCase().matches(".*(north|south|east|west).*")) {
                System.out.println(ConsoleColors.GREEN + sentence.trim() + "." + ConsoleColors.RESET);
            }
            else {
                System.out.println(sentence.trim() + ".");
            }
        }

        // Ask player what they want to do next
        System.out.println(ConsoleColors.CYAN + "What would you like to do?" + ConsoleColors.RESET);
    }

    // Look command's logic - displays all available exits from the current room
    public void look() {
        String exits = ConsoleColors.CYAN + "Available exits for " + name + ": [";

        // Add each possible exit if it exists
        if (north > 0) exits += "North, ";
        if (east > 0) exits += "East, ";
        if (south > 0) exits += "South, ";
        if (west > 0) exits += "West, ";

        // Remove the final comma and space, if present
        if (exits.endsWith(", ")) {
            exits = exits.substring(0, exits.length() - 2);
        }

        exits += "]" + ConsoleColors.RESET;
        System.out.println(exits);
    }

    // Map command's logic - displays how many rooms have been visited and lists all rooms
    public void showMap() {
        // Count how many rooms have been visited
        int visitedCount = 0;
        for (Room room : allRooms) {
            if (room.isVisited()) {
                visitedCount++;
            }
        }

        // Example: "Visited 1 of 10 rooms"
        System.out.println(ConsoleColors.CYAN
                + "Visited " + visitedCount + " of " + allRooms.size() + " rooms"
                + ConsoleColors.RESET);

        // List all rooms with a "(visited)" tag if already explored
        for (Room room : allRooms) {
            String status = "";
            if (room.isVisited()) {
                status = "(visited)";
            }

            // "1 | Konoha Village Gate (visited)"
            System.out.println(room.id + " | " + room.name + " " + status);
        }
    }

}
