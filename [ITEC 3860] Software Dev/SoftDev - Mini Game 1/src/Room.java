/**Class: Room
 * @author Laureesh Volmar
 * @version 1.2
 * Course: ITEC 3860 Fall 2025
 * Written: August 26, 2025
 *
 * This class handles the rooms.
 */
public class Room {
    private int id;
    private String name;
    private String description;
    private int north, east, south, west;
    private boolean visited;

    // this is the constructor for a room object
    public Room(int id, String name, String description,
                int north, int east, int south, int west, boolean visited) {
        this.id = id;
        this.name = name;
        this.description = description;
        this.north = north;
        this.east = east;
        this.south = south;
        this.west = west;
        this.visited = visited;
    }

    public String getName() {
        return name;
    }

    public String getDescription() {
        return description;
    }

    public boolean isVisited() {
        return visited;
    }

    public void setVisited(boolean visited) {
        this.visited = visited;
    }

    // this will take what the player typed and return the room ID in that direction
    // if the exit does not exist, 0 will be return
    public int getExit(String dir) {
        switch (dir) {
            case "NORTH": case "N": return north;
            case "EAST": case "E":  return east;
            case "SOUTH": case "S": return south;
            case "WEST": case "W":  return west;
            default: return 0;
        }
    }
}
