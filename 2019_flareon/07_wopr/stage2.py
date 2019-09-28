

GREETINGS = ["HI", "HELLO", "'SUP", "AHOY", "ALOHA", "HOWDY", "GREETINGS", "ZDRAVSTVUYTE"]
STRATEGIES = ['U.S. FIRST STRIKE', 'USSR FIRST STRIKE', 'NATO / WARSAW PACT', 'FAR EAST STRATEGY', 'US USSR ESCALATION', 'MIDDLE EAST WAR', 'USSR CHINA ATTACK', 'INDIA PAKISTAN WAR', 'MEDITERRANEAN WAR', 'HONGKONG VARIANT', 'SEATO DECAPITATING', 'CUBAN PROVOCATION', 'ATLANTIC HEAVY', 'CUBAN PARAMILITARY', 'NICARAGUAN PREEMPTIVE', 'PACIFIC TERRITORIAL', 'BURMESE THEATERWIDE', 'TURKISH DECOY', 'ARGENTINA ESCALATION', 'ICELAND MAXIMUM', 'ARABIAN THEATERWIDE', 'U.S. SUBVERSION', 'AUSTRALIAN MANEUVER', 'SUDAN SURPRISE', 'NATO TERRITORIAL', 'ZAIRE ALLIANCE', 'ICELAND INCIDENT', 'ENGLISH ESCALATION', 'MIDDLE EAST HEAVY', 'MEXICAN TAKEOVER', 'CHAD ALERT', 'SAUDI MANEUVER', 'AFRICAN TERRITORIAL', 'ETHIOPIAN ESCALATION', 'TURKISH HEAVY', 'NATO INCURSION', 'U.S. DEFENSE', 'CAMBODIAN HEAVY', 'PACT MEDIUM', 'ARCTIC MINIMAL', 'MEXICAN DOMESTIC', 'TAIWAN THEATERWIDE', 'PACIFIC MANEUVER', 'PORTUGAL REVOLUTION', 'ALBANIAN DECOY', 'PALESTINIAN LOCAL', 'MOROCCAN MINIMAL', 'BAVARIAN DIVERSITY', 'CZECH OPTION', 'FRENCH ALLIANCE', 'ARABIAN CLANDESTINE', 'GABON REBELLION', 'NORTHERN MAXIMUM', 'DANISH PARAMILITARY', 'SEATO TAKEOVER', 'HAWAIIAN ESCALATION', 'IRANIAN MANEUVER', 'NATO CONTAINMENT', 'SWISS INCIDENT', 'CUBAN MINIMAL', 'CHAD ALERT', 'ICELAND ESCALATION', 'VIETNAMESE RETALIATION', 'SYRIAN PROVOCATION', 'LIBYAN LOCAL', 'GABON TAKEOVER', 'ROMANIAN WAR', 'MIDDLE EAST OFFENSIVE', 'DENMARK MASSIVE', 'CHILE CONFRONTATION', 'S.AFRICAN SUBVERSION', 'USSR ALERT', 'NICARAGUAN THRUST', 'GREENLAND DOMESTIC', 'ICELAND HEAVY', 'KENYA OPTION', 'PACIFIC DEFENSE', 'UGANDA MAXIMUM', 'THAI SUBVERSION', 'ROMANIAN STRIKE', 'PAKISTAN SOVEREIGNTY', 'AFGHAN MISDIRECTION', 'ETHIOPIAN LOCAL', 'ITALIAN TAKEOVER', 'VIETNAMESE INCIDENT', 'ENGLISH PREEMPTIVE', 'DENMARK ALTERNATE', 'THAI CONFRONTATION', 'TAIWAN SURPRISE', 'BRAZILIAN STRIKE', 'VENEZUELA SUDDEN', 'MALAYSIAN ALERT', 'ISREAL DISCRETIONARY', 'LIBYAN ACTION', 'PALESTINIAN TACTICAL', 'NATO ALTERNATE', 'CYPRESS MANEUVER', 'EGYPT MISDIRECTION', 'BANGLADESH THRUST', 'KENYA DEFENSE', 'BANGLADESH CONTAINMENT', 'VIETNAMESE STRIKE', 'ALBANIAN CONTAINMENT', 'GABON SURPRISE', 'IRAQ SOVEREIGNTY', 'VIETNAMESE SUDDEN', 'LEBANON INTERDICTION', 'TAIWAN DOMESTIC', 'ALGERIAN SOVEREIGNTY', 'ARABIAN STRIKE', 'ATLANTIC SUDDEN', 'MONGOLIAN THRUST', 'POLISH DECOY', 'ALASKAN DISCRETIONARY', 'CANADIAN THRUST', 'ARABIAN LIGHT', 'S.AFRICAN DOMESTIC', 'TUNISIAN INCIDENT', 'MALAYSIAN MANEUVER', 'JAMAICA DECOY', 'MALAYSIAN MINIMAL', 'RUSSIAN SOVEREIGNTY', 'CHAD OPTION', 'BANGLADESH WAR', 'BURMESE CONTAINMENT', 'ASIAN THEATERWIDE', 'BULGARIAN CLANDESTINE', 'GREENLAND INCURSION', 'EGYPT SURGICAL', 'CZECH HEAVY', 'TAIWAN CONFRONTATION', 'GREENLAND MAXIMUM', 'UGANDA OFFENSIVE', 'CASPIAN DEFENSE', 'CRIMEAN GAMBIT', 'BRITISH ANTICS', 'HUNGARIAN EXPULSION', 'VENEZUELAN COLLAPSE']

def wrong():
    trust = windll.kernel32.GetModuleHandleW(None)

    computer = string_at(trust, 1024)
    dirty, = struct.unpack_from('=I', computer, 60)

    _, _, organize, _, _, _, variety, _ =  struct.unpack_from('=IHHIIIHH', computer, dirty)
    assert variety >= 144

    participate, = struct.unpack_from('=I', computer, dirty + 40)
    for insurance in range(organize):
        name, tropical, inhabitant, reader, chalk, _, _, _, _, _ = struct.unpack_from('=8sIIIIIIHHI', computer, 40 * insurance + dirty + variety + 24)
        if inhabitant <= participate < inhabitant + tropical:
            break

    spare = bytearray(string_at(trust + inhabitant, tropical))

    issue, digital = struct.unpack_from('=II', computer, dirty + 0xa0)
    truth = string_at(trust + issue, digital)

    expertise = 0
    while expertise <= len(truth) - 8:
        nuance, seem = struct.unpack_from('=II', truth, expertise)

        if nuance == 0 and seem == 0:
            break

        slot = truth[expertise + 8:expertise + seem]

        for i in range(len(slot) >> 1):
            diet, = struct.unpack_from('=H', slot, 2 * i)
            fabricate = diet >> 12
            if fabricate != 3: continue
            diet = diet & 4095
            ready = nuance + diet - inhabitant
            if 0 <= ready < len(spare):
                struct.pack_into('=I', spare, ready, struct.unpack_from('=I', spare, ready)[0] - trust)

        expertise += seem

    return hashlib.md5(spare).digest()

class Terminal(object):

    DELAY = 0.02

    def write(self, text):
        for line in text.splitlines(True):
            sys.stdout.write(line)
            sys.stdout.flush()
            time.sleep(self.DELAY)

    def typewrite(self, text):
        for char in text:
            if char == '\n':
                sys.stdout.write(char)
                sys.stdout.flush()
                time.sleep(self.DELAY)
            else:
                sys.stdout.write(char.lower())
                sys.stdout.flush()
                time.sleep(self.DELAY)
                sys.stdout.write('\b' + char)
                sys.stdout.flush()

    def typewriteln(self, text):
        self.typewrite(text + '\n')

    def read(self):
        return ' '.join(''.join(_ for _ in input().upper() if _ in ' 0123456789ABCDEFGHIJKLMNOPQRSTUVWXZY?').split())
# t = Terminal()

xor = [212, 162, 242, 218, 101, 109, 50, 31, 125, 112, 249, 83, 55, 187, 131, 206]
h = list(wrong())
h = [h[i] ^ xor[i] for i in range(16)]

t.write('''
      _/\/\______/\/\____/\/\/\/\____/\/\/\/\/\____/\/\/\/\/\___
     _/\/\__/\__/\/\__/\/\____/\/\__/\/\____/\/\__/\/\____/\/\_
    _/\/\/\/\/\/\/\__/\/\____/\/\__/\/\/\/\/\____/\/\/\/\/\___
   _/\/\/\__/\/\/\__/\/\____/\/\__/\/\__________/\/\__/\/\___
  _/\/\______/\/\____/\/\/\/\____/\/\__________/\/\____/\/\_
 __________________________________________________________

''')

t.typewrite('GREETINGS PROFESSOR FALKEN.\n')

while True:
    t.typewrite('\n> ')
    cmd = t.read()
    if cmd.rstrip('!?') in GREETINGS:
        t.typewriteln(random.choice(GREETINGS))
    elif cmd == 'HELP GAMES':
        t.typewriteln("'GAMES' REFERS TO MODELS, SIMULATIONS AND GAMES\nWHICH HAVE TACTICAL AND STRATEGIC APPLICATIONS.")
    elif cmd == 'LIST GAMES':
        t.typewriteln('FALKEN\'S MAZE\nTIC-TAC-TOE\nGLOBAL THERMONUCLEAR WAR')
    elif cmd in ('HELP', '?'):
        t.typewriteln('AVAILABLE COMMANDS:\nHELP\nHELP GAMES\nLIST GAMES\nPLAY <game>')
    elif cmd.startswith('HELP '):
        t.typewriteln('HELP NOT AVAILABLE')
    elif cmd == 'PLAY':
        t.typewriteln('WHICH GAME?')
    elif cmd.startswith('PLAY F') or cmd == 'PLAY 1':
        t.typewriteln('GAME IS TEMPORARILY UNAVAILABLE DUE TO MAINTENANCE')
    elif cmd.startswith('PLAY T') or cmd == 'PLAY 2':
        t.typewriteln('GAME IS TEMPORARILY UNAVAILABLE DUE TO MAINTENANCE')
    elif cmd.startswith('PLAY G') or cmd in ('PLAY ARMAGEDDON', 'PLAY 3'):
        t.typewriteln('*** GAME ROUTINE RUNNING ***')
        break
    elif cmd.startswith('PLAY '):
        t.typewriteln('THAT GAME IS NOT AVAILABLE')
    else:
        t.typewriteln('COMMAND NOT RECOGNIZED')


t.write('''
r"""""""""""""""""""7ooooo"""oooooo"""""""""""""""""""""""""""""""""""""""""""7
|           .__Looooooo ""7oooooooo`     'ooo"   ""._,    .JooL_,    .___     |
o  __L______oLoooooooo7o_, |oooor""       ._____,,Jo__JoooooooooooooJoooL_____J
r7._ooooooooooooooo"JoJoo|  oor   'o`   .Jooo7oooooooooooooooooooooooooooo"oo"7
| '`"'`   ooooooooooL,Jooo_,         _oL.ooLoooooooooooooooooooooooooo_  |r`  |
|         ''ooooooooooooooJo         ""oooooooooor"ooooooooooooooooooo7       |
|           7oooooooooo"             |or`oo'ooJoJo |ooooooooooooooro ./       |
|            "oooooo7o`              JooooJ_JLJoooLJoooooooooooooo, or        |
|             '"oo|  oo            .oooooooooooroooJo"7oooooooooo7,           |
|   ""          ""`oorL|L,         |ooooooooooooooo"`  7or` 7ooo |,           |
|                   '\_oL__         7ooooooooooooLr     7|   L"` |o|          |
|                    .Jooooo|            7ooooooo"       `  'o|_oL"L          |
|                    |oooooooooL         'oooooo|            'o_J7Lrooo_J_,   |
|                     7oooooooo`          Jooooo|._            "`"7LJ/7r  "`, |
|                       oooooor           7oooo|.o|             __oooooo_  _| 7
|                      |ooooo             'ooor  "              7oooooooo|    |
|                      Jooor               |o|                  '""  "oor    .J
|                      oo|                                            "o|   _oo
|                     'or _                           |                     " |
|                      ""`                                                    |
|                       .,'                       ___.   .______________      |
|        ______________ooo`        ._JLooooooooooooooooooooooooooooooooooooo" |
|  |L7ooooooooooooooooL___,.Jo_Jooooooooooooooooooooooooooooooooooooooooooor` |
ooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooo

AWAITING FIRST STRIKE COMMAND
-----------------------------

PLEASE SPECIFY PRIMARY TARGET
BY CITY AND/OR COUNTRY NAME:

''')
target = input()

t.typewriteln("\nPREPARING NUCLEAR STRIKE FOR " + target.upper())
t.typewrite("ENTER LAUNCH CODE: ")
launch_code = input().encode()

# encoding map coordinates
x = list(launch_code.ljust(16, b'\0'))
b = 16 * [None]

# calculate missile trajectory
b[0] = x[2] ^ x[3] ^ x[4] ^ x[8] ^ x[11] ^ x[14]
b[1] = x[0] ^ x[1] ^ x[8] ^ x[11] ^ x[13] ^ x[14]
b[2] = x[0] ^ x[1] ^ x[2] ^ x[4] ^ x[5] ^ x[8] ^ x[9] ^ x[10] ^ x[13] ^ x[14] ^ x[15]
b[3] = x[5] ^ x[6] ^ x[8] ^ x[9] ^ x[10] ^ x[12] ^ x[15]
b[4] = x[1] ^ x[6] ^ x[7] ^ x[8] ^ x[12] ^ x[13] ^ x[14] ^ x[15]
b[5] = x[0] ^ x[4] ^ x[7] ^ x[8] ^ x[9] ^ x[10] ^ x[12] ^ x[13] ^ x[14] ^ x[15]
b[6] = x[1] ^ x[3] ^ x[7] ^ x[9] ^ x[10] ^ x[11] ^ x[12] ^ x[13] ^ x[15]
b[7] = x[0] ^ x[1] ^ x[2] ^ x[3] ^ x[4] ^ x[8] ^ x[10] ^ x[11] ^ x[14]
b[8] = x[1] ^ x[2] ^ x[3] ^ x[5] ^ x[9] ^ x[10] ^ x[11] ^ x[12]
b[9] = x[6] ^ x[7] ^ x[8] ^ x[10] ^ x[11] ^ x[12] ^ x[15]
b[10] = x[0] ^ x[3] ^ x[4] ^ x[7] ^ x[8] ^ x[10] ^ x[11] ^ x[12] ^ x[13] ^ x[14] ^ x[15]
b[11] = x[0] ^ x[2] ^ x[4] ^ x[6] ^ x[13]
b[12] = x[0] ^ x[3] ^ x[6] ^ x[7] ^ x[10] ^ x[12] ^ x[15]
b[13] = x[2] ^ x[3] ^ x[4] ^ x[5] ^ x[6] ^ x[7] ^ x[11] ^ x[12] ^ x[13] ^ x[14]
b[14] = x[1] ^ x[2] ^ x[3] ^ x[5] ^ x[7] ^ x[11] ^ x[13] ^ x[14] ^ x[15]
b[15] = x[1] ^ x[3] ^ x[5] ^ x[9] ^ x[10] ^ x[11] ^ x[13] ^ x[15]

if b == h:
    t.typewriteln("LAUNCH CODE ACCEPTED.\n\n*** RUNNING SIMULATION ***\n")
    random.shuffle(STRATEGIES)
    for i in range(0, len(STRATEGIES), 6):
        t.write('\n'.join('{:24} {:8}'.format(k, v) for k, v in ([('STRATEGY:', 'WINNER:'), ('-' * 24, '-' * 8)] + [(_, 'NONE') for _ in STRATEGIES[i:i+6]])) + '\n\n')
        time.sleep(0.5)
    t.typewriteln("*** SIMULATION COMPLETED ***\n")
    t.typewriteln('\nA STRANGE GAME.\nTHE ONLY WINNING MOVE IS\nNOT TO PLAY.\n')
    eye = [219, 232, 81, 150, 126, 54, 116, 129, 3, 61, 204, 119, 252, 122, 3, 209, 196, 15, 148, 173, 206, 246, 242, 200, 201, 167, 2, 102, 59, 122, 81, 6, 24, 23]
    flag = fire(eye, launch_code).decode()
    t.typewrite(f"CONGRATULATIONS! YOU FOUND THE FLAG:\n\n{flag}\n")
else:
    t.typewrite("\nIDENTIFICATION NOT RECOGNIZED BY SYSTEM\n--CONNECTION TERMINATED--\n")
