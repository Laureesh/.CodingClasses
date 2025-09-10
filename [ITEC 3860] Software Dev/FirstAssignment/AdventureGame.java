import java.io.*;
import java.util.*;

/** Class: AdventureGame
 * @author Laureesh Volmar
 * @version 1.2
 * Course: ITEC 3860 Fall 2025
 * Written: August 26, 2025
 *
 * This class implements the adventure game. It loads the rooms, navigates the player
 * through the game, and keeps track of visited rooms.
 */
public class AdventureGame {
    private static Map<Integer, Room> rooms = new HashMap<>();
    private static Room currentRoom;

    /** Method: main
     * Entry point for the game.
     * @param args command line arguments (not used)
     * @throws IOException if the rooms file cannot be read
     */
    public static void main(String[] args) throws IOException {
        loadRooms("RoomsMG1.txt");
        playGame();
    }

    /** Method: loadRooms
     * Reads the room data from a file and initializes the game rooms.
     * @param fileName the name of the file containing room data
     * @throws IOException if the file cannot be read
     */
    private static void loadRooms(String fileName) throws IOException {
        BufferedReader reader = new BufferedReader(new FileReader(fileName));
        String line;
        Room room = null;

        while ((line = reader.readLine()) != null) {
            line = line.trim();
            if (line.startsWith("ID")) {
                int id = Integer.parseInt(line.split("=")[1].trim());
                room = new Room(id);
                rooms.put(id, room);
            } else if (line.startsWith("name")) {
                room.setName(line.split("=")[1].trim());
            } else if (line.equalsIgnoreCase("Description")) {
                StringBuilder description = new StringBuilder();
                // keep reading until we reach "visited = ..."
                while ((line = reader.readLine()) != null && !line.toLowerCase().startsWith("visited")) {
                    description.append(line).append("\n");
                }
                room.setDescription(description.toString().trim());

                // now line should be "visited = ..."
                if (line != null && line.toLowerCase().startsWith("visited")) {
                    String value = line.split("=")[1].trim().toLowerCase();
                    room.setVisited(value.equals("true"));
                }

                // next line should be "exits = ..."
                line = reader.readLine();
                if (line != null && line.toLowerCase().startsWith("exits")) {
                    String[] exits = line.split("=")[1].trim().split(",");
                    for (String exit : exits) {
                        String[] directionRoom = exit.trim().split("\\s+");
                        if (directionRoom.length == 2) {
                            room.addExit(directionRoom[0].toUpperCase(),
                                    Integer.parseInt(directionRoom[1]));
                        }
                    }
                }
            }
        }

        reader.close();
        currentRoom = rooms.get(1);
    }

    /** Method: playGame
     * Handles the main game loop, allowing the user to navigate through the rooms.
     */
    private static void playGame() {
        Scanner scanner = new Scanner(System.in);

        System.out.println("Welcome to my adventure game!");
        System.out.println("To navigate, type the direction (NORTH, SOUTH, EAST, WEST).");
        System.out.println("To exit the game, type X.\n");

        while (true) {
            // Show name and description, with visited handling
            if (currentRoom.isVisited()) {
                System.out.println(currentRoom.getName() + " - You have visited this room.");
            } else {
                System.out.println(currentRoom.getName());
            }
            System.out.println(currentRoom.getDescription());
            System.out.println("Exits: " + currentRoom.getExits().keySet());
            System.out.println("What would you like to do?");

            // mark this room as visited after showing
            currentRoom.setVisited(true);

            // get input
            String input = scanner.nextLine().trim().toUpperCase();

            // allow shortcuts: N, S, E, W
            if (input.equals("N")) input = "NORTH";
            if (input.equals("S")) input = "SOUTH";
            if (input.equals("E")) input = "EAST";
            if (input.equals("W")) input = "WEST";

            if (input.equals("X")) {
                System.out.println("Thank you for playing!");
                break;
            }

            // navigation
            if (currentRoom.hasExit(input)) {
                int nextRoomId = currentRoom.getExit(input);
                currentRoom = rooms.get(nextRoomId);
            } else {
                System.out.println("You can't go this way.");
            }
        }
        scanner.close();
    }

}


