## LabyREnth CTF 2017
# Programming 1 : Maze

The challenge instructs us to connect to 54.69.145.229:16000

When we connect, we are greeted by some kind of maze puzzle.

Below are 2 examples of the mazes that are presented to us

```
###########
#>  #     #
# # # #####
#   #     #
# ##### # #
#     # # #
##### #X# #
# #   # # #
# # ##### #
#         #
###########

#############################
#>  #     #               # #
# ##### # ####### ####### # #
#       # #     # #     #   #
######### # ### # ### ##### #
#   #     #   # #   # #     #
# # # ####### # ### # # #####
# # #         # #   # #     #
# # ########### # ### # #####
# #       #   # #   #   #   #
# ### ### # # # # # ##### # #
# # # # # # # # # #       # #
# # # # # # # # ### ####### #
#   # #     # #   #   #     #
##### ####### ### # ### ### #
#   #   #   #   # # #   # # #
# # ### # ### ### # # ### # #
# #     #     #   # # #     #
# ####### ##### ##### #######
# #         #   #     #     #
# ########### ### # # # ### #
# #   #       #   # # #   # #
# # # # ########### ### ### #
# # #   #     #   #     #   #
# # ##### ### # # ####### ###
# #   #   # # # #       #   #
# ### # ### # # ####### ### #
#       #       #     X     #
#############################
```

We have to input a series of directions "<^>V" to guide the arrowhead ">" to the goal "X".  
There is also a short time limit, therefore it is not possible to do this manually by hand.

I remembered an excellent path-finding algorithm called [Dijkstra's Algorithm](https://en.wikipedia.org/wiki/Dijkstra%27s_algorithm) that I had used in an old Pacman game I did for a school assignment years ago.

I reimplemented the algorithm into PHP for this context [here](dijkstra.php)

I then wrote a [solution script](soln.php) that will connect to the challenge server and use the Dijkstra Algorithm to solve all the maze puzzles that was given.

As of the writing of this article, the challenge server seems to be down.  
After solving a few of them, the flag is revealed

The flag is **PAN{my_f1rst_labyM4z3.jpeg}**