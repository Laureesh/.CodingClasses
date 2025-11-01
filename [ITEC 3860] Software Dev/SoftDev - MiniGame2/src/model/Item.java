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
 * Represents a basic game item with an ID, name, description, and type.
 * implentation inheritance
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
