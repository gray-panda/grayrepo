#define _GNU_SOURCE

#include <stdio.h>
#include <dlfcn.h>

#include <sys/types.h>
#include <string.h>

// gcc -m32 -shared -fPIC -ldl hooker.c -o libx.so.6

const char* PEEKDATA = "PTRACE_PEEKDATA";
const char* POKEDATA = "PTRACE_POKEDATA";
const char* CONT = "PTRACE_CONT";
const char* GETREGS = "PTRACE_GETREGS";
const char* SETREGS = "PTRACE_SETREGS";
const char* ATTACH = "PTRACE_ATTACH";
const char* DENY_ATTACH = "PTRACE_DENY_ATTACH";

#define PTRACE_OUTSTREAM stdout
// toggle this to stderr, then use 2>/dev/null when running to mute certain hooks

//function to convert ascii char[] to hex-string (char[])
void string2hexString(const unsigned char* input, char* output, int len)
{
    int loop;
    int i; 
    
    i=0;
    loop=0;
    
    while(input[loop] != '\0' && loop < len)
    {
        sprintf((char*)(output+i),"%02X", input[loop]);
        loop+=1;
        i+=2;
    }
    //insert NULL at the end of the output string
    //output[i++] = '\0';
}

int ptrace_req_name(int request, char* buffer){
	// removed strlen calls to not conflict with hooked strlen function
	switch(request){
		case 2:
			strncpy(buffer, PEEKDATA, 15);
			return 1;
		case 5:
			strncpy(buffer, POKEDATA, 15);
			return 1;
		case 7:
			strncpy(buffer, CONT, 11);
			return 1;
		case 12:
			strncpy(buffer, GETREGS, 14);
			return 1;
		case 13:
			strncpy(buffer, SETREGS, 14);
			return 1;
		case 16:
			strncpy(buffer, ATTACH, 13);
			return 1;
		case 31:
			strncpy(buffer, DENY_ATTACH, 18);
			return 1;
		default:
			return 0;
	}
}

typedef long (*ptrace_t)(int request, pid_t pid, void *addr, void *data);
ptrace_t real_ptrace;

long ptrace(int request, pid_t pid, void *addr, void *data) {
	void* handle;
	
	char ptrace_name[50];
	memset(ptrace_name, 0, 50);
	int nameres = ptrace_req_name(request, ptrace_name);
	
	if (!real_ptrace){
		handle = dlopen("libc.so.6", 1);
		real_ptrace = dlsym(handle, "ptrace");
	}

	long res = real_ptrace(request, pid, addr, data);
	
	if (1 == nameres){
		fprintf(PTRACE_OUTSTREAM, "\n ptrace(%s, %d, %p, %p) ==> %lx ", ptrace_name, pid, addr, data, res);
	}
	else{
		fprintf(PTRACE_OUTSTREAM, "\n ptrace(%d, %d, %p, %p) ==> %lx ", request, pid, addr, data, res);	
	}
	
	return res;
}


typedef pid_t (*waitpid_t)(pid_t pid, int *stat_loc, int options);
waitpid_t real_waitpid;

pid_t waitpid(pid_t pid, int *stat_loc, int options){
	if(!real_waitpid){
		real_waitpid = dlsym(RTLD_NEXT, "waitpid");
	}

	pid_t res = real_waitpid(pid, stat_loc, options);
	fprintf(PTRACE_OUTSTREAM, "\nwaitpid(%d) returns status %x", pid, *stat_loc);
	return res;
}


typedef size_t (*strlen_t)(const char *s);
strlen_t real_strlen;

size_t strlen(const char *s){
	if (!real_strlen){
		real_strlen = dlsym(RTLD_NEXT, "strlen");
	}

	//char tmp[100];
	//memset(tmp, 0, 100);
	//string2hexString(s, tmp);

	fprintf(stdout, "\nstrlen() on string %s", s);
	//fprintf(stderr, "\nstrlen() on string %s", tmp);
	size_t res = real_strlen(s);
	return res;
}


typedef int (*strcmp_t)(const char *s1, const char *s2);
strcmp_t real_strcmp;

int strcmp(const char *s1, const char *s2){
	if (!real_strcmp){
		real_strcmp = dlsym(RTLD_NEXT, "strcmp");
	}

	fprintf(stderr, "\nstrcmp('%s', '%s') ", s1, s2);
	int res = real_strcmp(s1,s2);
	return res;
}



typedef int (*strncmp_t)(const char *s1, const char *s2, size_t n);
strncmp_t real_strncmp;

int strncmp(const char *s1, const char *s2, size_t n){
	if (!real_strncmp){
		real_strncmp = dlsym(RTLD_NEXT, "strncmp");
	}

	char tmp1[100];
	char tmp2[100];
	memset(tmp1, 0, 100);
	memset(tmp2, 0, 100);
	string2hexString(s1, tmp1, 0x50);
	string2hexString(s2, tmp2, 0x50);

	fprintf(stdout, "\nstrncmp('%s', '%s', %d) ", tmp1, tmp2, n);
	//fprintf(stdout, "\nstrncmp('%s', '%s', %d) ", s1, s2, n);
	int res = real_strncmp(s1,s2,n);
	return res;
}

typedef int (*memcmp_t)(const void *s1, const void *s2, size_t n);
memcmp_t real_memcmp;

int memcmp(const void *s1, const void *s2, size_t n){
	if (!real_memcmp){
		real_memcmp = dlsym(RTLD_NEXT, "memcmp");
	}

	
	char tmp1[100];
	char tmp2[100];
	memset(tmp1, 0, 100);
	memset(tmp2, 0, 100);
	string2hexString(s1, tmp1, 0x50);
	string2hexString(s2, tmp2, 0x50);
	fprintf(stdout, "\nmemcmp(%s, %s, %d)\n", tmp1, tmp2, n);
	
	
	//fprintf(stdout, "\nmemcmp(s1, s2, %d)", n);
	return real_memcmp(s1, s2, n);
}

__attribute__((constructor)) static void setup(void) {
  fprintf(stderr, "called setup()\n");
}

typedef int (*pivot_root_t)(const char *new_root, const char *put_old);
pivot_root_t real_pivot_root;

int pivot_root(const char *new_root, const char *put_old){
	if (!real_pivot_root){
		real_pivot_root = dlsym(RTLD_NEXT, "pivot_root");
	}

	int res = real_pivot_root(new_root, put_old);
	fprintf(stderr, "\npivot_root(%p, %p) ==> %x", new_root, put_old, res);
	
	return res;
}

typedef void *(*memcpy_t)(void *dest, const void *src, size_t n);
memcpy_t real_memcpy;

void *memcpy(void *dest, const void *src, size_t n){
	if (!real_memcpy){
		real_memcpy = dlsym(RTLD_NEXT, "memcpy");
	}

	fprintf(stdout, "\nmemcpy(%p, '%s', %d)", dest, (const char *)src, n);
	return real_memcpy(dest, src, n);
}

typedef int (*chmod_t)(const char *path, mode_t mode);
chmod_t real_chmod;

int chmod(const char *path, mode_t mode){
	if (!real_chmod){
		real_chmod = dlsym(RTLD_NEXT, "chmod");
	}

	int res = real_chmod(path, mode);
	fprintf(stdout, "\nchmod(%p, %x) ==> %x", path, mode, res);

	return res;
}

typedef int (*mlockall_t)(int flags);
mlockall_t real_mlockall;

int mlockall(int flags){
	if (!real_mlockall){
		real_mlockall = dlsym(RTLD_NEXT, "mlockall");
	}

	int res = real_mlockall(flags);
	fprintf(stdout, "\nmlockall(%x) ==> %x", flags, res);

	return res;
}

//typedef int (*uname_t)(struct utsname *name);
typedef int (*uname_t)(void *name);
uname_t real_uname;

//int uname(struct utsname *name){
int uname(void *name){
	if (!real_uname){
		real_uname = dlsym(RTLD_NEXT, "uname");
	}

	int res = real_uname(name);
	fprintf(stdout, "\nuname(%p) ==> %x", name, res);

	return res;
}

typedef int (*truncate_t)(const char *path, off_t length);
truncate_t real_truncate;

int truncate(const char *path, off_t length){
	if (!real_truncate){
		real_truncate = dlsym(RTLD_NEXT, "truncate");
	}

	
	char tmp[100];
	memset(tmp, 0, 100);
	string2hexString(path, tmp, 0x20);
	
	fprintf(stdout, "\ntruncate(%s, %ld) ", tmp, length);

	return real_truncate(path, length);
}

/*
typedef FILE *(*fopen_t)(const char *pathname, const char *mode);
fopen_t real_fopen;

FILE *fopen(const char *pathname, const char *mode) {
  fprintf(stderr, "called fopen(%s, %s)\n", pathname, mode);
  if (!real_fopen) {
    real_fopen = dlsym(RTLD_NEXT, "fopen");
  }

  return real_fopen(pathname, mode);
}
*/