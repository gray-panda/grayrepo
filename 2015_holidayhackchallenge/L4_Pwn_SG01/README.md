## Holiday Hack Challenge 2015
# Level 4-1 : Gnomage Pwnage (SG-01)

The goal for Level 4 is to get access to all 5 of the SuperGnome servers and download the **/gnome/www/files/gnome.conf** file from each of them

Let's start with the first one SG-01 (52.2.229.189)

This is very straightforward. Just login using the credentials from Level 02 (admin:SittingOnAShelf)

Navigate to the "Files" page, download the "gnome.conf" file and you're done :)

[SG01_gnome.conf](SG01_gnome.conf)
```
Gnome Serial Number: NCC1701
Current config file: ./tmp/e31faee/cfg/sg.01.v1339.cfg
Allow new subordinates?: YES
Camera monitoring?: YES
Audio monitoring?: YES
Camera update rate: 60min
Gnome mode: SuperGnome
Gnome name: SG-01
Allow file uploads?: YES
Allowed file formats: .png
Allowed file size: 512kb
Files directory: /gnome/www/files/
```

PS: Download the camera_feed_overlay_error.zip, factory_cam_1.zip and 20141226101055.zip for Level 5 too