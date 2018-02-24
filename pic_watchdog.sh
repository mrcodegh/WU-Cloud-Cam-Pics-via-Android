#!/system/bin/sh
#Script to reboot phone if picture update stopped due to camera lockup
while true
do
	date >>/sdcard/Tasker/log/wd.txt
	test="$(find /sdcard/DCIM/Tasker/tasker_orig.jpg -mmin +16)"
	if [ "$test" = "/sdcard/DCIM/Tasker/tasker_orig.jpg" ]
	then
		date >>/sdcard/Tasker/log/reboot_log.txt
		sleep 1
		reboot
	fi
	sleep 300
done