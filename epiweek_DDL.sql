-- dgvsops.epiweek definition

CREATE TABLE `epiweek` (
  `date` date NOT NULL,
  `epiweek` int(11) NOT NULL,
  PRIMARY KEY (`date`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
