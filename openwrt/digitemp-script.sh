#!/bin/sh

TEMP=`digitemp_DS9097 -a -q -o "%.2C"`

case "$TEMP" in
*.* ) TEMP=`digitemp_DS9097 -a -q -o "%.2C"` && wget -O /dev/null "http://remoteserver.com/input_value.php?value="$TEMP ;;
*      ) digitemp_DS9097 -i -s /dev/ttyUSB0 && TEMP=`digitemp_DS9097 -a -q -o "%.2C"` && wget -O /dev/null "http://remoteserver.com/input_value.php?value="$TEMP ;;
esac

