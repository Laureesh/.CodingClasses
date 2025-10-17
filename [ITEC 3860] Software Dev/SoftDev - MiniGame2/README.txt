========== How to Start the Game ==========
// 1. Ensure the following files are inside your project folder structure:
//    Project/
//    ├── data/
//    │   ├── rooms.txt
//    │   ├── items.txt
//    │   └── puzzles.txt
//    ├── src/
//    │   ├── controller/
//    │   │   └── GameController.java
//    │   ├── model/
//    │   │   ├── Game.java
//    │   │   ├── Room.java
//    │   │   ├── Player.java
//    │   │   ├── Item.java
//    │   │   ├── WeaponItem.java
//    │   │   ├── HealItem.java
//    │   │   ├── KeyItem.java
//    │   │   └── Puzzle.java
//    │   └── view/
//    │       └── ConsoleColors.java
//    └── README.txt
//
// 2. Compile and run the main class:
//       controller.GameController

========== Rooms Text File Format ==========
// Each line in rooms.txt is split into 7 parts, separated by "|" (vertical bar symbol):
<roomID>|<roomName>|<roomDescription>|<roomConnections>|<isVisited>|<itemID>|<puzzleID>

// <roomID>       Unique number assigned to each room.
// <roomName>     The name of the room (Naruto location).
// <roomDescription> Text describing the room.
// <roomConnections> Four comma-separated integers representing exits in order:
//                   North, East, South, West (use 0 if no connection in that direction).
// <isVisited>    Boolean (True or False) — marks if the player has visited this room.
// <itemID>       ID of the item present in this room (use I0 for none).
// <puzzleID>     ID of the puzzle linked to this room (use P0 for none).

========== Items Text File Format ==========
// Each line in items.txt is split into 4 parts, separated by "|" (vertical bar symbol):
<itemID>|<itemName>|<itemDescription>|<itemType>|<value>

// <itemID>         Unique number assigned to each item (must start with "I").
// <itemName>       The name of the item (as displayed in-game).
// <itemDescription> Description of what the item is or does.
// <itemType>       The type/category of the item: Weapon, Heal, Key, or Misc.
// <value>          Numeric value associated with the item type:
//                   - For Weapon: represents damage dealt.
//                   - For Heal: represents the amount of health restored.
//                   - For Key or Misc: leave blank if not applicable.

========== Puzzles Text File Format ==========
// Each line in puzzles.txt is split into 7 parts, separated by "|" (vertical bar symbol):
<puzzleID>|<puzzleQuestion>|<puzzleAnswer>|<puzzlePassMessage>|<puzzleFailMessage>|<puzzleAttempts>|<puzzleFlag>

// <puzzleID>           Unique number assigned to each puzzle (must start with "P").
// <puzzleQuestion>     The question or challenge presented to the player.
// <puzzleAnswer>       The correct answer to solve the puzzle.
// <puzzlePassMessage>  Message shown when the player solves the puzzle correctly.
// <puzzleFailMessage>  Message shown when the answer is wrong.
// <puzzleAttempts>     Number of tries allowed before puzzle resets.
// <puzzleFlag>         Boolean (True/False) — indicates if puzzle has been solved.

========== AI Usage ==========
Mini Game Part 1
// Brainstormed how to theme the rooms based on Naruto locations.
// Improved the formatting of README instructions to make them easier to follow.
// AI suggested different ways to allow both short and long commands.
// AI suggested a cleaner way to format output for readability.
Mini Game Part 2
//
//
//
//
