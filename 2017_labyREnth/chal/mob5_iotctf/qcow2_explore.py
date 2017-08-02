#!/usr/bin/env python
# https://github.com/JonathonReinhart/qcow2-explore/blob/master/qcow2_explore.py
import sys
import os, os.path
from subprocess import call, check_call
from tempfile import mkdtemp

def main():
    if os.geteuid() != 0:
        print '{0}: Must be run as root'.format(APPNAME)
        sys.exit(1)

    if len(sys.argv) < 2:
        print 'Usage: {0} image.qcow2'.format(APPNAME)
        sys.exit(1)

    image_file = sys.argv[1]

    # TODO: Automatially find a free device
    nbd_dev = "/dev/nbd0"

    # Load the NBD driver
    check_call(['modprobe', 'nbd', 'maxpart=8'])

    # Connect the QCOW2 image as a network block device
    check_call(['qemu-nbd', '--connect', nbd_dev, image_file])
    try:
        # Display the partition table to the user
        check_call(['fdisk', '-l', nbd_dev])

        partnum = raw_input('Desired partition number? ')
        partdev = '{0}p{1}'.format(nbd_dev, partnum)

        # Create the mountpoint
        mountpoint = mkdtemp()
        try:
            # Mount the partition
            check_call(['mount', partdev, mountpoint])
            try:
                # Explore!
                print '\nYou are now looking at the mounted partition.'
                print 'Press Ctrl+D to exit.'

                call(['/bin/bash'], cwd=mountpoint)

                print 'Finished! Cleaning up...'

            finally:
                # Unmount the partition
                check_call(['umount', mountpoint])

        finally:
            # Remove the mountpoint
            os.rmdir(mountpoint)

    finally:
        # Disconnect the block device
        check_call(['qemu-nbd', '--disconnect', nbd_dev])

if __name__ == '__main__':
    APPNAME = os.path.basename(sys.argv[0])
    main()
