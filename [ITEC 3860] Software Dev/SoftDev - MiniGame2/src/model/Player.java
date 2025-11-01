package model;

import view.ConsoleColors;
import java.util.*;

/**
 * Class: Player
 * Package: model
 * Author: Laureesh Volmar
 * Version: 2.0
 * Course: ITEC 3860 – Fall 2025
 * Written: October 16, 2025
 *
 * Description:
 * Handles player movement, explore command, health, and inventory actions
 * like picking up, inspecting, dropping, and using items.
 */
public class Player {
    // Stores player's items
    private final List<Item> inventory = new ArrayList<>();
    private int health = 50;
    private final int MAX_HEALTH = 100;

    // === Getters/Setters ===
    public int getHealth() { return health; }
    public int getMaxHealth() { return MAX_HEALTH; }
    public void setHealth(int health) { this.health = health; }

    // This method moves the player
    public void movePlayer(String direction) {
        // Get current room
        Room currentRoom = Room.getCurrentRoom();

        // Get the next room’s ID in chosen direction
        int nextId = currentRoom.getExit(direction);

        // If there’s no valid exit
        if (nextId <= 0) {
            System.out.println(ConsoleColors.CYAN + "You can't go that way.\n" + ConsoleColors.RESET);
            Room.getCurrentRoom().showCurrentRoom();
            return;
        }

        // Get the next room by its ID
        Room nextRoom = Room.getRoomById(nextId);
        if (nextRoom == null) {
            System.out.println(ConsoleColors.RED + "That path leads nowhere..." + ConsoleColors.RESET);
            return;
        }

        // Show different message depending on whether room was visited
        String message;
        if (nextRoom.isVisited()) {
            message = ConsoleColors.CYAN + nextRoom.getName() + " - You have visited this room before." + ConsoleColors.RESET;
        }
        else {
            message = ConsoleColors.CYAN + "You moved to " + nextRoom.getName() + "." + ConsoleColors.RESET;
        }

        // Mark as visited and move the player
        nextRoom.setVisited(true);
        Room.setCurrentRoom(nextRoom);
        System.out.println(message + "\n");

        // If the next room has a puzzle, and it's not completed, trigger the puzzle
        if (nextRoom.getPuzzle() != null && !nextRoom.getPuzzle().isCompleted()) {
            nextRoom.getPuzzle().triggerPuzzle();
        }

        // Show room description and exits
        nextRoom.showCurrentRoom();
    }

    // Explore command's logic
    public void explore() {
        // Get items in current room
        List<Item> items = Room.getCurrentRoom().getItems();

        // If room has no items
        if (items.isEmpty()) {
            System.out.println(ConsoleColors.YELLOW + "You searched " + Room.getCurrentRoom().getName() + " but find nothing of interest." + ConsoleColors.RESET);
            return;
        }

        // Display found items
        String result = ConsoleColors.CYAN + "You explored " + Room.getCurrentRoom().getName() + " and found:\n" + ConsoleColors.RESET;
        String itemsList = "[";
        // Loop through items and add color based on type
        for (int i = 0; i < items.size(); i++) {
            Item item = items.get(i);
            // Choose color based on item type
            String color;
            switch (item.getType().toLowerCase()) {
                case "weapon" -> color = ConsoleColors.RED;
                case "heal" -> color = ConsoleColors.GREEN;
                case "key" -> color = ConsoleColors.YELLOW;
                default -> color = ConsoleColors.WHITE;
            }

            // Add formatted item entry
            // Ex: "Pill" (Heal)
            itemsList += color + "\"" + item.getName() + "\" (" + item.getType() + ")" + ConsoleColors.RESET;
            if (i < items.size() - 1) itemsList += ", ";
        }
        itemsList += "]";
        result += itemsList;

        // Print items in room
        System.out.println(result);
    }

    // Pickup command's logic
    public void pickup(String name) {
        // Get current room
        Room currentRoom = Room.getCurrentRoom();

        // Find the item by name in room
        Item item = null;
        for (Item i : currentRoom.getItems()) {
            if (i.getName().equalsIgnoreCase(name)) {
                item = i;
                break;
            }
        }

        // If item doesn’t exist
        if (item == null) {
            System.out.println(ConsoleColors.RED + "No such item here." + ConsoleColors.RESET);
            return;
        }

        // Add item to inventory and remove it from room
        inventory.add(item);
        currentRoom.removeItem(item);
        System.out.println(ConsoleColors.GREEN
                + item.getName()
                + " has been picked up from the room and successfully added to your inventory."
                + ConsoleColors.RESET);
    }

    // Inspect command's logic = lets player read the description of an item they have
    public void inspect(String name) {
        // Find item by name in inventory
        Item item = null;
        for (Item i : inventory) {
            if (i.getName().equalsIgnoreCase(name)) {
                item = i;
                break;
            }
        }

        // If player doesn’t have the item
        if (item == null) {
            System.out.println(ConsoleColors.YELLOW + "You don’t have that item in your inventory." + ConsoleColors.RESET);
            return;
        }
        System.out.println(ConsoleColors.CYAN
                + "Inspecting " + item.getName() + ":\n"
                + item.getDescription() + ConsoleColors.RESET);
    }

    // Drop command's logic = drops an item into the current room
    public void drop(String name) {
        Room currentRoom = Room.getCurrentRoom();

        // Find the item by name
        Item item = null;
        for (Item i : currentRoom.getItems()) {
            if (i.getName().equalsIgnoreCase(name)) {
                item = i;
                break;
            }
        }

        // If player doesn’t have the item
        if (item == null) {
            System.out.println(ConsoleColors.YELLOW + "You don’t have that item to drop." + ConsoleColors.RESET);
            return;
        }

        // Remove from inventory and add back to room
        inventory.remove(item);
        currentRoom.addItem(item);
        System.out.println(ConsoleColors.GREEN
                + item.getName()
                + " has been dropped successfully from your inventory and placed in "
                + currentRoom.getName()
                + "."
                + ConsoleColors.RESET);
    }

    // Use command's logic = uses an item from inventory (healing, weapon, or key)
    public void use(String name) {
        // Find item by name in inventory
        Item item = null;
        for (Item i : inventory) {
            if (i.getName().equalsIgnoreCase(name)) {
                item = i;
                break;
            }
        }

        if (item == null) {
            System.out.println(ConsoleColors.RED + "You don’t have that item in your inventory." + ConsoleColors.RESET);
            return;
        }

        // Show the item’s own message based on type
        System.out.println(item.use());

        // If it's a healing item, apply its effect
        if (item instanceof HealItem healItem) {
            // Heal the player
            healItem.heal(this);
        }

        // Remove item after use
        inventory.remove(item);
    }

    // Inventory command's logic
    public void showInventory() {
        if (inventory.isEmpty()) {
            System.out.println(ConsoleColors.YELLOW + "You didn’t pickup any items yet." + ConsoleColors.RESET);
            return;
        }

        System.out.println(ConsoleColors.CYAN + "Your Inventory:" + ConsoleColors.RESET);
        // Build list like ["Item" (Type), "Item2" (Type)]
        String itemsList = "[";
        for (int i = 0; i < inventory.size(); i++) {
            Item item = inventory.get(i);
            itemsList += "\"" + item.getName() + "\" (" + item.getType() + ")";
            if (i < inventory.size() - 1) itemsList += ", ";
        }
        itemsList += "]";

        // Display formatted inventory
        // Example:
        //   Your Inventory:
        //   ["Soldier Pill" (Heal)]
        System.out.println(ConsoleColors.GREEN + itemsList + ConsoleColors.RESET);
    }

    // Displays player’s health bar only for now
    // Will add later: Damage, Level, and XP
    public void showPlayerStats() {
        System.out.println(ConsoleColors.CYAN + "=== Player Stats ===" + ConsoleColors.RESET);
        System.out.println(ConsoleColors.GREEN + "Health: " + health + "/" + MAX_HEALTH + ConsoleColors.RESET);
        System.out.println(ConsoleColors.CYAN + "====================" + ConsoleColors.RESET);
    }

    // Prints a list of all possible player commands
    // Move to player
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
}
