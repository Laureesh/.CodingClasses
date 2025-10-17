package model;

import java.util.ArrayList;
import java.util.List;

/**
 * Class: Room
 * Package: model
 * Author: Laureesh Volmar
 * Version: 2.0
 * Course: ITEC 3860 – Fall 2025
 * Written: October 16, 2025
 *
 * Description:
 * Represents a single room in the game world.
 * Stores its ID, name, description, exits, items, and associated puzzle.
 * Tracks whether the player has visited and manages in-room interactions.
 */

public class Room {
    private int id;
    private String name;
    private String description;
    private int north, east, south, west;
    private boolean visited;
    private String itemID;
    private String puzzleID;

    private List<Item> items = new ArrayList<>();
    private Puzzle puzzle;

    // this is the constructor for a room object
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
    }

    public int getId() { return id; }
    public String getName() { return name; }
    public String getDescription() { return description; }
    public boolean isVisited() { return visited; }
    public void setVisited(boolean visited) { this.visited = visited; }
    public String getItemID() { return itemID; }
    public String getPuzzleID() { return puzzleID; }
    public List<Item> getItems() { return items; }
    public void addItem(Item item) { items.add(item); }
    public void removeItem(Item item) { items.remove(item); }

    public void setPuzzle(Puzzle puzzle) {
        this.puzzle = puzzle;
    }

    public Puzzle getPuzzle() {
        return puzzle;
    }

    // This method returns the room ID connected in a given direction.
    public int getExit(String dir) {
        return switch (dir) {
            case "NORTH", "N" -> north;
            case "EAST", "E" -> east;
            case "SOUTH", "S" -> south;
            case "WEST", "W" -> west;
            default -> 0;
        };
    }
}