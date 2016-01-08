**set base_url**

file path - /\digitalgaia/\iris/\attendance/\application/\config/\config.php

code line(26) - $config['base_url'] = 'http://localhost/digitalgaia/iris/attendance/';

Pls change to dev url for dev and live url for live


**database connection**

file path - /\digitalgaia/\iris/\attendance/\application/\config/\database.php

Pls change the connection setting


**db table for att_attendancedetails**


```
#!sql

CREATE TABLE IF NOT EXISTS `att_attendancedetails` (
  `managerID` int(11) NOT NULL,
  `attID` int(11) NOT NULL AUTO_INCREMENT,
  `activityDate` varchar(20) NOT NULL,
  `activityTime` varchar(20) NOT NULL,
  `activityStatus` text NOT NULL,
  `outstationStatus` text NOT NULL,
  `attendanceStatus` text NOT NULL,
  `latLongIn` varchar(255) NOT NULL,
  `latLongOut` varchar(255) NOT NULL,
  `imgIn` varchar(255) NOT NULL,
  `imgOut` varchar(255) NOT NULL,
  PRIMARY KEY (`attID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;
```