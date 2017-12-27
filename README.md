# WU-Cloud-Cam-Pics-with-Tasker

Tasker Profiles, Tasks, and Scenes to periodically take pictures, caption with local network WS-1400-IP weather station data and upload to Weather Underground.  This requires a rooted phone and busybox installed.  Currently the Pic Caption task is scheduled to run every 2 minutes.  WU ftp upload frequency is 6 minutes just before sunrise and after sunset from/till dark. Upload frequency is as long as 32 minutes at night and during periods of low solar radiation change - sunny or thick overcast.  This is done to reduce load on WU FTP server.  jpg compression quality is optimized to stay below Weather Underground's 150Kbyte limit.

See also SoilSensor repository which contains updateweatherstation.php (used by Pic Caption task).

Requirements:
- Old Android phone - this code is set to Galaxy S3 screen size @ 1080x720.
- Rooted phone.  Google for root methods for your model - can be risky if not done right and may harm phone.
- Phone modified for boot on charge connect.  Google playlpm boot mod for older Samsungs.
- Tasker app.  Google Play Store
- Busybox  Google Play Store

--- If mounted outside:
- Direct connect to battery (current limited, regulated 4v) if phone shuts down charging at extreme temps - do this only if comfortable.
- Weather protect from rain.

This is running on a Galaxy S3 Android 4.3 ebay purchase cracked screen phone.  Recommendations / pitfalls:
- Pic taking via built in Tasker function caused the camera hardware to get stuck in preview mode so code uses builtin camera app.
- The Galaxy S3 charge circuit disables at ~<0C and ~>55C so outdoor operation at temp extremes needs an external supply.  In my application I've added a regulated 4V (current less than 1A) direct to the battery terminals.
- Weather Underground's support for weather webcams is limited (website reliability and helping you get your camera working).
- Confirmed working with firmware version 3.1.2 on the WS-1400.
- Of course you will need to modify Tasker code to your local IP addresses and WU camera info.
