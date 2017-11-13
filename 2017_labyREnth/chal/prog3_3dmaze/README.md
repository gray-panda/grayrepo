## LabyREnth CTF 2017
# Programming 3 : 3D Maze

The challenge instructs us to connect to 34.211.117.64:16000

This challenge is similar to the Programming 1 Maze challenge.  
However, this time we are presented with a first-person view of the maze and not a top down view.  
- Turn Left/Right with "a"/"d"
- Move Forward/Backward with "w"/"s"

Similarly, the goal is to reach the exit of the maze.  
However, the entire layout of the maze is unknown and thus Dijkstra's Algorithm can't be used.

So, I fell back to using the most [basic solution](https://en.wikipedia.org/wiki/Maze_solving_algorithm) to a maze
- Keep taking left turns till I reach the end 

### Cheating

The challenge's hints tell us that the maze actually cheats  
The first thing to figure out is how does the maze cheat.

After testing the challenge out a bit, I figured out how the maze cheats.  
It will create a wall in front of the player after every 10 commands.  
The way to bypass this cheat is to always face an existing wall after every 10 commands  
In this way, no new walls are created

### Screens

I encountered another problem after playing with the "game" for awhile  
I realized the socket "read" may not receive everything in one fread call  
This proved problematic in writing an automated script to solve the maze.

I later realized that there are only several valid "screens" in the game.  
I saved all these valid screens in the [responses](responses) folder and recorded the MD5 hash of these screens

When receiving data from the socket, I will receive data until the data's MD5 matches one of these valid screens.  
This also allowed me to identify which screen is shown easily

[soln_walker.php](soln_walker.php) and [processLogs.php](processLogs.php) will assist in generating these 19 valid screens and hashes.

### Solving the Maze

Now, I am ready to solve the maze.  
My algorithm is as follow
- Keep going straight
- Always take the left turn if available
- At a dead end, turn around 180 degrees
- Prepare to face the wall on every tenth command
	- If already facing a wall on the ninth command, walk into the wall
	- Else turn right to face a wall, then turn left to resume exploration

I wrote the [solution script](soln.php) based on this algorithm.

However, this algorithm is not perfect.  
It will fail in one situation
- On ninth command, standing on a space with open pathway to my right
	- My code will turn right, causing a wall to spawn in the open pathway

Testing the script for a few times, this situation seldom occured.  
Retry again if this situation happens and the player keep going around in a loop.

Eventually, it will reach the exit and shows the following screen

```
--------------------------------------------------------------------------------
                                                                                
                     ROFL:ROFL:LOL:ROFL:LOL:ROFL:LOL:ROFL:ROFL                  
                                        ||                                      
                         _______________||_______________                         
                        /      ____   ___     _   __ [ 0 \                         
          L            /      / __ \ /   |   / | / / |_|<_\                         
          O           /      / /_/ // /| |  /  |/ /  |_____\                       
        LOLOL========       / ____// ___ | / /|  /          \                
          O          |     /_/    /_/  |_|/_/ |_/            )                 
          L        B | O M B                                /                   
                     |____________,--------------__________/                    
                  F /      ||                       ||                        
                 T /     }-OMGPAN{c0ntact_jugglers_R_Ballerz}ROCKET))         
                W /________||_______________________||__/_/                    
```

As of the writing of this article, the challenge server seems to be down.  

The flag is **PAN{c0ntact_jugglers_R_Ballerz}**