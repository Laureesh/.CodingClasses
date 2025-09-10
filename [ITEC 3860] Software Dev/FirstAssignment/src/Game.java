import java.io.*;
import java.util.*;

/**Class: Game
 * @author Laureesh Volmar
 * @version 1.2
 * Course: ITEC 3860 Fall 2025
 * Written: August 28, 2025
 *
 * This class handles loading the room and playing the game.
 */

public class Game {
    private static List<Room> rooms = new ArrayList<>();
    private static Room currentRoom;

    public static void main(String[] args) throws IOException {
        // loads the rooms from the txt file Rooms.txt
        loadRooms("Rooms.txt");
        // starts the game
        playGame();
    }

    private static void loadRooms(String fileName) throws IOException {
        // This will create an object that can read the txt file line by line
        Scanner scanner = new Scanner(new File(fileName));

        while (scanner.hasNextLine()) {
            String line = scanner.nextLine().trim();
            if (line.isEmpty()) continue;

            // breaks the txt file into parts split by "|"
            String[] parts = line.split("\\|");
            int id = Integer.parseInt(parts[0].trim());
            String name = parts[1].trim();
            String description = parts[2].trim();
            String[] exitIds = parts[3].trim().split(",");
            boolean visited = Boolean.parseBoolean(parts[4].trim());

            // sets the RoomID to the exit direction
            int north = Integer.parseInt(exitIds[0]);
            int east  = Integer.parseInt(exitIds[1]);
            int south = Integer.parseInt(exitIds[2]);
            int west  = Integer.parseInt(exitIds[3]);

            // this will call the room's constructor
            // All the data we just pulled from the txt file will then create a new object
            Room room = new Room(id, name, description, north, east, south, west, visited);

            //
            while (rooms.size() < id) {
                rooms.add(null);
            }
            rooms.set(id - 1, room);
        }
        scanner.close();

        // starts you in room id 1
        currentRoom = rooms.get(0);
    }

    private static void playGame() {
        Scanner scanner = new Scanner(System.in);

        // the source for the naruto info: https://naruto.fandom.com/wiki/Category:Locations
        System.out.println("Welcome to the Hidden Leaf Adventure, shinobi!");
        System.out.println("Step into the world of Naruto, where the Will of Fire guides your path.");
        System.out.println("Use N, E, S, W to move North, East, South or West.\nType X to quit.\n");

        while (true) {
            if (currentRoom.isVisited()) {
                System.out.println(currentRoom.getName() + " - You have visited this room.");
            }
            else {
                System.out.println(currentRoom.getName());
            }

            // this will make sure each sentence from a single room is on a new line
            for (String sentence : currentRoom.getDescription().split("\\. ")) {
                System.out.println(sentence.trim() + ".");
            }
            System.out.print("What would you like to do?\n");

            // marks the room as visited
            currentRoom.setVisited(true);
            // this will wait for the player’s command, clean it up, and make it uppercase.
            // w = "W" or west = "WEST"
            String input = scanner.nextLine().trim().toUpperCase();

            // players types X and the loop breaks, ending the game loop
            if (input.equals("X")) {
                System.out.println("Thanks for playing!");
                break;
            }

            // Looks at the direction the player typed
            // then find outs the room id that is
            // if no exits, returns 0
            int nextId = currentRoom.getExit(input);
            // Checks and makes sure the id is greater than 0
            // and less than id 10 which is the most amount of rooms available
            if (nextId > 0 && nextId <= rooms.size()) {
                // if room exist, moves the player there
                // -1 is because lists in java start at 0, room ids start at 1
                currentRoom = rooms.get(nextId - 1);
            }
            // if the number is 0 or too big, then this will print
            else {
                System.out.println("You can't go that way.");
            }
        }
        scanner.close();
    }
}
