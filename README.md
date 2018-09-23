# WU-Cloud-Cam-Pics-with-Tasker

Tasker Profiles, Tasks, and Scenes to periodically take pictures, caption with local network WS-1400-IP weather station data and upload to Weather Underground.  9/23/18 update - add 6 day wx history overlay to image and provide daily mp4 time lapse video.  This requires a rooted phone and busybox installed.  Currently the Pic Caption task is scheduled to run every 2 minutes.  WU ftp upload frequency is 6 minutes just before sunrise and after sunset from/till dark. Upload frequency is as long as 30 minutes at night and during periods of low solar radiation change - sunny or thick overcast.  This is done to reduce load on WU FTP server.  jpg compression quality is optimized to stay below Weather Underground's 150Kbyte limit.  Videos are made nightly at ~11PM, take about 40 min to process at lowest priority, and are uploaded to google drive (https://tinyurl.com/yctgx5mn) via FolderSync app.  Videos older than ~140 days are purged to keep space used below ~3GB.

See also SoilSensor repository which contains updateweatherstation.php (used by Pic Caption task).

Requirements:
- Old Android phone - this code is set to Galaxy S3 screen size @ 1080x720.
- Rooted phone.  Google for root methods for your model - can be risky if not done right and may harm phone.
- Phone modified for boot on charge connect.  Google playlpm boot mod for older Samsungs.
- Tasker app.  Google Play Store ($3)
- Busybox  Google Play Store (free)
- FolderSynce  Google Play Store (free)
- Chrome Browser  Google Play Store (free) Renders wx history graph from 127.0.0.1/weatherstation/wx_graph.h and downloads
- Copy https://github.com/emakovsky/ffmpeg-android/blob/master/FFmpegAndroid/assets/armeabi-v7a/ffmpeg into /data/data/ffmpeg (chmod 755 to allow execute).

--- If mounted outside:
- Direct connect to battery (current limited, regulated 4v) if phone shuts down charging at extreme temps - do this only if comfortable.
- Weather protect from rain.

This is running on a Galaxy S3 Android 4.3 ebay purchase cracked screen phone.  Recommendations / pitfalls:
- Pic taking via built in Tasker function caused the camera hardware to get stuck in preview mode so code uses builtin camera app.
- The Galaxy S3 charge circuit disables at ~<0C and ~>55C so outdoor operation at temp extremes needs an external supply.  In my application I've added a regulated 4V (current less than 1A) direct to the battery terminals.
- Weather Underground's support for weather webcams is limited (website reliability and helping you get your camera working).
- Confirmed working with firmware version 3.1.2 on the WS-1400.
- Of course you will need to modify Tasker code to your local IP addresses and WU camera info.
- Use TeamViewer and adb for remote phone control and to push code updates.
- My WU cam page - https://www.wunderground.com/webcams/CollegeAntioch/2/show.html
