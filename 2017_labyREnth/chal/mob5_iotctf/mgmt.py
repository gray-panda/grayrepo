#!/usr/bin/python
from BaseHTTPServer import BaseHTTPRequestHandler,HTTPServer
from os import curdir, sep
import subprocess
import urllib
import datetime
import os

PORT_NUMBER = 8080
DIR = os.path.dirname(os.path.realpath(__file__))

#This class will handles any incoming request from
#the browser 
class myHandler(BaseHTTPRequestHandler):
    
    #Handler for the GET requests
    def do_GET(self):
        if self.path == "/" or self.path == "/status.html":
            self.path = DIR  + "/status.html"
        elif self.path.startswith("/get_ip.html?"):
            self.path = urllib.unquote(self.path).decode('utf-8')
            ip = self.return_ip(self.path)
            self.send_response(200)
            self.send_header('Content-type', 'text/xml')
            self.end_headers()
            self.wfile.write(ip)
            return
        elif self.path.startswith("/set_ntp.html?"):
            self.path = urllib.unquote(self.path).decode('utf-8')
            feedback = self.set_ntp(self.path)
            self.send_response(200)
            self.send_header('Content-type', 'text/xml')
            self.end_headers()
            self.wfile.write(feedback)
            return
        elif (self.path.startswith("/network.html") 
                or self.path.startswith("/status.html") 
                or self.path.startswith("/setting.html")
                or self.path.startswith("/contact.html")):
            self.path = DIR + self.path
        elif self.path.startswith("/get_motion_event.html"):
            self.path = urllib.unquote(self.path).decode('utf-8')
            self.send_response(200)
            self.send_header('Content-type', 'text/xml')
            self.end_headers()
            self.wfile.write(self.motion_history(self.path))
            return
        elif self.path.startswith("/check_status.html"):
            self.path = urllib.unquote(self.path).decode('utf-8')
            self.send_response(200)
            self.send_header('Content-type', 'text/xml')
            self.end_headers()
            self.wfile.write("Active")
            return
        elif self.path.startswith("/show_dns.html"):
            self.path = urllib.unquote(self.path).decode('utf-8')
            self.send_response(200)
            self.send_header('Content-type', 'text/xml')
            self.end_headers()
            self.wfile.write(self.return_dns())
            return
        elif self.path.startswith("/ping_google.html?"):
            self.path = urllib.unquote(self.path).decode('utf-8')
            self.send_response(200)
            self.send_header('Content-type', 'text/xml')
            self.end_headers()
            self.wfile.write(self.ping())
            return
        elif self.path.startswith("/get_time.html"):
            self.path = urllib.unquote(self.path).decode('utf-8')
            self.send_response(200)
            self.send_header('Content-type', 'text/xml')
            self.end_headers()
            self.wfile.write(self.get_time())
            return
        elif self.path.startswith("/files/") or self.path.startswith("/images/") or self.path.startswith("/css/"):
            temp = ''
            with open(DIR + self.path) as rf:
                temp = rf.read()
            self.send_response(200)
            self.send_header('Content-type', self.gen_header(self.path))
            self.end_headers()
            self.wfile.write(temp)
            return
        else:
            self.send_error(404,'File Not Found: %s' % self.path)
            return

        try:
            #Check the file extension required and
            #set the right mime type
            mimetype='text/html'
            #Open the static file requested and send it
            f = open(self.path) 
            self.send_response(200)
            self.send_header('Content-type',mimetype)
            self.end_headers()
            self.wfile.write(f.read())
            f.close()
            return

        except IOError:
            self.send_error(404,'File Not Found: %s' % self.path)

    def gen_header(self, path):
        if path.endswith('.html'):
            return 'text/html'
        elif path.endswith('.css'):
            return 'text/css'
        elif path.endswith('.png'):
            return 'image/png'
        elif path.endswith('.jpg'):
            return 'image/jpg'
        elif path.endswith('.css'):
            return 'text/css'
        return ''

    def return_ip(self, path):
        interface = ''
        if path.find('/get_ip.html?interface=') >= 0:
            interface = path[23:]

        cmd = "ifconfig %s |grep 'inet addr:' | cut -d: -f2 | awk '{print $1;}'" % (interface)
        p = subprocess.Popen(cmd, shell=True, stdout=subprocess.PIPE, stderr=subprocess.PIPE)        
        result, err = p.communicate()
        p.wait()
        return result.strip()

    def return_dns(self):
        return "8.8.8.8"

    def ping(self):
        cmd = "ping -w 3 www.google.com"
        p = subprocess.Popen(cmd, shell=True, stdout=subprocess.PIPE, stderr=subprocess.PIPE)        
        result, err = p.communicate()
        p.wait()
        print result
        return result

    def set_ntp(self, path):
        server = ''
        if path.find('/set_ntp.html?server=') >= 0:
            server = path[21:]

        cmd = "ntpdate -t 1 %s" % (server)
        p = subprocess.Popen(cmd, shell=True, stdout=subprocess.PIPE, stderr=subprocess.PIPE)        
        result, err = p.communicate()
        p.wait()
        if err != '':
            return 'update time error'
        else:
            return 'update time success'

    def get_time(self):
        now = datetime.datetime.now()
        return now.strftime("%Y-%m-%d %I:%M:%S")

    def motion_history(self, path):
        now = datetime.datetime.now()
        year = now.year
        month = now.month
        day = now.day - 1
        date1 = '%s-%s-%s %s:%s:%s %s' % (str(year), str(month), str(day), '07', '01', '03', 'dog detected')
        date2 = '%s-%s-%s %s:%s:%s %s' % (str(year), str(month), str(day), '09', '05', '13', 'person detected')
        date3 = '%s-%s-%s %s:%s:%s %s' % (str(year), str(month), str(day), '10', '42', '51', 'person detected')
        date4 = '%s-%s-%s %s:%s:%s %s' % (str(year), str(month), str(day), '11', '02', '05', 'dog detected')
        date5 = '%s-%s-%s %s:%s:%s %s' % (str(year), str(month), str(day), '11', '09', '11', 'person detected')
        return date1 + ';' + date2 + ';' + date3 + ';' + date4 + ';' + date5

try:
    #Create a web server and define the handler to manage the
    #incoming request
    server = HTTPServer(('', PORT_NUMBER), myHandler)
    print 'Started httpserver on port ' , PORT_NUMBER
    
    #Wait forever for incoming htto requests
    server.serve_forever()

except KeyboardInterrupt:
    print '^C received, shutting down the web server'
    server.socket.close()