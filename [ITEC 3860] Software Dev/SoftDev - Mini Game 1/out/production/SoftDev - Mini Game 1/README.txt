========== Welcome to the Naruto Text Adventure Game ==========
This program allows you to play a simple text-based adventure game set inside the Hidden Leaf Village (Konoha).
The game loads the world map from the file Rooms.txt and constructs the environment based on that input.

========== How to Start the Game ==========
Make sure the files Game.java, Room.java, and Rooms.txt are in the same project folder.

========== Rooms Text File Format ==========
Each line in Rooms.txt is split into 5 parts, separated by "|" (vertical bar symbol):
<roomID>|<roomName>|<roomDescription>|<roomConnections>|<isVisited>

<roomID> Unique number assigned to each room.
<roomName> The name of the room (Naruto location).
<roomDescription> Text describing the room.
<roomConnections> A list of 4 integers representing exits in the order North, East, South, West.
<isVisited> A boolean (True or False) showing whether the room has been visited before.

========== Gameplay Instructions ==========
At the start, the player begins at Room 1 (Konoha Village Gate).
The description of the room will be shown, followed by the available exits.
To move, type the direction you want to go:
----→ N or NORTH
----→ E or EAST
----→ S or SOUTH
----→ W or WEST
Type X at any time to exit the game.

========== AI Usage ==========
→ Brainstormed how to theme the rooms based on Naruto locations.
→ Improved the formatting of README instructions to make them easier to follow.
→ AI suggested different ways to allow both short and long commands.
→ AI suggested a cleaner way to format output for readability.