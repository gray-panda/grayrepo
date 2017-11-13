## LabyREnth CTF 2017
# Programming 2 : Connect 4

The challenge instructs us to connect to 52.40.187.77:16000

When we connect, we are greeted by a [Connect 4](https://en.wikipedia.org/wiki/Connect_Four) game

We have to win the Connect 4 game several times against different difficulty AIs.

The Connect 4 game has actually been "solved".  
Mathematically, the first player can always win.  
In this challenge, we are always the first player.

I found a PHP Connect4 solver at https://github.com/kevinAlbs/Connect4

However, this solver was for a 7x7 grid.  
I modified it to support a 6x7 grid instead [here](C4AI_6x7.php)

I wrote the [solution script](soln.php) to make use of this solver to solve the puzzles

As of the writing of this article, the challenge server seems to be down.  
After solving a few of them, the flag is revealed

The flag is **PAN{0ld_g4mz_4r3_b3st_g4mz}**