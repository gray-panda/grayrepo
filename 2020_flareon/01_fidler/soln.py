    
def main():
    license = "hiptu"
    lic = "".join([chr(ord(x)-1) for x in license])

    print("License Key: %s" % lic)
    
    print("Just change the target_amount variable in python script to = 2**36 + 2**35")
    print("And you will get the flag idle_with_kitty@flare-on.com")
    
if __name__ == "__main__":
    main()
