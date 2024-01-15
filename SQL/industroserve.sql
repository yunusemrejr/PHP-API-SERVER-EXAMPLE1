 

 
/**
 * Copyright (c) 2024 by YUNUS EMRE VURGUN
 * Programmed in January 2024, this is the GITHUB FREE EDITION of this software, some parts are modified.
 */

 
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

 

CREATE TABLE `sessions` (
  `slugid` varchar(255) NOT NULL,
  `contenttype` varchar(255) NOT NULL,
  `speedtype` varchar(255) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

 

INSERT INTO `sessions` (`slugid`, `contenttype`, `speedtype`, `timestamp`) VALUES
('rvcavxammmmffflofuhxbf', 'Topic1', '0', '2024-01-15 18:10:06'),
('hgguurfffopdczbgyvjpa', 'Topic2', '0', '2024-01-15 18:14:33'),
('yfffmenxwaakdfihbrkffrcj', 'Topic1', '0', '2024-01-15 18:14:45'),
('faakmzvffjaenvplpvbjl', 'Topic1', '1', '2024-01-15 18:32:20'),
('itvjwfflluthotessshnij', 'Topic3', '1', '2024-01-15 18:50:41'),
('tvjjwugdlsectdivwffsyl', 'Topic1', '1', '2024-01-15 18:50:46'),
('hjhgfgqhujoospzjqfflqnyx', 'Topic2', '0', '2024-01-15 18:53:08'),
('hdabjouddyjvfaxdffnlxnw', 'Topic1', '1', '2024-01-15 19:28:35');

 

CREATE TABLE `users` (
  `ID` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

 

INSERT INTO `users` (`ID`, `username`, `password`) VALUES
(1, 'PLACEHOLDER_USERNAME', 'xxxxxxxxxxxxxxxxENCRYPTED-PASSWORD-HERE');

 
ALTER TABLE `users`
  ADD PRIMARY KEY (`ID`);
 

 
ALTER TABLE `users`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

 