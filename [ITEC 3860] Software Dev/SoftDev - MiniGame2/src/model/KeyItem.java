package model;

import view.ConsoleColors;

/**
 * Class: KeyItem
 * Package: model
 * Author: Laureesh Volmar
 * Version: 2.0
 * Course: ITEC 3860 – Fall 2025
 * Written: October 16, 2025
 *
 * Description:
 * This class represents a key type item used to unlock doors.
 */

public class KeyItem extends Item {

    public KeyItem(String id, String name, String description) {
        // Use the superclass constructor
        super(id, name, description, "Key");
    }

    @Override
    public String use() {
        return ConsoleColors.YELLOW + "You used the " + getName() + " to unlock something." + ConsoleColors.RESET;
    }
}
