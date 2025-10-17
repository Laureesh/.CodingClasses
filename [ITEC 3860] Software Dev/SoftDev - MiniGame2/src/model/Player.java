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
 * Represents the player character in the game.
 * Manages the player’s inventory, health points (HP), and item interactions.
 * Provides methods for adding, removing, inspecting, and displaying items.
 */

public class Player {
    private List<Item> inventory = new ArrayList<>();
    // default/current health
    private int health = 50;
    // max health
    private final int MAX_HEALTH = 100;

    public void addItem(Item item) {
        inventory.add(item);
        }

    public void removeItem(Item item) {
        inventory.remove(item);
    }

    public List<Item> getInventory() {
        return inventory;
    }

    public void showInventory() {
        // If inventory is empty, show message
        if (inventory.isEmpty()) {
            System.out.println(ConsoleColors.YELLOW + "You didn’t pickup any items yet." + ConsoleColors.RESET);
        }
        else {
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
            //      Your Inventory:
            //      ["Soldier Pill" (Heal)]
            System.out.println(ConsoleColors.GREEN + itemsList + ConsoleColors.RESET);

        }
    }

    public int getHealth() {
        return health;
    }

    public int getMaxHealth() {
        return MAX_HEALTH;
    }

    public void heal(int amount) {
        health += amount;
        if (health > MAX_HEALTH) {
            health = MAX_HEALTH;
        }
    }
}
