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
 * This class represents a healing item that restores the player's health when used.
 */

public class HealItem extends Item {
    private int healAmount;

    public HealItem(String id, String name, String description, int healAmount) {
        super(id, name, description, "Heal");
        this.healAmount = healAmount;
    }

    // Getters/Setters
    public int getHealAmount() { return healAmount; }
    public void setHealAmount(int healAmount) { this.healAmount = healAmount; }

    public void heal(Player player) {
        // Increase the player's health by the healing amount of this item
        player.setHealth(player.getHealth() + getHealAmount());

        // If the new health is higher than the maximum allowed, limit it to max health
        if (player.getHealth() > player.getMaxHealth()) {
            player.setHealth(player.getMaxHealth());
        }

        // Show the player's updated health in the console
        System.out.println(ConsoleColors.CYAN
                + "Current Health: " + player.getHealth() + "/" + player.getMaxHealth()
                + ConsoleColors.RESET);
    }

    @Override
    public String use() {
        return ConsoleColors.GREEN + "You used " + getName() + " and restored " + healAmount + " health points!" + ConsoleColors.RESET;
    }
}
