package model;

/**
 * Class: Item
 * Package: model
 * Author: Laureesh Volmar
 * Version: 2.0
 * Course: ITEC 3860 – Fall 2025
 * Written: October 16, 2025
 *
 * Description:
 * Defines an item object used within the game.
 * Stores its unique ID, name, description, and type.
 * Provides basic accessors, a formatted string output, and a placeholder use method.
 */

public class Item {
    private String id;
    private String name;
    private String description;
    private String type;

    public Item(String id, String name, String description, String type) {
        this.id = id;
        this.name = name;
        this.description = description;
        this.type = type;
    }

    public String getId() { return id; }
    public String getName() { return name; }
    public String getDescription() { return description; }
    public String getType() { return type; }

    public String use() {
        return "";
    }
}
