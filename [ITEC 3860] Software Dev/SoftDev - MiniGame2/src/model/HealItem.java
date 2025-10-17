package model;

import view.ConsoleColors;

/**
 * Class: HealItem
 * Package: model
 * Author: Laureesh Volmar
 * Version: 2.0
 * Course: ITEC 3860 – Fall 2025
 * Written: October 16, 2025
 *
 * Description:
 * Represents a healing item that restores the player's health when used.
 * Extends the Item class by adding a heal amount attribute and a custom use message.
 * Displays a message showing the HP restored upon use.
 */

public class HealItem extends Item {
    private int healAmount;

    public HealItem(String id, String name, String description, int healAmount) {
        super(id, name, description, "Heal");
        this.healAmount = healAmount;
    }

    @Override
    public String use() {
        return ConsoleColors.GREEN + "You used " + getName() + " and restored " + healAmount + " health points!" + ConsoleColors.RESET;
    }

    public int getHealAmount() {
        return healAmount;
    }
}
