## Holiday Hack Challenge 2015
# Level 5-1 : Attribution (Emails)

The goal for Level 5 is to figure out the evil plot and the mastermind behind it

For each of the SuperGnome servers that you managed to pwn, you should have downloaded these zip files as well. If not, go back to those servers and download them

- 20141226101055.zip (SG-01)
- 20150225093040.zip (SG-02)
- 20151201113356.zip (SG-03)
- 20151203133815.zip (SG-04)
- 20151215161015.zip (SG-05)

Each of these zip files contains a pcap file that contains an email. Reading these emails will reveal the plot and the mastermind behind it. Just open the pcap file in Wireshark and 'Follow TCP Stream'. This will reveal the emails in plain text

###[Email 1](20141226101055_1.pcap)

```
From: "c" <c@atnascorp.com>
To: <jojo@atnascorp.com>
Subject: GiYH Architecture
Date: Fri, 26 Dec 2014 10:10:55 -0500
Message-ID: <004301d0211e$2553aa80$6ffaff80$@atnascorp.com>
MIME-Version: 1.0
Content-Type: multipart/mixed;

JoJo,

As you know, I hired you because you are the best architect in town for a
distributed surveillance system to satisfy our rather unique business
requirements.  We have less than a year from today to get our final plans in
place.  Our schedule is aggressive, but realistic. 

I've sketched out the overall Gnome in Your Home architecture in the diagram
attached below.  Please add in protocol details and other technical
specifications to complete the architectural plans.

Remember: to achieve our goal, we must have the infrastructure scale to
upwards of 2 million Gnomes.  Once we solidify the architecture, you'll work
with the hardware team to create device specs and we'll start procuring
hardware in the February 2015 timeframe.

I've also made significant progress on distribution deals with retailers. 

Thoughts?

Looking forward to working with you on this project!

-C
```

Email 1 also comes with an image attached. The following [script](email1.py) will extract this image out

```py
from scapy.all import *
import base64

pcap = '20141226101055_1.pcap'
pkts = rdpcap(pcap)
theimg = ''

i=0
start = False
for p in pkts:
  if p.haslayer('Raw'):
    data = str(p[Raw])

    if start == False:    
      pos = data.find('"GiYH_Architecture.jpg"')
      if  pos != -1:
        start = True
        pos += len('"GiYH_Architecture.jpg"')
        tmp = data[pos:]
        pos = tmp.find('"GiYH_Architecture.jpg"') + len('"GiYH_Architecture.jpg"')
        tmp = tmp[pos:]
        tmp = tmp.strip()
        theimg = tmp
        #print str(i) + ' ' + str(tmp);
    else:
      if data.find('250 2.0.0') != -1:
        break
      theimg += data
      #print data
  i += 1

theimg = base64.b64decode(theimg)
f = open('GIYH_Architecture.jpg', 'w')
f.write(theimg)
f.close()
```

![email1_img](GIYH_Architecture.jpg)

This shows that a mysterious character 'c' is planning some evil project. The image shows the project's architecture. Multiple 'Gnomes' (about 2 million of them) are to take pictures and send them back to 5 SuperGnome servers which would be accessed by the 'bad guys'. 

Also to note, the Gnomes are to be ARM architecture while the SuperGnomes are to be x64 architecture. This means that the x86 'sgstatd' binary might be planned to be deployed only on the SuperGnomes but somebody messed up and put it on the ARM Gnomes too.

The mastermind also signed off the email as 'C'

###[Email 2](20150225093040_2.pcap)

```
From: "c" <c@atnascorp.com>
To: <supplier@ginormouselectronicssupplier.com>
Subject: =?us-ascii?Q?Large_Order_-_Immediate_Attention_Required?=
Date: Wed, 25 Feb 2015 09:30:39 -0500
Message-ID: <005001d05107$a1323ef0$e396bcd0$@atnascorp.com>
MIME-Version: 1.0
Content-Type: multipart/alternative;

Maratha,

As a follow-up to our phone conversation, we'd like to proceed with an order
of parts for our upcoming product line.  We'll need two million of each of
the following components:

+ Ambarella S2Lm IP Camera Processor System-on-Chip (with an ARM Cortex A9
CPU and Linux SDK)

+ ON Semiconductor AR0330: 3 MP 1/3" CMOS Digital Image Sensor

+ Atheros AR6233X Wi-Fi adapter

+ Texas Instruments TPS65053 switching power supply

+ Samsung K4B2G16460 2GB SSDR3 SDRAM

+ Samsung K9F1G08U0D 1GB NAND Flash

Given the volume of this purchase, we fully expect the 35% discount you
mentioned during our phone discussion.  If you cannot agree to this pricing,
we'll place our order elsewhere.

We need delivery of components to begin no later than April 1, 2015, with
250,000 units coming each week, with all of them arriving no later than June
1, 2015.

Finally, as you know, this project requires the utmost secrecy.   Tell NO
ONE about our order, especially any nosy law enforcement authorities.

Regards,

-CW
```

This shows a purchase order of hardware parts and further reinforces the idea that 2 million of these Gnomes are planned. Also, another initial of the mastermind is revealed to be 'CW'

###[Email 3](20151201113358_3.pcap)

```
From: "c" <c@atnascorp.com>
To: <burglerlackeys@atnascorp.com>
Subject: All Systems Go for Dec 24, 2015
Date: Tue, 1 Dec 2015 11:33:56 -0500
Message-ID: <005501d12c56$12bf6dc0$383e4940$@atnascorp.com>
MIME-Version: 1.0
Content-Type: multipart/alternative;

My Burgling Friends, 

Our long-running plan is nearly complete, and I'm writing to share the date
when your thieving will commence!  On the morning of December 24, 2015, each
individual burglar on this email list will receive a detailed itinerary of
specific houses and an inventory of items to steal from each house, along
with still photos of where to locate each item.  The message will also
include a specific path optimized for you to hit your assigned houses
quickly and efficiently the night of December 24, 2015 after dark.

Further, we've selected the items to steal based on a detailed analysis of
what commands the highest prices on the hot-items open market.  I caution
you - steal only the items included on the list.  DO NOT waste time grabbing
anything else from a house.  There's no sense whatsoever grabbing crumbs too
small for a mouse!

As to the details of the plan, remember to wear the Santa suit we provided
you, and bring the extra large bag for all your stolen goods.

If any children observe you in their houses that night, remember to tell
them that you are actually "Santy Claus", and that you need to send the
specific items you are taking to your workshop for repair.  Describe it in a
very friendly manner, get the child a drink of water, pat him or her on the
head, and send the little moppet back to bed.  Then, finish the deed, and
get out of there.  It's all quite simple - go to each house, grab the loot,
and return it to the designated drop-off area so we can resell it.  And,
above all, avoid Mount Crumpit! 

As we agreed, we'll split the proceeds from our sale 50-50 with each
burglar.

Oh, and I've heard that many of you are asking where the name ATNAS comes
from.  Why, it's reverse SANTA, of course.  Instead of bringing presents on
Christmas, we'll be stealing them!

Thank you for your partnership in this endeavor. 

Signed:

-CLW

President and CEO of ATNAS Corporation
```

Ahh!! The evil plan is revealed!! 

- The Gnomes are responsible for taking photos of the rooms and sending it back to ATNAS
- Images are analyzed to identify valuables and where they are in the house
- These information are relayed to a team of burglars who will enter the house on 24 December to steal these items
- The burglars will be dressed in Santa suits and carry a super large bag
- If discovered by children, they are to act as Santa and put the children back to bed
- The profits will be split 50-50 between ATNAS and the burglars

Also, ATNAS is SANTA in reverse (Should have seen that coming -.- LOL)

Another initial of the mastermind is revealed to be 'CLW' and he/she is the President and CEO of ATNAS Corporation

###[Email 4](20150225093040_2.pcap)

```
From: "c" <c@atnascorp.com>
To: <psychdoctor@whovillepsychiatrists.com>
Subject: Answer To Your Question
Date: Thu, 3 Dec 2015 13:38:15 -0500
Message-ID: <005a01d12df9$c5b00990$51101cb0$@atnascorp.com>
MIME-Version: 1.0
Content-Type: multipart/alternative;

Dr. O'Malley,

In your recent email, you inquired:

> When did you first notice your anxiety about the holiday season?

Anxiety is hardly the word for it.  It's a deep-seated hatred, Doctor.

Before I get into details, please allow me to remind you that we operate
under the strictest doctor-patient confidentiality agreement in the
business.  I have some very powerful lawyers whom I'd hate to invoke in the
event of some leak on your part.  I seek your help because you are the best
psychiatrist in all of Who-ville.

To answer your question directly, as a young child (I must have been no more
than two), I experienced a life-changing interaction.  Very late on
Christmas Eve, I was awakened to find a grotesque green Who dressed in a
tattered Santa Claus outfit, standing in my barren living room, attempting
to shove our holiday tree up the chimney.  My senses heightened, I put on my
best little-girl innocent voice and asked him what he was doing.  He
explained that he was "Santy Claus" and needed to send the tree for repair.
I instantly knew it was a lie, but I humored the old thief so I could escape
to the safety of my bed.  That horrifying interaction ruined Christmas for
me that year, and I was terrified of the whole holiday season throughout my
teen years.

I later learned that the green Who was known as "the Grinch" and had lost
his mind in the middle of a crime spree to steal Christmas presents.  At the
very moment of his criminal triumph, he had a pitiful change of heart and
started playing all nicey-nice.  What an amateur!  When I became an adult,
my fear of Christmas boiled into true hatred of the whole holiday season.  I
knew that I had to stop Christmas from coming.  But how?

I vowed to finish what the Grinch had started, but to do it at a far larger
scale.  Using the latest technology and a distributed channel of burglars,
we'd rob 2 million houses, grabbing their most precious gifts, and selling
them on the open market.  We'll destroy Christmas as two million homes full
of people all cry "BOO-HOO", and we'll turn a handy profit on the whole
deal.

Is this "wrong"?  I simply don't care.  I bear the bitter scars of the
Grinch's malfeasance, and singing a little "Fahoo Fores" isn't gonna fix
that!

What is your advice, doctor?

Signed,

Cindy Lou Who
```

This email reveals the motivation behind the sinister plan. The mastermind had a traumatic childhood experience during Christmas. She had an incident with the Grinch and it made her hate Christmas after that. She wants to repeat what the Grinch did but at a much larger scale (about 2 million of them).

Also, the mastermind's name is revealed to be "Cindy Lou Who"

PS: I just found out "Cindy Lou Who" is the little girl in the movie "Dr Seuss' How the Grinch Stole Christmas"

###[Email 5](20150225093040_2.pcap)

```
From: "Grinch" <grinch@who-villeisp.com>
To: <c@atnascorp.com>
Subject: My Apologies & Holiday Greetings
Date: Tue, 15 Dec 2015 16:09:40 -0500
Message-ID: <006d01d1377c$e9ddbab0$bd993010$@who-villeisp.com>
MIME-Version: 1.0
Content-Type: multipart/alternative;

Dear Cindy Lou,

I am writing to apologize for what I did to you so long ago.  I wronged you
and all the Whos down in Who-ville due to my extreme misunderstanding of
Christmas and a deep-seated hatred.  I should have never lied to you, and I
should have never stolen those gifts on Christmas Eve.  I realize that even
returning them on Christmas morn didn't erase my crimes completely.  I seek
your forgiveness.

You see, on Mount Crumpit that fateful Christmas morning, I learned th[4 bytes missing in capture file]at
Christmas doesn't come from a store.  In fact, I discovered that Christmas
means a whole lot more!

When I returned their gifts, the Whos embraced me.  They forgave.  I was
stunned, and my heart grew even more.  Why, they even let me carve the roast
beast!  They demonstrated to me that the holiday season is, in part, about
forgiveness and love, and that's the gift that all the Whos gave to me that
morning so long ago.  I honestly tear up thinking about it.

I don't expect you to forgive me, Cindy Lou.  But, you have my deepest and
most sincere apologies.

And, above all, don't let my horrible actions from so long ago taint you in
any way.  I understand you've grown into an amazing business leader.  You
are a precious and beautiful Who, my dear.  Please use your skills wisely
and to help and support your fellow Who, especially during the holidays.

I sincerely wish you a holiday season full of kindness and warmth,

--The Grinch
```

The last email is an apology letter from the Grinch to Cindy for what he did so many years ago

Another thing to note is that in the pcap file, there is a set of credentials captured in the packets (c:AllYourPresentsAreBelongToMe). However, I can't find where these credentials could be used. If anyone know, pop me a message too

###The Evil ATNAS Plot

The mastermind behind this plot is Cindy Lou Who, President and CEO of ATNAS Corporation.

She had planned to use the gnomes to take pictures of the houses' interior, identify valuable items in them and send burglars to steal them on Chirstmas Eve. These burglars would be dressed as Santa so that they could lie their way out if they were caught by children. She wants to be a reverse Santa (Atnas) in which she takes presents away instead of giving them. The motivation behind it was her deep seated hatred of Chirstmas due to a traumatic exprience with the Grinch when she was a child.