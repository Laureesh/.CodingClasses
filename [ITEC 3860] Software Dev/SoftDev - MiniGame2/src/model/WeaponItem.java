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
 * This class represents a weapon type item that can be used by the player.
 */

public class WeaponItem extends Item {

    private int damage;

    public WeaponItem(String id, String name, String description, int damage) {
        super(id, name, description, "Weapon");
        this.damage = damage;
    }

    // Getters/Setters
    public int getDamage() { return damage; }
    public void setDamage(int damage) { this.damage = damage; }

    @Override
    public String use() {
        return ConsoleColors.GREEN + "You swing the " + getName() + ", dealing " + damage + " damage!" + ConsoleColors.RESET;
    }
}
