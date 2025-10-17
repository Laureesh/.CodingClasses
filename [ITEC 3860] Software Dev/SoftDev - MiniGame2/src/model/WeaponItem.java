package model;

import view.ConsoleColors;

/**
 * Class: WeaponItem
 * Package: model
 * Author: Laureesh Volmar
 * Version: 2.0
 * Course: ITEC 3860 – Fall 2025
 * Written: October 16, 2025
 *
 * Description:
 * Represents a weapon-type item that can be used by the player.
 * Extends the Item class by adding a damage attribute and a custom use action.
 * Displays a message showing the damage dealt when used.
 */

public class WeaponItem extends Item {

    private int damage;

    public WeaponItem(String id, String name, String description, int damage) {
        super(id, name, description, "Weapon");
        this.damage = damage;
    }

    @Override
    public String use() {
        return ConsoleColors.RED + "You swing the " + getName() + ", dealing " + damage + " damage!" + ConsoleColors.RESET;
    }

    public int getDamage() {
        return damage;
    }
}
