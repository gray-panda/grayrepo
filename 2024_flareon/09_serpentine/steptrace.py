import py3dbg
import py3dbg.defines
import time
import sys
import hashlib

PROCESS_NAME = b"serpentine.exe"

trace_counter =0
instructions=""

def grab_registers(instruction, dbg):
    statement = ""
    if "rbp" in instruction:
        rbp = dbg.context.Rbp
        statement = f"{statement} rbp:{rbp:x}"
    if "ax" in instruction or "ah" in instruction or "al" in instruction:
        rax = dbg.context.Rax
        statement = f"{statement} rax:{rax:x}"
    if "bx" in instruction or "bh" in instruction or "bl" in instruction:
        rbx = dbg.context.Rbx
        statement = f"{statement} rbx:{rbx:x}"
    if "cx" in instruction or "ch" in instruction or "cl" in instruction:
        rcx = dbg.context.Rcx
        statement = f"{statement} rcx:{rcx:x}"
    if "dx" in instruction or "dh" in instruction or "dl" in instruction:
        rdx = dbg.context.Rdx
        statement = f"{statement} rdx:{rdx:x}"
    if "r8" in instruction:
        r8 = dbg.context.R8
        statement = f"{statement} r8:{r8:x}"
    if "r9" in instruction:
        r9 = dbg.context.R9
        statement = f"{statement} r9:{r9:x}"
    if "r10" in instruction:
        r10 = dbg.context.R10
        statement = f"{statement} r10:{r10:x}"
    if "r11" in instruction:
        r11 = dbg.context.R11
        statement = f"{statement} r11:{r11:x}"
    if "r12" in instruction:
        r12 = dbg.context.R12
        statement = f"{statement} r12:{r12:x}"
        #print(f"cmovne 0x{dbg.context.EFlags:X}", )
    if "r13" in instruction:
        r13 = dbg.context.R13
        statement = f"{statement} r13:{r13:x}"
    if "r14" in instruction:
        r14 = dbg.context.R14
        statement = f"{statement} r14:{r14:x}"
    if "r15" in instruction:
        r15 = dbg.context.R15
        statement = f"{statement} r15:{r15:x}"
    if "rsi" in instruction:
        rsi = dbg.context.Rsi
        statement = f"{statement} rsi:{rsi:x}"
    if "rdi" in instruction:
        rdi = dbg.context.Rdi
        statement = f"{statement} => rdi:{rdi:x}"
    return statement
    
previousInstruction = ""
def stepTrace(dbg):
    global trace_counter, instructions, previousInstruction
    rip = dbg.context.Rip
    # print("STEP TRACE")
    # print("TRACE RIP: 0x{:X}".format(rip))
    instruction = dbg.disasm(rip)  # Disassemble the instruction at the current address
    
    if(rip <= 0x7A379E1):
        trace_counter = trace_counter + 1
        previous = grab_registers(previousInstruction, dbg)
        previousInstruction = instruction
        instructions = instructions + instruction
        statement = f"Instruction at 0x{rip:X}: {instruction}, "
        statement2 = grab_registers(instruction, dbg)
        
        print(f"\t prev : {previous}\n")
        statement = f"{statement} => {statement2}"
        print(statement)
        dbg.single_step(1)
    return py3dbg.defines.DBG_CONTINUE
    
def bp_beforejumprax(dbg):
    rip = dbg.context.Rip
    rax = dbg.context.Rax
    instruction = dbg.disasm(rip)  # Disassemble the instruction at the current address
    return py3dbg.defines.DBG_CONTINUE
    
def md5_hash_string(input_string):
    return hashlib.md5(input_string.encode()).hexdigest()

def bp_wrong(dbg):
    global memcmp_count
    rip = dbg.context.Rip
    rax = dbg.context.Rax
    #print("RAX: 0x{:X}".format(rax))
    instruction = dbg.disasm(rip)  # Disassemble the instruction at the current address
    #if(trace_counter != 0x5437):
    print("\n************************************************************trace_counter: 0x{:X}\n".format(trace_counter))
    #print(md5_hash_string(instructions))
    return py3dbg.defines.DBG_CONTINUE

# Input Byte String
# inputKey = bytearray(b"ABCDEFGHIJKLMNOPQRSTUVWXYZ123456")
inputKey = bytearray(b"20CD4vGHpqKL0GOPELSTOeWX1p12De56")
# inputKey = bytearray(b"20PD4vgHpqEL0GVPELKTOeKX1p92De86")
# inputKey = bytearray(b"grsD_5hHngyLSqnP5bSTJZZXtAD27iy6")
# inputKey = bytearray(b"20P14vgopqEI0GVzELKROeKh1p9uDe89")
# inputKey = bytearray(b"Q2P5T49AnzgxTT0fE6hwtpwDEnb2EMCT")
# inputKey = bytearray(b"$0P1lvgo5qEIeGVzoLKRgeKhdp9uve89")
# inputKey = bytearray(b"$tihl$Je5h3SeTK_o5FYggo$dG7qv6Zy")
# inputKey = bytearray(b"$$P1lwgo5_EIepVzovKRg_Khd_9uvi89")
# inputKey = bytearray(b"$$s9lwfj5_ALepdpovQNg_ndd_yaviO0")
# inputKey = bytearray(b"$$_1lwao5_kIep_zov1Rg_ahd_muvin9")
print(f"Attempting InputKey {inputKey}")

dbg = py3dbg.pydbg()

dbg.load(PROCESS_NAME, inputKey)

dbg.attach(dbg.pid)

# 00007FFEFA090000
# 00007FFEFA13517D
# Offset - 0xA517D
dbg.bp_set(0x7FFEFA13517D ,handler=bp_beforejumprax)   # Very important, need to get from stack trace 
dbg.bp_set(0x1400011F0 ,handler=bp_wrong)


dbg.set_callback(py3dbg.defines.EXCEPTION_SINGLE_STEP,stepTrace )
dbg.run()
    