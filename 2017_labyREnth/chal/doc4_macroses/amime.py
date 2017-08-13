import base64
import zlib
from struct import unpack
import argparse
import email
from os.path import isfile
import hashlib
__has_ssdeep = False
from pprint import pprint 

try:
    import ssdeep
    __has_ssdeep = True
except:
    print ' Warning ssdeep import failed!'

__version__ = '0.0.1'
__author__ = 'Sean Wilson'

'''
https://github.com/phishme/python-amime
----------------------------------------
Changelog

0.0.1
 - Initial Release
0.0.2
 - Minor updates to output
 - Updated script to include ssdeep hash

----------------------------------------
Copyright (c) 2016 Sean Wilson - PhishMe


Permission is hereby granted, free of charge, to any person obtaining a copy
of this software and associated documentation files (the "Software"), to deal
in the Software without restriction, including without limitation the rights
to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
copies of the Software, and to permit persons to whom the Software is
furnished to do so, subject to the following conditions:


The above copyright notice and this permission notice shall be included in
all copies or substantial portions of the Software.


THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT.  IN NO EVENT SHALL THE
AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
THE SOFTWARE.
----------------------------------------
'''

class ActiveMimeDoc(object):

    @staticmethod
    def is_activemime(doc):
    	#pprint(doc)	
        if doc.startswith('QWN0aXZlTWltZQ') or doc.startswith('ActiveMime'):
            return True
        else:
            return False

    @staticmethod
    def is_base64(doc):
        if doc.startswith('QWN0aXZlTWltZQ'):
            return True
        else:
            return False

    def __init__(self, mimedoc, b64encoded=False):

        self.rawdoc = mimedoc

        if b64encoded:
            self.rawdoc = base64.b64decode(mimedoc)

        self.header  = None
        self.unknown_a = None
        self.unknown_b = None
        self.unknown_c = None
        self.unknown_d = None
        self.vba_tail_type = None
        self.has_vba_tail = False
        self.compressed_size = 0
        self.size = 0
        self.compressed_data = None
        self.data = None
        self.is_ole_doc = False
        self._parsedoc()



    def _parsedoc(self):
        cursor = 0
        self.header = self.rawdoc[0:12]

        # Should be 01f0
        self.unknown_a =  self.rawdoc[12:14].encode('hex')

        field_size = unpack('<I', self.rawdoc[14:18])[0]
        cursor = 18

        # Should be ffffffff
        self.unknown_b = self.rawdoc[cursor:cursor+field_size].encode('hex')
        cursor += field_size

        # Should be {x}0000{y}f0
        self.unknown_c = self.rawdoc[cursor:cursor+4].encode('hex')
        cursor += 4

        self.compressed_size = unpack('<I', self.rawdoc[cursor:cursor + 4])[0]
        cursor += 4

        field_size_d = unpack('<I', self.rawdoc[cursor:cursor+4])[0]
        cursor += 4

        field_size_e = unpack('<I', self.rawdoc[cursor:cursor+4])[0]
        cursor += 4

        # Should be 00000000 or 00000000 00000001
        self.unknown_d = self.rawdoc[cursor:cursor + field_size_d].encode('hex')
        cursor += field_size_d

        self.vba_tail_type = unpack('<I', self.rawdoc[cursor:cursor + field_size_e])[0]
        cursor += field_size_e

        if self.vba_tail_type == 0:
            self.has_vba_tail = True

        self.size = unpack('<I', self.rawdoc[cursor:cursor + 4])[0]
        cursor += 4

        self.compressed_data = self.rawdoc[cursor:]
        self.data = zlib.decompress(self.compressed_data)

        if self.data[0:4].encode('hex') == 'd0cf11e0':
            self.is_ole_doc = True

    def __str__(self):
        str = "ActiveMime Document Size: %d\n" % len(self.rawdoc)
        str += "Compressed Size:         %d\n" % self.compressed_size
        str += "Uncompressed Size:       %d\n" % self.size
        return str


def check_header(doc, debug):
    """
    Some of the malicious documents have junk text inserted at the
    beginning of the document.

    Check to make sure the document starts with Mime-Version
    """
    if doc.startswith("MIME-Version"):
        return doc
    else:
        print formatmsg(' [!] Invalid Header!', 'red')
        print ' [*] Scanning for Header offset...'
        offset = doc.find("MIME-Version")
        return doc[offset:]


def process(mimefile, extract):
    data = open(mimefile, 'rb').read()
    print ' [*] Scanning for Header'
    data = check_header(data, False)

    msg = email.message_from_string(data)

    parts_count = 0

    found = False
    amd = None
    for part in msg.walk():
        if __debug__:
            print '   - Processing Part :: %s' % part.get_content_type()

        if part.get_content_type() == 'application/x-mso':
            found = True
            print '     - Found x-mso payload..'

            payload = part.get_payload()

            if ActiveMimeDoc.is_activemime(payload):
                print '     - Processing ActiveMime Document..'
                decoded = base64.b64decode(payload)
                amd = ActiveMimeDoc(decoded)
            else:
                print formatmsg('   - Header is invalid..', 'yellow')

                # We've seen junk text within parts to throw off sandboxes
                # attempt to seek to the header
                if 'QWN0aXZlTWltZQ' in payload:
                    print formatmsg('   - Found Header', 'green')
                    offset = payload.find("QWN0aXZlTWltZQ")
                    doc = payload[offset:]

                    decoded = base64.b64decode(doc)
                    amd = ActiveMimeDoc(decoded)

        parts_count += 1

    if not found:
        print formatmsg(' [!] No MSO Found', 'red')


    if __debug__:
        print ' [*] Document contained %d parts' % parts_count

    return amd


def formatmsg(string, color):
    # 31 - Error
    # 33 - Warning
    # 37 - Info
    # http://www.tldp.org/HOWTO/Bash-Prompt-HOWTO/x329.html

    if color == 'red':
        return "\033[31m%s \033[0m" % string
    elif color == 'green':
        return "\033[32m%s \033[0m" % string
    elif color == 'yellow':
        return "\033[33m%s \033[0m" % string
    elif color == 'white':
        return "\033[37m%s \033[0m" % string
    else:
        return string

def main():

    parser = argparse.ArgumentParser(description="Scan  document for embedded objects.")
    parser.add_argument("file", help="File to process.")
    parser.add_argument('--extract', dest='extract', action='store_true', help="Extract ActiveMime Objects.")

    args = parser.parse_args()

    print 'ActiveMime Helper'
    print '-----------------'
    print ' [*] Loading file....%s ' % args.file

    if isfile(args.file):
    	tmpf = open(args.file, 'rb')
    	args.file = tmpf.read()
        amd = None
        if ActiveMimeDoc.is_activemime(args.file):
            amd = ActiveMimeDoc(args.file, ActiveMimeDoc.is_base64(args.file))

        else:
            print formatmsg(' [*] File is not an ActiveMime Document', 'yellow')
            print " [*] Parsing as MIME Document"
            amd = process(args.file, False)

        if amd:
            print ' ------------------------------------------------------'
            print '  ActiveMime Document'
            print '   - {:18}{}'.format('Size:', len(amd.rawdoc))
            print '   - {:18}{}'.format('Hash:', hashlib.sha1(amd.rawdoc).hexdigest())

            if __has_ssdeep:
                print '   - {:18}{}'.format('ssdeep:', ssdeep.hash(amd.rawdoc))

            print '  Payload Data'
            print '   - {:18}{}'.format('Compressed Size:',amd.compressed_size)
            print '   - {:18}{}'.format('Size:', amd.size)
            print '   - {:18}{}'.format('Hash:', hashlib.sha1(amd.data).hexdigest())

            if __has_ssdeep:
                print '   - {:18}{}'.format('Data ssdeep:', ssdeep.hash(amd.data))

            print '   - {:18}{}'.format('VBA Tail:', amd.has_vba_tail)
            print '   - {:18}{}'.format('OLE Doc:', amd.is_ole_doc)
            print ' ------------------------------------------------------'

            if args.extract:
                print ' [*] Writing decoded Project file'
                with open(hashlib.md5(amd.data).hexdigest(), 'wb') as out:
                    out.write(amd.data)
        return 0

    else:
        print formatmsg(' [!] File does not exist...exiting', 'red')
        return

if __name__ == '__main__':
    main()